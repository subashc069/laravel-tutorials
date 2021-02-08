<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;

class CreateThreadsTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * @test
	 **/
	public function an_unauthenticated_user_may_not_create_threads()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');
		$this->withoutExceptionHandling();
		$this->post('threads',[]);
	}
    /**
     * A basic feature test example.
     *
	 * @return void
	 * @test
     */
    public function an_authenticated_user_can_create_threads()
	{
		$this->withoutExceptionHandling();

		$this->actingAs(User::factory()->create());

		$thread = Thread::factory()->make();

		$this->post('/threads', $thread->toArray());
		
		$this->get($thread->path())
			->assertSee($thread->title)
			->assertSee($thread->body);
    }
}
