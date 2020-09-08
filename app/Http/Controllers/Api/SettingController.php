<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Cache::get('app_web_settings', [
            'icp_beian'    => '',
            'police_beian' => '',
            'police_link'  => '',
        ]);
        $settings['copyright'] = config('app.name');
        $settings['copyright_link'] = config('app.url');
        return response()->json($settings);
    }
}
