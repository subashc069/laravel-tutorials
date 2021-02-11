<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Channel;
use App\Models\User;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    function user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    function user_can_view_single_threads()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    function user_can_read_replies_associated_with_a_thread()
    {
        $reply = Reply::factory()->create([
            'thread_id' => $this->thread->id,
        ]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**
     * @test
     */
    function users_can_filter_threads_by_channel()
    {
        $this->withoutExceptionHandling();
        $channel = Channel::factory()->create();

        $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
        $threadNotInChannel = Thread::factory()->create();
        
        $this->get('/threads')
            ->assertSee($threadInChannel->title)
            ->assertSee($threadNotInChannel->title);

        $this->get('/threads/'. $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
    
    /**
     * @test
     */
    function a_users_can_filter_threads_by_username()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->create(['name' => 'JohnDoe']));

        $threadbyJohn = Thread::factory()->create(['user_id' => auth()->id()]);
        $threadNotByJohn = Thread::factory()->create();
        
        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadbyJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

}
