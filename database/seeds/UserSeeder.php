<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new User;
        $superAdmin->first_name = 'Oluchi';
        $superAdmin->last_name = 'Ordor';
        $superAdmin->staff_id = '3432WEF';
        $superAdmin->email = 'admin@covenantuniversity.edu.ng';
        $superAdmin->password = bcrypt('12345');
        $superAdmin->user_type = 'super_admin';
        $superAdmin->save();

        $finalYearStudent = new User;
        $finalYearStudent->first_name = 'Chinyere';
        $finalYearStudent->last_name = 'Ordor';
        $finalYearStudent->email = 'berry@stu.cu.edu.ng';
        $finalYearStudent->password = bcrypt('12345');
        $finalYearStudent->user_type = 'student';
        $finalYearStudent->matriculation_number = '1345';
        $finalYearStudent->college = '1';
        $finalYearStudent->department = '1';
        $finalYearStudent->course = '1';
        $finalYearStudent->final_year = '1';
        $finalYearStudent->level = '400';
        $finalYearStudent->save();
    }
}
