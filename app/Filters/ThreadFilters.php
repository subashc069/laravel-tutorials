<?php

namespace App\Filters;

use App\Models\User;

class ThreadFilters extends Filter
{
    protected $filters = ['by', 'popular'];

    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->builder->where('user_id', $user->id);
    }

    public function popular()
    {   
        return  $this->builder->reorder('replies_count', 'desc');
    } 
}
