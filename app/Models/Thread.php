<?php

namespace App\Models;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Channel;

class Thread extends Model
{
    use HasFactory;
	
	protected $guarded = [];
    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
            $thread->replies()->delete();
        });
    }
    
    public function path()
	{
        return "/threads/{$this->channel->slug}/{$this->id}";
	}	
	
	public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    
    public function getReplyCountAttribute()
    {
        return $this->replies()->count();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
	}
	
	public function channel()
	{
		return $this->belongsTo(Channel::class, 'channel_id');
	}

	public function addReply($reply)
	{
		$this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
