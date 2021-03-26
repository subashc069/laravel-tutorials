<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Reply;

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
    function guests_cannot_delete_a_thread()
    {
        $thread = Thread::factory()->create();
        $response = $this->delete($thread->path());

        $response->assertRedirect('/login');
    }
    /**
     * @test
     *
     * @return void
     */
    function threads_can_be_deleted()
    {
        $this->signIn();
		$this->withoutExceptionHandling();

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);
        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /**@test */
    function  threads_may_only_be_deleted_by_those_who_have_permission()
    {
        
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
