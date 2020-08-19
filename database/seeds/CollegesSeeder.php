<?php

use Illuminate\Database\Seeder;
use App\College;
use App\Department;
use App\Course;

class CollegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleges = [
            'College of Business and Social Sciences' => [
                'departments' => [
                    'Accounting' => [
                        'courses' => [
                            'Accounting',
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/Accounting.jpg',
                    ],
                    'Banking and Finance' => [
                        'courses' => [
                            'Banking and Finance'
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/Banking_and_Finance.jpg',
                    ],
                    'Business Management' => [
                        'courses' => [
                            'Business Management',
                            'Industrial Relations & Human Resource Management',
                            'Marketing',
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/Business_management.jpg',
                    ],
                    'Economics and Development Studies' => [
                        'courses' => [
                            'Economics',
                            'Demography and Social Statistics',
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/Economics.jpg',
                    ],
                    'Mass Communication' => [
                        'courses' => [
                            'Mass Communication',
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/Mass_Communication.jpg',
                    ],
                    'Sociology' => [
                        'courses' => [
                            'Sociology'
                        ],
                        'image' => 'images/colleges/Business_and_social_sciences/sociology.jpg',
                    ],
                ],
            ],
           'College of Engineering' => [
               'departments' => [
                   'Chemical Engineering' => [
                       'courses' => [
                           'Chemical Engineering'
                       ],
                       'image' => 'images/colleges/College_of_Engineering/Chemical_Engineering.jpg'
                    ],
                    'Petroleum Engineering' => [
                        'courses' => [
                            'Petroleum Engineering'
                        ],
                        'image' => 'images/colleges/College_of_Engineering/Petroleum_Engineering.jpg'
                    ],
                    'Electrical & Information Engineering (EIE)' => [
                        'courses' => [
                            'Computer Engineering',
                            'Electrical and Electronics Engineering',
                            'Information and Communication Engineering',
                        ],
                        'image' => 'images/colleges/College_of_Engineering/Electrical_and_Informaation_Engineerin.jpg'
                    ],
                    'Civil Engineering' => [
                        'courses' => [
                            'Civil Engineering',
                        ],
                        'image' => 'images/colleges/College_of_Engineering/Civil_Engineering.jpg'
                    ],
                    'Mechanical Engineering' => [
                        'courses' => [
                            'Mechanical Engineering'
                        ],
                        'image' => 'images/colleges/College_of_Engineering/Mechanical_Engineering.jpg'
                    ],
                ],
            ],
            'College of Leadership Development' => [
                'departments' => [
                    'Languages and General Studies' => [
                        'courses' => [
                            'English',
                            'French',
                        ],
                        'image' => 'images/colleges/Leadership_and_Develpment_studies/Languages.jpg'
                    ],
                    'Psychology' => [
                        'courses' => [
                            'Psychology',
                        ],
                        'image' => 'images/colleges/Leadership_and_Develpment_studies/Psychology.jpg'
                    ],
                    'Political Science & International Relations' => [
                        'courses' => [
                            'International Relations',
                            'Political Science',
                            'Policy and Strategic Studies',
                        ],
                        'image' => 'images/colleges/Leadership_and_Develpment_studies/Political_science.jpg'
                    ],
                ],
            ],
            'College of Science and Technology' => [
                'departments' => [
                    'Industrial Physics' => [
                        'courses' => [
                            'Industrial Physics -Applied Geophysics',
                            'Industrial Physics - Electronics and Information Technology Applications',
                            'Industrial Physics - Renewable Energy',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Physics.jpg'
                    ],
                    'Building Technology' => [
                        'courses' => [
                            'Building Technology',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Building_Technology.jpg',
                    ],
                    'Chemistry' => [
                        'courses' => [
                            'Chemistry',
                            'Industrial Chemistry - Pure',
                            'Industrial Chemistry - (Analytical/Environmental Option)',
                            'Industrial Chemistry - (Polymer/Material Option)',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Chemistry.jpg',
                    ],
                    'Mathematics' => [
                        'courses' => [
                            'Industrial Mathematics',
                            'Industrial Mathematics-Computer Science Option',
                            'Industrial Mathematics-Statistics Option',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Mathematics.jpg',
                    ],
                    'Biochemistry' => [
                        'courses' => [
                            'Biochemistry',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Biochemistr.jpg',
                    ],
                    'Computer & Information Sciences' => [
                        'courses' => [
                            'Computer Science',
                            'Management and Information Science',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Computer_Science.jpg',
                    ],
                    'Architecture' => [
                        'courses' => [
                            'Architecture',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Architecture.jpg',
                    ],
                    'Estate Management' => [
                        'courses' => [
                            'Estate Management',
                            'Management and Information Science',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Estate_Management.jpg',
                    ],
                    'Biological Sciences' => [
                        'courses' => [
                            'Applied Biology and Biotechnology',
                            'Animal and Environmental Biology',
                            'Microbiology',
                        ],
                        'image' => 'images/colleges/Science_and_Technology/Biological_scicences.jpg',
                    ]
                ],
            ],
        ];

        foreach($colleges as $key => $college){
            $c = new College;
            $c->name = $key;
            $c->save();

            $departments = $colleges[$key]['departments'];

            foreach($departments as $depKey => $department){
                $d = new Department;
                $d->college_id = $c->id;
                $d->name = $depKey;
                $d->image = $departments[$depKey]['image'];
                $d->save();
                $courses = $departments[$depKey]['courses'];

                foreach($courses as $couKey => $course){
                    $cou = new Course;
                    $cou->department_id = $d->id;
                    $cou->name = $course;
                    $cou->save();
                }
            }
        }
    }
}
