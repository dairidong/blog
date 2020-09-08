<?php

namespace App\Observers;

use App\Jobs\CreatePostSlug;
use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function saving(Post $post)
    {
        // 封面为空时赋值
        if (empty($post->cover)) {
            $post->cover = '';
        }
        if (empty($post->slug)) {
            $post->slug = '';
        }

        // 确认发布时给予发布时间
        if ($post->isDirty('is_published') && is_null($post->published_at)) {
            $post->published_at = now();
        }

        // 概要
        $post->outline = Str::limit(strip_tags($post->content), 200);
    }

    public function saved(Post $post)
    {
        // slug 为空时，生成 slug
        if (empty($post->slug)) {
            dispatch(new CreatePostSlug($post))->onQueue('post-slug');
        }
    }
}
