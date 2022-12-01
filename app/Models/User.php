<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use Traits\LastActivedAtHelper;
    use HasRoles;
    use Notifiable {
        notify as protected laravelNotify;
    }
    use Traits\ActiveUserHelper;
    use Traits\HasDateTimeFormatter;
    use Traits\HashIdHelper;

    public function notify($instance)
    {
        // 如果需要通知的人是当前用户，就不必通知了
        if ($this->id === Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需要提醒，直接发送 Mail 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'gender',
        'birthday',
        'avatar',
        'password',
        'introduction',
        'weixin_openid',
        'weixin_unionid',
        'registration_id',
        'current_team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'weixin_openid',
        'weixin_unionid',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_actived_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'avatar_link',
        'hash_id',
    ];

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model): bool
    {
        return $this->id === $model->user_id;
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get the entity's notifications.
     *
     * @return MorphMany
     */
    public function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable')->latest();
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * 查找给定用户名的用户实例。
     *
     * @param  string  $username
     * @return User|null
     */
    public function findForPassport(string $username): ?User
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ? $credentials['email'] = $username : $credentials['phone'] = $username;

        return self::where($credentials)->first();
    }

    public function avatarLink(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->avatar) {
                    return Storage::url($this->avatar);
                } else {
                    $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
                        return mb_substr($segment, 0, 1);
                    })->join(' '));

                    return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
                }
            }
        );
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                // 如果值的长度等于 60，即认为是已经做过加密的情况
                // 不等于 60，做密码加密处理
                return Str::length($value) !== 60 ? Hash::make($value) : $value;
            }
        );
    }
}
