<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
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
    public function user_can_view_all_threads()
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
    public function user_can_view_single_threads()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_can_read_replies_associated_with_a_thread()
    {
        $reply = Reply::factory()->create([
            'thread_id' => $this->thread->id,
        ]);

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
