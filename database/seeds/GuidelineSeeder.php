<?php

use Illuminate\Database\Seeder;
use App\Guideline;
use App\Department;

class GuidelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = Department::get();

        foreach($departments as $department){
            $guideline = new Guideline;
            $guideline->name = 'Demo guide';
            $guideline->link = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';
            $guideline->department_id = $department->id;
            $guideline->save();
        }
    }
}
