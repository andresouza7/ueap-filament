<?php

namespace Tests\Feature\SocialPosts;

use App\Models\SocialPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialPostScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_sees_only_his_posts()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        SocialPost::factory()->for($userA)->count(2)->create();
        SocialPost::factory()->for($userB)->count(3)->create();

        $this->actingAs($userA);

        $posts = \App\Filament\App\Resources\Social\SocialPosts\SocialPostResource::getEloquentQuery()->get();

        $this->assertCount(2, $posts);
        $this->assertTrue($posts->every(fn ($p) => $p->user_id === $userA->id));
    }
}
