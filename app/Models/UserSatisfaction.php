<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSatisfaction extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'value'];
    protected $dates = ['date'];
    protected $casts = [
        'date' => 'datetime',
    ];
}
