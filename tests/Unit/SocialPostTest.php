<?php

namespace Tests\Unit;

use App\Models\SocialPost;
use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_belongs_to_user()
    {
        $user = User::factory()->create();
        $post = SocialPost::factory()->for($user)->create();

        $this->assertInstanceOf(User::class, $post->user);
        $this->assertEquals($user->id, $post->user->id);
    }

    public function test_post_belongs_to_group()
    {
        $group = Group::factory()->create();
        $post = SocialPost::factory()->for($group)->create();

        $this->assertInstanceOf(Group::class, $post->group);
        $this->assertEquals($group->id, $post->group->id);
    }

    public function test_soft_delete_works()
    {
        $post = SocialPost::factory()->create();
        $post->delete();

        $this->assertSoftDeleted('social_posts', ['id' => $post->id]);
    }
}