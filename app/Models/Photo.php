<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file', 
        'description'// Add 'file' to the $fillable array
        // other fillable attributes...
    ];

    // PST FUNCTION BOOT()
    // parent::boot();
    // static::creating(function ($model) {
    //     if (empty($model->uuid)) {
    //         $model->uuid = (string) Str::uuid();
    //     }
    // });
}
