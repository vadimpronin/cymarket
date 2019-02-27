<?php

namespace CyMarket;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * CyMarket\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $telegram_username
 * @property int|null $telegram_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\CyMarket\UserChat[] $userChats
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereTelegramUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CyMarket\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telegram_id', 'telegram_username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userChats()
    {
        return $this->hasMany(UserChat::class);
    }
}
