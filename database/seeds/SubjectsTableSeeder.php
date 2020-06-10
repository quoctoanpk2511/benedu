<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Mathematics'
        ]);
        Subject::create([
            'name' => 'Physics'
        ]);
        Subject::create([
            'name' => 'Chemistry'
        ]);
        Subject::create([
            'name' => 'History'
        ]);
        Subject::create([
            'name' => 'Geography'
        ]);
        Subject::create([
            'name' => 'IT'
        ]);
        Subject::create([
            'name' => 'Japanese'
        ]);
        Subject::create([
            'name' => 'English'
        ]);
    }
}
