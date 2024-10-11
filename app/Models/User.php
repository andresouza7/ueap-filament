<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasName, FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'uuid',
        'enrollment',
        'login',
        'effective_role_id',
        'commissioned_role_id',
        'group_id',
        'person_id'
    ];

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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'profile_photo_url'
    ];

    public function getProfilePhotoUrlAttribute()
    {
        // return asset('img/hacker.png');
        return "https://picsum.photos/200";
    }

    public function getFilamentName(): string
    {
        return $this->login ?? 'user';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('dinfo');
        }

        // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function groups() //groups
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function effective_role()
    {
        return $this->belongsTo(EffectiveRole::class, 'effective_role_id');
    }

    public function commissioned_role()
    {
        return $this->belongsTo(CommissionedRole::class, 'commissioned_role_id');
    }

    public function record() // registro funcional
    {
        // uuid column must be referenced because it is not the primary key in users table
        return $this->hasOne(UserRecord::class, 'user_uuid', 'uuid');
    }

    public function ordinances()
    {
        // Access the ordinances through the related person
        return $this->person->ordinances();
    }

    public function calendar_occurrences()
    {
        return $this->hasMany(CalendarOccurrence::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(SocialPost::class, 'user_id');
    }
}
