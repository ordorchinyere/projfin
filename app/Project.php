<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use App\Course;

class Project extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'issue_date' => 'datetime',
    ];

    public function supervisor()
    {
        return $this->hasOne(User::class, 'id', 'supervisor_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
