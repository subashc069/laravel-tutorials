<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use Illuminate\Auth\AuthenticationException;

class ParticipateInForumTest extends TestCase
{
	use RefreshDatabase;
	
	/**
	 * @test
	 **/
	function unauthenticated_users_may_not_add_a_reply()
	{
		$this->post('threads/some-thread/1/replies',[])
			->assertRedirect('/login');
	}
	
    /**
     * A basic feature test example.
     *
	 * @return void
	 * @test
     */
    function an_authenticated_user_can_participate_in_forum_thread()
	{
		//Given we have an authenticated user
		//And an existing thread
		//when the user adds a reply to the thread
		//Their reply should be visible on the page
		
		$this->withoutExceptionHandling();
		$this->signIn();
		$thread = Thread::factory()->create();
		$reply = Reply::factory()->make();
		
		$this->post($thread->path() . '/replies', $reply->toArray());
		
		$this->get($thread->path())
			->assertSee($reply->body);
    }

    /**
     * @test
     */
    function a_reply_requires_a_body()
    {
        $this->signIn();
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->make(['body' => null]);
        
		$this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');    
    }
}
