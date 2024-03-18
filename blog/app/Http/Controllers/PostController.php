<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use App\Services\RedisService;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    private PostService $postService;
    private RedisService $redisService;

    /**
     * Constructor to inject dependencies.
     *
     * @param PostService $postService
     * @param RedisService $redisService
     */
    public function __construct(PostService $postService, RedisService $redisService)
    {
        $this->postService = $postService;
        $this->redisService = $redisService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = $this->postService->getAllPosts();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return RedirectResponse
     */
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            $newPost = $this->postService->createPost($validatedData);
            $this->redisService->publish($newPost, 'post_created');

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error creating post: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $post = $this->postService->getById($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $post = $this->postService->getById($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->postService->updatePost($post, $validatedData); // Access updatePost method
        $this->redisService->publish($post, 'post_updated');

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->postService->deletePost($post);
        $this->redisService->publish($post, 'post_deleted');
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
