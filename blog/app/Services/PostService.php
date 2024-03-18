<?php

declare(strict_types=1);

namespace App\Services;

use  \Illuminate\Database\Eloquent\Collection;
use App\Models\Post;

class PostService
{
    /**
     * Get all posts.
     *
     * @return Collection
     */
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

    /**
     * Show post.
     *
     * @param mixed $id
     *
     * @return Post|null
     */
    public function getById($id): ?Post
    {
        return Post::find($id);
    }

    /**
     * Update post.
     *
     * @param Post $post
     * @param array $data
     *
     * @return bool
     */
    public function updatePost($post, $data): bool
    {
        return $post->update($data);
    }

    /**
     * Delete post.
     *
     * @param Post $post
     *
     * @return bool
     */
    public function deletePost($post): bool
    {
        return $post->delete();
    }
}
