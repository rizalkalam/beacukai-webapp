<?php

namespace App\Models;

use App\Models\KepabeananRegulation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kepabeanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function regulation()
    {
        return $this->belongsTo(KepabeananRegulation::class);
    }
}
