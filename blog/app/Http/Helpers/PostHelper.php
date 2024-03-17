<?php

namespace App\Http\Helpers;

use App\Models\Post;

trait PostHelper {

    public function getAllPosts() {
        return Post::all();
    }

    public function createPost($data) {
        $newPost = Post::create($data);
        return $newPost;
    }

    public function showPost($id) {
        $post = Post::find($id);
        return $post;
    }

    public function updatePost($post, $data) {
        $updatedPost = $post->update($data);
        return $updatedPost;
    }

    public function deletePost($post) {
        $deletedPost = $post->delete();
        return $deletedPost;
    }

}
