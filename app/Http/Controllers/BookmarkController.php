<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Bookmark;
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
    public function index(Request $request)
    {
        $user = $request->user();
        $bookmarks = $this->bookmarkService->getBookmarks($user->id);

        return response()->json(['bookmarks' => $bookmarks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $user = $request->user();

        $bookmark = $this->bookmarkService->createBookmark($user->id, $postId);

        return response()->json([
            'message' => $bookmark->wasRecentlyCreated ? 'Post successfully bookmarked' : 'Post already bookmarked'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $postId)
    {
        $user = $request->user();

        $deleted = $this->bookmarkService->deleteBookmark($user->id, $postId);

        if ($deleted) {
            return response()->json([
                'message' => 'Bookmark successfully deleted'
            ]);
        }

        return response()->json(['message' => 'Bookmark not found'], 404);
    }
}
