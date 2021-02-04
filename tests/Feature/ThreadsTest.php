<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_can_view_all_threads()
    {
        $thread = Thread::factory()->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_can_view_single_threads()
    {
        $thread = Thread::factory()->create();

        $response = $this->get('/threads/' . $thread->id);

        $response->assertSee($thread->title);
    }
}
