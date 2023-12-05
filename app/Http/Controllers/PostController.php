<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Traits\CreatesEntity;
use App\Traits\UpdatesEntity;
use App\Traits\DeletesEntity;

class PostController extends Controller
{
    use CreatesEntity, UpdatesEntity, DeletesEntity;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author')->get();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $post = $this->createEntity(Post::class, $request);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('author')->findOrFail($id);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        return $this->updateEntity(Post::class, $request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteEntity(Post::class, $id);
    }
}
