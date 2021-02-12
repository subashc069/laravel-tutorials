<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reply;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Guest users cannot favorite a reply
     * @test
     */
    public function guest_user_cannot_favorite_a_reply()
    {
        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    /**
     * A user can favourite a reply 
     *
     * @return void
     * @test
     */
    public function a_user_can_favourite_a_reply()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $reply = Reply::factory()->create();

        $this->post('/replies/'. $reply->id.'/favorites');
        $this->assertCount(1, $reply->favorites);
    }
   /**
     * A user can favourite a reply once
     *
     * @return void
     * @test
     */
    public function a_user_can_favourite_a_reply_once()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $reply = Reply::factory()->create();
        try {
            $this->post('/replies/'. $reply->id.'/favorites');
            $this->post('/replies/'. $reply->id.'/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert same record twice');
        }
        $this->assertCount(1, $reply->favorites);
    }
}
