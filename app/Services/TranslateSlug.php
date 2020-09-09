<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class TranslateSlug
{
    // 百度翻译服务key和secret
    protected $appId;
    protected $appSecret;

    protected $from = 'auto';
    protected $to;

    const SERVICE_URL = 'https://fanyi-api.baidu.com/api/trans/vip/translate';

    public function __construct(string $appKey, string $appSecret)
    {
        $this->appId = $appKey;
        $this->appSecret = $appSecret;
    }

    public function translate(string $query, string $to = '', string $from = '')
    {
        $salt = mt_rand();
        if (empty($to) && empty($this->to)) {
            throw new \Exception("缺少翻译参数");
        }

        return Http::asForm()->post(self::SERVICE_URL, [
            'q'     => $query,// 翻译字段
            'from'  => $from ?: $this->from,
            'to'    => $to ?: $this->to,
            'appid' => $this->appId,
            'salt'  => $salt,
            'sign'  => $this->getSign($query, $salt)
        ])->throw()->json();
    }

    public function to(string $to)
    {
        $this->to = $to;
        return $this;
    }

    public function from(string $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * 获取签名
     * @param $query
     * @param $salt
     * @return string
     */
    private function getSign($query, $salt)
    {
        return md5($this->appId . $query . $salt . $this->appSecret);
    }
}
