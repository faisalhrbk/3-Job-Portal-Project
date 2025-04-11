<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];
    function jobType()
    {
        return $this->belongsTo(JobType::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }


    //todo Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeKeywordSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%$keyword%")
                ->orWhere('keyWords', 'like', "%$keyword%");
        });
    }
}
