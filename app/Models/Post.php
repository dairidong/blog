<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{

    use HasDateTimeFormatter;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 生成 slug
     * @param string $slug 生成用的字符串
     * @param string $language 语言
     * @return string
     * @throws \Exception
     */
    static public function createSlug(string $slug, string $language = 'en')
    {
        // 当传入的字符串为空，返回 false
        if (!$slug) {
            throw new \Exception('slug 字符串不能为空');
        }
        // 生成 slug
        $slug = Str::slug($slug, '-', $language);
        // 避免重复
        while (self::query()->where('slug', $slug)->exists()) {
            $slug .= '-' . Str::random(3);
        }
        return $slug;
    }

    public function getCoverUrl()
    {
        if (Str::startsWith($this->cover, 'http')) {
            return $this->cover;
        }

        return $this->cover ? Storage::url($this->cover) : '';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (preg_match('/^\d+$/', $value) && $value > 0) {
            // 是否正整数
            return self::query()->where('id', $value)
                ->where('is_published', true)
                ->firstOrFail();
        } else if (is_string($value)) {
            return self::query()->where('slug', $value)
                ->where('is_published', true)
                ->firstOrFail();
        } else {
            abort(404);
        }
    }
}
