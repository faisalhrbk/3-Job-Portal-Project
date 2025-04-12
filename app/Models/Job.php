<?php

namespace App\Models;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
function applications(){
    return $this->hasMany(JobApplication::class);
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
