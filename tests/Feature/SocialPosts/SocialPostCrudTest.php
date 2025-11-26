<?php

namespace Tests\Feature\SocialPosts;

use App\Models\SocialPost;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class SocialPostCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();

        $this->actingAs($user);

        $post = SocialPost::create([
            'user_id' => $user->id,
            'group_id' => $group->id,
            'text' => '<p>Olá mundo!</p>',
            'uuid' => Str::uuid(),
        ]);

        $this->assertDatabaseHas('social_posts', [
            'id' => $post->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = SocialPost::factory()->for($user)->create();

        $this->actingAs($user);

        $post->update([
            'text' => 'Texto atualizado',
        ]);

        $this->assertEquals('Texto atualizado', $post->fresh()->text);
    }

    public function test_user_can_delete_own_post()
    {
        $user = User::factory()->create();
        $post = SocialPost::factory()->for($user)->create();

        $this->actingAs($user);

        $post->delete();

        $this->assertSoftDeleted('social_posts', ['id' => $post->id]);
    }
}
