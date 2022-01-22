<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasRolesAndAbilities;
    use InteractsWithMedia;


    public const MEDIA_COL_PROFILE = 'profile';
    public const MEDIA_CON_THUMB = 'thumb';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_test_account' => 'bool',
    ];

    protected $appends = ['profile_picture', 'full_name'];


    /**
     * @todo social images
     */
    public function getProfilePictureAttribute()
    {
        $profilePic = $this->getMedia(static::MEDIA_COL_PROFILE)->first();
        if ($profilePic) {
            return $profilePic->getUrl(static::MEDIA_CON_THUMB);
        }

        return asset('images/no_pic.png');
    }


    public function getFullNameAttribute()
    {
        return sprintf(
            '%s %s',
            $this->attributes['first_name'] ?? '',
            $this->attributes['last_name'] ?? ''
        );
    }


    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function userSocialAccounts()
    {
        return $this->hasMany(UserSocialAccount::class);
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class)->withDefault();
    }
}
