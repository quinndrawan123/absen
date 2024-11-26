<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


     
    protected $fillable = [
        'user_id',
        'date',
        'check_in',
    ];

    /**
     * Get the user associated with the absen record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
