<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    function job(){
        return $this->belongsTo(Job::class);
    }
}
