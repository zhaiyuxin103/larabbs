<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\InvalidArgumentException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|JsonResource
     */
    public function index(): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VerificationCodeRequest $request
     * @param EasySms $easySms
     * @return JsonResponse|JsonResource
     *
     * @throws InvalidArgumentException
     */
    public function store(VerificationCodeRequest $request, EasySms $easySms): JsonResponse|JsonResource
    {
        $phone = $request->phone;

        if (app()->environment(['local'])) {
            $code = 1234;
        } else {
            // 生成 4 位随机数，左侧补 0
            $code = Str::padLeft(random_int(1, 9999), 4, 0);

            try {
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code,
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception) {
                Response::fail($exception->getException('aliyun')->getMessage());
            }
        }

        $key = 'verification_code_'.Str::random(15);
        $expiredAt = now()->addMinutes(5);
        // 缓存验证码 5 分钟过期
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        return Response::success([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|JsonResource
     */
    public function show(int $id): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param int $id
     * @return JsonResponse|JsonResource
     */
    public function update(Request $request, int $id): JsonResponse|JsonResource
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse|JsonResource
     */
    public function destroy(int $id): JsonResponse|JsonResource
    {
        //
    }
}
