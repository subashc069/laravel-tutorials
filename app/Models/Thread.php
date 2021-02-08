<?php

namespace App\Models;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;
	
	protected $guarded = [];

    public function path()
    {
        return '/threads/'.$this->id;
	}	
	
	public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
	}

	public function addReply($reply)
	{
		$this->replies()->create($reply);
	}
}
