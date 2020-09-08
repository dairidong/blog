<?php


namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Card;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('网站设置')
            ->description('网站设置')
            ->body(new Card(new Setting()));
    }
}
