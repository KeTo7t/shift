<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialAccount
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $provider
 * @property string $provider_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\UserModel $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialAccount whereUserId($value)
 * @mixin \Eloquent
 */
class SocialAccount extends Model
{
    protected $table = 'social_accounts';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel');
    }
}