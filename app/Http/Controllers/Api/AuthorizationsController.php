<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Overtrue\LaravelSocialite\Socialite;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizationsController extends AccessTokenController
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
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServerRequestInterface  $request
     * @return JsonResponse
     */
    public function store(ServerRequestInterface $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->getParsedBody(), [
                'grant_type' => ['required', 'string', 'in:password,wechat-social'],
                'client_id' => ['required', 'string', 'exists:oauth_clients,id'],
                'client_secret' => ['required', 'string', 'exists:oauth_clients,secret'],
                'username' => ['required_without:code', 'string'],
                'password' => ['required_without:code', 'alpha_dash', 'min:6'],
                'code' => ['required_without:username,password', 'string'],
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors()->getMessages();

                return Response::fail(Arr::first(Arr::first($messages)), 422, $messages);
            }

            return Response::success(json_decode($this->issueToken($request)->getContent()))->setStatusCode(201);
        } catch (OAuthServerException $exception) {
            Response::fail('用户名或密码错误', 401);
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }

    public function socialStore($type, SocialAuthorizationRequest $request): JsonResponse|JsonResource
    {
        $driver = Socialite::create($type);

        try {
            if ($code = $request->input('code')) {
                $oauthUser = $driver->userFromCode($code);
            } else {
                // 微信需要增加 openid
                if ($type === 'wechat') {
                    $driver->withOpenid($request->input('openid'));
                }

                $oauthUser = $driver->userFromToken($request->input('access_token'));
            }
        } catch (\Exception $exception) {
            Response::fail('参数错误，未获取用户信息', 422);
        }

        if (! $oauthUser->getId()) {
            Response::fail('参数错误，未获取用户信息', 422);
        }

        switch ($type) {
            case 'wechat':
                $unionid = $oauthUser->getRaw()['unionid'] ?? null;
                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                // 没有用户时，默认创建用户
                if (! $user) {
                    $user = User::create([
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }

                break;
        }

        return Response::success([
            'token' => $user->id,
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServerRequestInterface  $request
     * @return JsonResponse
     */
    public function update(ServerRequestInterface $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->getParsedBody(), [
                'grant_type' => ['required', 'string', 'in:refresh_token'],
                'client_id' => ['required', 'string', 'exists:oauth_clients,id'],
                'client_secret' => ['required', 'string', 'exists:oauth_clients,secret'],
                'refresh_token' => ['required'],
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors()->getMessages();

                return Response::fail(Arr::first(Arr::first($messages)), 422, $messages);
            }

            return Response::success(json_decode($this->issueToken($request)->getContent()));
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            if (Auth::guard('api')->check()) {
                $tokenRepository = app(TokenRepository::class);
                // Revoke an access token...
                $tokenRepository->revokeAccessToken($request->user()->tokens()->value('id'));

                return Response::noContent();
            }
        } catch (Exception $exception) {
            Response::fail($exception->getMessage());
        }
    }
}
