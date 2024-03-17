<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Post;

class PostService
{
    public function getAllPosts(): \Illuminate\Database\Eloquent\Collection
    {
        return Post::all();
    }

    /**
     * Create post.
     *
     * @param array $data
     *
     * @return Post
     */
    public function createPost(array $data): Post
    {
        return Post::create($data);
    }

    
    public function showPost($id): ?Post
    {
        return Post::find($id);
    }

    public function updatePost($post, $data): bool
    {
        return $post->update($data);
    }

    public function deletePost($post): bool
    {
        return $post->delete();
    }
}
