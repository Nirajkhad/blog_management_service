<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class UpdatePostsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_check_empty_payload(): void
    {
        $this->put("/api/posts/1", [])->assertStatus(400);
    }

    public function test_check_keys_validation(): void
    {
        $this->put("/api/posts/1", ["abc" => 12])->assertStatus(400);
    }

    public function test_data_not_found(): void
    {
        $this->put("/api/posts/1111111", ["title" => "Test"])->assertStatus(404);
    }

    public function test_update(): void
    {
        $payload = [
            "title" => "Duplicate Test",
            "content" => "Duplicate Test Content",
            "slug" => "/duplicate-test"
        ];
        $createdData = Post::create($payload);
        $this->put("/api/posts/{$createdData['id']}", ["title" => "Test"])->assertStatus(200);
    }
}
