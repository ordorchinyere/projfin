<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class Course extends Model
{
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
