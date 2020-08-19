<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class EmailCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $req = request()->all();
        $user_type = '';
        if(array_key_exists('matriculation_number', $req)){
            $user_type = 'student';
        } 
        elseif(array_key_exists('staff_id', $req)){
            $user_type = 'staff';
        }
        
        $email = explode('@', $value);

        if($user_type === 'student' && $email[1] !== 'stu.cu.edu.ng'){
            return false;
        } else if($user_type === 'staff' && $email[1] !== 'covenantuniversity.edu.ng') {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid CU email.';
    }
}