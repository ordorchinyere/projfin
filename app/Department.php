<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\College;
use App\Guideline;
use App\Project;

class Department extends Model
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function college(){
        return $this->belongsTo(College::class);
    }

    public function guideline()
    {
        return $this->hasOne(Guideline::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
