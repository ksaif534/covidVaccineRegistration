<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,HasOne};
use App\Models\{VaccineCenter,VaccineSlot};

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vaccine_center_id',
        'nid',
        'name',
        'email',
        'is_dozed',
        'registration_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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
        ];
    }

    /**
     * A User belongs to a Vaccine Center
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo $vaccineCenter
     */
    public function vaccine_center() : BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class,'vaccine_center_id','id');
    }

    public function vaccine_slot() : HasOne
    {
        return $this->hasOne(VaccineSlot::class);
    }
}
