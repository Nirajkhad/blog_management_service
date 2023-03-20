<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    public function test_data_not_found(): void
    {
        $this->delete("/api/posts/1111111111")->assertStatus(404);
    }

    public function test_delete(): void
    {
        $payload = [
            "title" => "Duplicate Test",
            "content" => "Duplicate Test Content",
            "slug" => "/duplicate-test"
        ];
        $createdData = Post::create($payload);
        $this->delete("/api/posts/{$createdData['id']}")->assertStatus(200);
    }
}
