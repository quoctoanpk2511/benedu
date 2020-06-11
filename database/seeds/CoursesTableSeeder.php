<?php

use App\Course;
use Faker\Generator as Faker; 
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Course::create([
            'title' => 'Mathematical Analysis',
            'description' => 'Mathematical analysis is the branch of mathematics dealing with limits and related theories, such as differentiation, integration, measure, infinite series, and analytic functions.',
            'image' => $faker->image('public/storage/',400,300, 'abstract', false),
            'video' => $faker->image('public/storage/',400,300, 'abstract', false),
            'subject_id' => 1
        ]);
        Course::create([
            'title' => 'Linear Algebra',
            'description' => 'Linear algebra is central to almost all areas of mathematics. For instance, linear algebra is fundamental in modern presentations of geometry, including for defining basic objects such as lines, planes and rotations.',
            'image' => $faker->image('public/storage/',400,300, 'abstract', false),
            'video' => $faker->image('public/storage/',400,300, 'abstract', false),
            'subject_id' => 1
        ]);
        Course::create([
            'title' => 'Alternating Current',
            'description' => 'Alternating current (AC) is an electric current which periodically reverses direction, in contrast to direct current (DC) which flows only in one direction.',
            'image' => $faker->image('public/storage/',400,300, 'abstract', false),
            'video' => $faker->image('public/storage/',400,300, 'abstract', false),
            'subject_id' => 2
        ]);
        Course::create([
            'title' => 'C Programming',
            'description' => 'C is a general-purpose, procedural computer programming language supporting structured programming, lexical variable scope, and recursion, with a static type system.',
            'image' => $faker->image('public/storage/',400,300, 'abstract', false),
            'video' => $faker->image('public/storage/',400,300, 'abstract', false),
            'subject_id' => 6
        ]);
        // $limit = 10;

        // for ($i = 0; $i < $limit; $i++) {
        //     Course::create([
        //         'title' => $faker->jobTitle,
        //         'description' => $faker->text($maxNbChars = 100),
        //         'image' => $faker->image('public/storage/',400,300, 'abstract', false),
        //         'video' => $faker->image('public/storage/',400,300, 'abstract', false),
        //         'subject_id' => rand(1,7),
        //     ]);
        // }
    }
}
