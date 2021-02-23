<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_has_a_profile()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }
    /**
     * @test
     */
    public function profiles_display_all_the_threads_associated_with_the_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $thread = Thread::factory()->create(['user_id' => $user->id]);

        $this->get("/profiles/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
