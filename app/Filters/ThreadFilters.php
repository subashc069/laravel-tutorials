<?php

namespace App\Filters;

use App\Models\User;

class ThreadFilters extends Filter
{
    protected $filters = ['by'];

    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        
        return $this->builder->where('user_id', $user->id);

    } 
}
