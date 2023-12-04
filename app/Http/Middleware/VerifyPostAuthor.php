<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class VerifyPostAuthor
{
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('post'); // Pastikan nama parameter sesuai dengan yang Anda gunakan

        $post = Post::findOrFail($postId);

        if ($request->user()->id !== $post->user_id) {
            return response()->json(['message' => 'Anda tidak diizinkan untuk melakukan aksi ini.'], 403);
        }

        return $next($request);
    }
}
