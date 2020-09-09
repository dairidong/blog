<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreatePostSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        // 如果 slug 已经存在，直接结束任务
        if ($this->post->slug) {
            return;
        }
        $query = $this->post->title;
        $trans = app('translate-slug')->translate($query, 'en');
        if (isset($trans['trans_result'][0]['dst']) && !empty($trans['trans_result'][0]['dst'])) {
            $this->post->slug = Post::createSlug($trans['trans_result'][0]['dst']);
            $this->post->save();
        } else {
            Log::debug('百度翻译失败，调用本地 slug', [
                'title' => $this->post->title,
                'trans' => $trans,
            ]);
            $this->post->slug = Post::createSlug($this->post->title, 'zh_CN');
            $this->post->save();
        }
    }
}
