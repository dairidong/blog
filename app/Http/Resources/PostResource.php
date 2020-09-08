<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    protected $load_between_page = false;
    protected $prev_id;
    protected $next_id;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['category'] = new CategoryResource($this->whenLoaded('category'));
        $data['cover'] = $this->getCoverUrl();

        if ($this->load_between_page) {
            $data['prev_id'] = $this->prev_id;
            $data['next_id'] = $this->next_id;
        }

        return $data;
    }

    /**
     * 加载上下两篇文章的id
     * @return $this
     */
    public function loadBetweenPage()
    {
        $this->load_between_page = true;

        $this->prev_id = Post::query()->where('id', '>', $this->id)
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->take(1)->value('id');

        $this->next_id = Post::query()->where('id', '<', $this->id)
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->take(1)->value('id');

        return $this;
    }
}
