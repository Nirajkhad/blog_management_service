<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class FilterPostsTest extends TestCase
{
    public function test_invalid_query_params(): void
    {
        $this->get("/api/posts/filter?abc=1")->assertStatus(400);
    }

    public function test_filter(): void
    {
        $payload = [
            "title" => "Duplicate Test",
            "content" => "Duplicate Test Content",
            "slug" => "/duplicate-test"
        ];
        Post::create($payload);
        $this->get("/api/posts/filter?title=Duplicate Test")->assertStatus(200);
    }
}
