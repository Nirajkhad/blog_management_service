<?php 

namespace App\Helper;

class Helpers{

    public function validateKeys(array $payload)
    {
        $validKeys = [
            'id',
            'title',
            'content',
            'slug',
            'like_count',
            'comment_count'
        ];
        foreach ($payload as $key => $element) {
            if (!in_array($key, $validKeys)) {
                abort(400, "Invalid Keys");
            }
        }
    }

}