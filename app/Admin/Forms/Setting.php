<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class Setting extends Form
{
    protected $cache_key = 'app_web_settings';

    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return Response
     */
    public function handle(array $input)
    {
        try {
            Cache::forever($this->cache_key, $input);
            return $this->success('保存成功');
        } catch (\Exception $e) {
            return $this->error('发生错误');
        }
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->tab('SEO 相关', function () {
            $this->text('keywords', '关键字')->rules('nullable|string');
            $this->text('description', '描述')->rules('nullable|string');
        });

        $this->tab('备案相关', function () {
            $this->text('icp_beian', 'ICP 备案号')->rules('nullable|string');
            $this->text('police_beian', '公安备案号')->rules('nullable|string');
            $this->url('police_link', '公安备案链接')->rules('nullable|url');
        });
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return Cache::get($this->cache_key, []);
    }
}
