<?php

namespace App\Models;

use App\Models\CukaiRegulation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cukai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function regulation()
    {
        return $this->belongsTo(CukaiRegulation::class);
    }
}
