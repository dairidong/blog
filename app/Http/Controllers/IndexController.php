<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index($any = '')
    {
        $settings = Cache::get('app_web_settings', []);
        return view('index', [
            'keywords'    => $settings['keywords'] ?? '',
            'description' => $settings['description'] ?? '',
        ]);
    }
}
