<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    public function test_empty_payload_validation(): void
    {
        $this->post("/api/posts", [])->assertStatus(422);
    }

    public function test_data_already_exists_validation(): void
    {
        $payload = [
            "title" => "Duplicate Test",
            "content" => "Duplicate Test Content",
            "slug" => "/duplicate-test"
        ];
        Post::create($payload);
        $this->post("/api/posts", $payload)->assertStatus(400);
    }

    public function test_add_posts(): void
    {
        $payload = [
            "title" => "Add Post Test",
            "content" => "Add Post Test Content",
            "slug" => "/add-post-test"
        ];
        $this->post("/api/posts", $payload)->assertStatus(200);
    }
}
