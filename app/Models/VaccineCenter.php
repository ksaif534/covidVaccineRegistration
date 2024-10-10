<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class VaccineCenter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'center_name',
        'center_limit'
    ];

    /**
     * A Vaccine Center can have many users
     * @return Illuminate\Database\Eloquent\Relations\HasMany $users
     */
    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
