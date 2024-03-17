<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Helpers\PostHelper;
use App\Http\Helpers\RedisHelper;

class PostController extends Controller
{
    use PostHelper, RedisHelper;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {

        $validatedData = $request->validated();

        if (!$validatedData) {
            return redirect()->back()->withErrors('Validation failed.')->withInput();
        }

        try {
            $newPost = $this->createPost($validatedData);
            $this->tellRedis($newPost, "post_created");
            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error creating post: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->showPost($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->showPost($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        $validatedData = $request->validated();
        $this->updatePost($post, $validatedData);
        $this->tellRedis($post, "post_updated");

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->deletePost($post);
        $this->tellRedis($post, "post_deleted");
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
