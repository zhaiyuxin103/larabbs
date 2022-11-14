<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;
use Jiannei\Response\Laravel\Support\Facades\Response;

class UsersController extends Controller
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
     * @param  UserRequest  $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $cacheKey = 'verification_code_'.$request->input('verification_key');
        $verifyData = Cache::get($cacheKey);

        if (! $verifyData) {
            return Response::fail('验证码已失效', 403);
        }

        if (! hash_equals((string) $verifyData['code'], $request->input('verification_code'))) {
            // 返回 401
            return Response::fail('验证码错误', 401);
        }

        if ($request->input('avatar_image_id')) {
            $image = Image::find($request->input('avatar_image_id'));

            $avatar = $image->path;
        }

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'phone' => $verifyData['phone'],
            'email' => $request->input('email'),
            'avatar' => $avatar ?? null,
            'gender' => $request->input('gender'),
            'birthday' => $request->date('birthday'),
            'password' => $request->input('password'),
            'introduction' => $request->input('introduction'),
            'current_team_id' => Team::inRandomOrder()->value('id'),
        ]);

        // 清除验证码缓存
        Cache::forget($cacheKey);

        return Response::success((new UserResource($user))->showSensitiveFields());
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @param  Request  $request
     * @return JsonResponse
     */
    public function show(User $user, Request $request): JsonResponse
    {
        return Response::success(new UserResource($user));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse|JsonResource
     */
    public function me(Request $request): JsonResponse|JsonResource
    {
        return Response::success((new UserResource($request->user()))->showSensitiveFields());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @return JsonResponse
     */
    public function update(UserRequest $request): JsonResponse
    {
        $user = $request->user();

        $attributes = [];

        foreach (['name', 'username', 'phone', 'email', 'gender', 'birthday', 'introduction'] as $value) {
            $request->whenFilled($value, function ($input) use (&$attributes, $value) {
                $attributes[$value] = $input;
            });
        }
        if ($request->input('avatar_image_id')) {
            $image = Image::find($request->input('avatar_image_id'));

            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return Response::success((new UserResource($user))->showSensitiveFields());
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
