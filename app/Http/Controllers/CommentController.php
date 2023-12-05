<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Traits\CreatesEntity;
use App\Traits\UpdatesEntity;
use App\Traits\DeletesEntity;

class CommentController extends Controller
{
    use CreatesEntity, UpdatesEntity, DeletesEntity;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::all();

        return CommentResource::collection($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentCreateRequest $request)
    {
        $comment = $this->createEntity(Comment::class, $request);

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::findOrFail($id);

        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentUpdateRequest $request, string $id)
    {
        return $this->updateEntity(Comment::class, $request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteEntity(Comment::class, $id);
    }
}
