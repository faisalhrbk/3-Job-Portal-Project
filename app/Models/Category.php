<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    //todo Scopes

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
