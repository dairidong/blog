<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = (int)$request->input('pageSize', 6);
        $query = Post::query()
            ->select('id', 'title', 'slug', 'cover', 'outline', 'category_id', 'published_at')
            ->where('is_published', true);

        if ($request->input('category')) {
            $query->where('category_id', (int)$request->input('category'));
        }

        $posts = $query->with('category')
            ->latest()
            ->paginate($pageSize);

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post->load('category');

        $prev = Post::query()->where('id', '<', $post->id)
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->take(1)->value('id');


        $next = Post::query()->where('id', '>', $post->id)
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->take(1)->value('id');

        return (new PostResource($post))->loadBetweenPage();
    }
}
