<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class GetALlPostsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_data(): void
    {
        $payload = [
            "title" => "Duplicate Test",
            "content" => "Duplicate Test Content",
            "slug" => "/duplicate-test"
        ];
        Post::create($payload);
        $this->get("/api/posts")->assertStatus(200);
    }
}
