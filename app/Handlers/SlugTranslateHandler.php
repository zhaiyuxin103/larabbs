<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Overtrue\Pinyin\Pinyin;

class SlugTranslateHandler
{
    public function translate($text): string
    {
        // 初始化配置信息
        $api = 'https://openapi.youdao.com/api';
        $appid = config('services.youdao.appid');
        $key = config('services.youdao.key');
        $salt = (string) Str::uuid();
        $time = time();

        // 如果没有配置百度翻译，自动使用兼容的拼音方案
        if (empty($appid) || empty($key)) {
            return $this->pinyin($text);
        }

        // 根据文档，生成 sign
        // sha256(应用ID + input + salt + curtime + 应用密钥)
        $sign = hash('sha256', $appid.$this->truncate($text).$salt.$time.$key);

        $response = Http::asForm()->post($api, [
            'q' => $text,
            'from' => 'auto',
            'to' => 'en',
            'appKey' => $appid,
            'salt' => $salt,
            'sign' => $sign,
            'signType' => 'v3',
            'curtime' => time(),
        ])->json();

        // 尝试获取获取翻译结果
        if ((int) $response['errorCode'] === 0) {
            return Str::slug($response['translation'][0]);
        } else {
            // 如果百度翻译没有结果，使用拼音作为后备计划
            return $this->pinyin($text);
        }
    }

    public function truncate($q)
    {
        $length = $this->abslength($q);

        return $length <= 20 ? $q : (mb_substr($q, 0, 10).$length.mb_substr($q, $length - 10, $length));
    }

    public function abslength($str): bool|int
    {
        if (empty($str)) {
            return 0;
        }
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, 'utf-8');
        } else {
            preg_match_all('/./u', $str, $array);

            return count($array[0]);
        }
    }

    public function pinyin($text): string
    {
        return Str::slug(app(Pinyin::class)->permalink($text));
    }
}
