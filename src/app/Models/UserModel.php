<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\UserModel
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserModel extends Authenticatable
{
    use  Notifiable;
protected $table = "t_user";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
 //   "email"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
