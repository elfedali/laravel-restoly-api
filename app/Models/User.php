<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metaable');
    }

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
