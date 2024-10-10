<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class VaccineSlot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'vaccine_center_id',
        'vaccination_date',
    ];

    /**
     * A Vaccine Slot only belongs to a single User
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo $user
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
