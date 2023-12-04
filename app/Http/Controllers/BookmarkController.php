<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $bookmarks = Bookmark::where('user_id', $user->id)->get();

        return response()->json(['bookmarks' => $bookmarks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $user = $request->user();

        $post = Post::findOrFail($postId);

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

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

        $deleted = Bookmark::where('user_id', $user->id)
                            ->where('post_id', $postId)
                            ->delete();

        if ($deleted) {
            return response()->json([
                'message' => 'Bookmark successfully deleted'
            ]);
        }

        return response()->json(['message' => 'Bookmark not found'], 404);
    }
}
