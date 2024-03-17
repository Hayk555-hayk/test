<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\PostService;
use App\Http\Services\RedisService;

class PostController extends Controller
{
    private PostService $postService;
    private RedisService $redisService;

    public function __construct(PostService $postService, RedisService $redisService)
    {
        $this->postService = $postService;
        $this->redisService = $redisService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\View\View
    {
        $posts = $this->postService->getAllPosts();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();

        if (!$validatedData) {
            return redirect()->back()->withErrors('Validation failed.')->withInput();
        }

        try {
            $newPost = $this->postService->createPost($validatedData);
            $this->redisService->tellRedis($newPost, "post_created");

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error creating post: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\View\View
    {
        $post = $this->postService->showPost($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\View\View // Added return type declaration
    {
        $post = $this->postService->showPost($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validated();
        $this->postService->updatePost($post, $validatedData); // Access updatePost method
        $this->redisService->tellRedis($post, "post_updated");

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $this->postService->deletePost($post);
        $this->redisService->tellRedis($post, "post_deleted");
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
