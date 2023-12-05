<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkService
{
    public function getBookmarks()
    {
        $bookmark = Bookmark::where('user_id', Auth::user()->id)->get();

        return response()->json($bookmark);
    }

    public function createBookmark(Post $post)
    {
        $post = Post::findOrFail($post->id);

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
        ]);

        $message = $bookmark->wasRecentlyCreated ? 'Post successfully bookmarked' : 'Post already bookmarked';

        return response()->json([
            'bookmark' => $bookmark,
            'message' => $message
        ]);
    }

    public function deleteBookmark(Post $post)
    {
        $post = Post::findOrFail($post->id);

        $deleted = Bookmark::where('user_id', Auth::user()->id)
            ->where('post_id', $post->id)
            ->delete();

        if ($deleted) {
            return response()->json([
                'message' => 'Bookmark successfully deleted'
            ]);
        }

        return response()->json(['message' => 'Bookmark not found'], 404);
    }
}
