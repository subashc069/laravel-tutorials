<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Reply;
use App\Models\Channel;

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
	 * @test
	 **/
	public function a_thread_can_make_string_path()
	{
		$this->assertEquals(
			"/threads/{$this->thread->channel->slug}/{$this->thread->id}",
			$this->thread->path()
		);
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

	/**
	 * @test
	 **/
	public function a_thread_belongs_to_a_channel()
	{	
		//$this->withoutExceptionHandling();

		$this->assertInstanceOf(Channel::class, $this->thread->channel);		
	}
}
