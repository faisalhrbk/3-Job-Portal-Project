<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobType extends Model
{
    use HasFactory;
    protected $guarded = [];


    //todo Scopes

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
