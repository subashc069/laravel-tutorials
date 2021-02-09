<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;

class CreateThreadsTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * @test
	 **/
	function a_guest_user_may_not_create_threads()
	{
		$this->get('/threads/create')
			->assertRedirect('/login');
		$this->post('threads',[])
			->assertRedirect('/login');
	}
    /**
     * A basic feature test example.
     *
	 * @return void
	 * @test
     */
    function an_authenticated_user_can_create_threads()
	{
		$this->withoutExceptionHandling();

		$this->signIn();

		$thread = Thread::factory()->create();

		$response = $this->post('/threads', $thread->toArray());
		
		$this->get($response->headers->get('Location'))
			->assertSee($thread->title)
			->assertSee($thread->body);
    }

    /**
     * @test
     */
    function a_thread_requires_a_title()
    {
        $this->signIn();

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }
    
    /**
     * @test
     */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }
    
    /**
     * @test
     */
    function a_thread_requires_a_valid_channel()
    {
        Channel::factory(2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 9])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = null)
    {
        $this->signIn();
        $thread = Thread::factory()->make($overrides);
        
        return $this->post('/threads', $thread->toArray());
    }

}
