<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Jiannei\Response\Laravel\Support\Facades\Response;

class CaptchasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CaptchaRequest  $request
     * @param  CaptchaBuilder  $captchaBuilder
     * @return JsonResponse
     */
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder): JsonResponse
    {
        $key = Str::random(15);
        $cacheKey = 'captcha_'.$key;
        $phone = $request->input('phone');

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        Cache::put($cacheKey, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        return Response::success([
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $request->input('output', 'base64') === 'base64' ? $captcha->inline() : route('captchas.show', $key),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        //
    }
}
