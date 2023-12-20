<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::create([
            'email' => 'admin@superuser.com',
            'password' => Hash::make('password'),
            'is_activated' => true,
        ]);

        $user->contact()->create([
            'first_name' => 'Admin',
            'last_name' => 'Superuser',
            'is_admin' => true,
            'address' => 'Cebu City',
        ]);


        $schoolYear = \App\Models\SchoolYear::create([
            'name' => '2021-2022',
        ]);

        $department = \App\Models\Department::create([
            'name' => 'Department of Information and Communications Technology',
            'person_in_charge' => 'Mr. John Doe',
        ]);


        $section = \App\Models\Section::create([
            'name' => 'Information Technology',
            'school_year_id' => $schoolYear->id,
        ]);

        $studentUser = User::create([
            'email' => 'student@sample.com',
            'password' => Hash::make('password'),
            'is_activated' => true,
        ]);

        $studentUser->contact()->create([
            'first_name' => 'Student',
            'last_name' => 'Sample',
            'is_admin' => false,
            'is_student' => true,
            'user_id' => $studentUser->id,
            'address' => 'Cebu City',
            'section_id' => $section->id,
        ]);

        $teacherUser = User::create([
            'email' => 'teacher@sample.com',
            'password' => Hash::make('password'),
            'is_activated' => true,
        ]);

        $teacherUser->contact()->create([
            'first_name' => 'Teacher',
            'last_name' => 'Sample',
            'is_admin' => false,
            'is_teacher' => true,
            'user_id' => $teacherUser->id,
            'address' => 'Cebu City',
            'section_id' => $section->id,
            'department_id' => $department->id,
        ]);

        $subject = \App\Models\Subject::create([
            'name' => 'Web Development',
            'code' => 'WEBDEV',
            'subject_description' => 'Web Development',
            'contact_id' => $teacherUser->contact->id,
            'section_id' => $section->id,
            'subject_code' => 'WEBDEV',
            'number_of_units' => "3",
        ]);


    }
}
