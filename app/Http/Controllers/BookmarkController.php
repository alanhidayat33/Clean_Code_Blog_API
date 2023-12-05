<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\BookmarkService;

class BookmarkController extends Controller
{

    protected $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->bookmarkService->getBookmarks();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post)
    {
        return $this->bookmarkService->createBookmark($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->bookmarkService->deleteBookmark($post);
    }
}
