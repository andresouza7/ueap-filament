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
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasName, FilamentUser, HasMedia
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, InteractsWithMedia;

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
        'person_id',
        'signature_url'
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
        'nickname',
        'profile_photo_url',
        'signature_url'
    ];

    public function getNicknameAttribute()
    {
        return collect(explode('.', $this->login))
            ->map(fn($part) => ucfirst(trim($part)))
            ->implode(' ');
    }

    public function getProfilePhotoUrlAttribute()
    {
        $filePath = "users/{$this->id}.jpg";

        if (Storage::exists($filePath)) {
            return Storage::url($filePath);
        }

        // Return a default image URL if the profile photo does not exist
        return asset('img/user-default.png'); // Or any default image URL you prefer
    }

    public function getSignatureUrlAttribute()
    {
        // return $this->getFirstMediaUrl('signatures');
        if (file_exists(public_path('storage/signatures/' . $this->uuid . '.jpg'))) {
            return public_path('storage/signatures/' . $this->uuid . '.jpg');
        }

        return null;
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

        if ($panel->getId() === 'rh') {
            return $this->hasRole('dinfo|urh');
        }

        if ($panel->getId() === 'site') {
            return $this->hasRole('dinfo|ascom');
        }

        if ($panel->getId() === 'transparencia') {
            return $this->hasRole('dinfo|uc|cpl');
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

    public function canManageDocument(Document $document): bool
    {
        $categoryGroups = $document->category->groups->pluck('name');
        return $this->hasAnyRole($categoryGroups->toArray());
    }
}
