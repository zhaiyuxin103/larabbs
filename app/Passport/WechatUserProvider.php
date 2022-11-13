<?php

namespace App\Passport;

use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Overtrue\LaravelSocialite\Socialite;
use Psr\Http\Message\ServerRequestInterface;
use Sk\Passport\UserProvider;

class WechatUserProvider extends UserProvider
{
    public function validate(ServerRequestInterface $request)
    {
        $this->validateRequest($request, [
            'code' => ['required_without:access_token', 'string'],
            'access_token' => ['required_without:code', 'string'],
            'openid' => ['required_without:code', 'string'],
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function retrieve(ServerRequestInterface $request)
    {
        $inputs = $this->only($request, [
            'code',
            'access_token',
            'openid',
        ]);

        $driver = Socialite::create('wechat');
        try {
            if ($code = $inputs['code']) {
                $oauthUser = $driver->userFromCode($code);
            } else {
                $driver->withOpenid($inputs['openid']);

                $oauthUser = $driver->userFromToken($inputs['access_token']);
            }
        } catch (Exception $exception) {
            throw new AuthorizationException($exception->getMessage());
        }

        if (! $oauthUser->getId()) {
            throw new AuthorizationException('参数错误，未获取用户信息');
        }

        $unionid = $oauthUser->getRaw()['unionid'] ?? null;

        if ($unionid) {
            $user = User::where('weixin_unionid', $unionid)->first();
        } else {
            $user = User::where('weixin_openid', $oauthUser->getId())->first();
        }

        // 没有用户，默认创建一个用户
        if (! $user) {
            $user = User::create([
                'name' => $oauthUser->getNickName(),
                'avatar' => $oauthUser->getAvatar(),
                'weixin_openid' => $oauthUser->getId(),
                'weixin_unionid' => $unionid,
            ]);
        }

        return $user;
    }
}
