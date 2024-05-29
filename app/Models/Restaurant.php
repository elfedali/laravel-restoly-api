<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'is_published',
        'comment_status',
        'ping_status',
        'published_at',
        'thumbnail',
        'phone',
        'phone_2',
        'phone_3',
        'reservation_required',
        'website_url',
        'address',
        'city',
        'country',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_published' => 'boolean',
        'comment_status' => 'boolean',
        'ping_status' => 'boolean',
        'published_at' => 'datetime',
        'reservation_required' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function demandes()
    {
        return $this->morphMany(Demande::class, 'demandeable');
    }

    public function pings()
    {
        return $this->morphMany(Ping::class, 'pingable');
    }

    public function metas()
    {
        return $this->morphMany(Meta::class, 'metaable');
    }
}
