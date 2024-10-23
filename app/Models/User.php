<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements LaratrustUser
{
    use HasFactory, Notifiable, HasApiTokens , HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /*protected $fillable = [
        'name',
        'email',
        'password',
    ];*/
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts()
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($thisModelObject) {
            $thisModelObject->destroyImage($thisModelObject, 'pic');
        });
    }
    public function destroyImage($modelObject, $key = 'image')
    {
        if (is_array($modelObject)) {
            if ($modelObject[$key] && file_exists(public_path($modelObject[$key]))) {
                unlink(public_path($modelObject[$key]));
            }
        } else {
            if ($modelObject->$key && file_exists(public_path($modelObject->$key))) {
                unlink(public_path($modelObject->$key));
            }
        }
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
