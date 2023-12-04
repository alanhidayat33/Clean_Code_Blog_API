<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Bookmark;

class BookmarkService
{
    public function getBookmarks($userId)
    {
        return Bookmark::where('user_id', $userId)->get();
    }

    public function createBookmark($userId, $postId)
    {
        $post = Post::findOrFail($postId);

        return Bookmark::firstOrCreate([
            'user_id' => $userId,
            'post_id' => $post->id
        ]);
    }

    public function deleteBookmark($userId, $postId)
    {
        return Bookmark::where('user_id', $userId)
            ->where('post_id', $postId)
            ->delete();
    }
}
