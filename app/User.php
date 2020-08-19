<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Project;
use App\Department;
use App\Course;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'matriculation_number', 
        'department',
        'staff_id',
        'college',
        'course',
        'final_year',
        'level',
        'email',
        'user_type',
        'email', 
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'final_year' => 'boolean',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }

    public function userDepartment()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function userCourse()
    {
        return $this->belongsTo(Course::class, 'course');
    }
}
