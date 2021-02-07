<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Reply;

class ThreadTest extends TestCase
{
    use RefreshDatabase;
	
	protected $thread;

	public function setUp(): void
	{
		parent::setUp();
		
		$this->thread = Thread::factory()->create();
	}
	
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
	}
	
	/**
	 * @test
	 **/
	public function a_thread_can_add_replies()
	{
		$this->thread->addReply([
			'body' => 'foobar',
			'user_id' => $this->thread->user_id
		]);

		$this->assertCount(1, $this->thread->replies);
	}
}
