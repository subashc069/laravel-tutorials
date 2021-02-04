<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function it_has_an_owner()
    {
        $reply = Reply::factory()->create();
        
        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
