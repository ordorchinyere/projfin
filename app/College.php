<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;

class College extends Model
{
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
