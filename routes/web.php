<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/all-subjects', 'SubjectsController@showAll')->name('all-subjects');
Route::get('/all-courses', 'CoursesController@showAll')->name('all-courses');

Route::resources([
    'users' => 'UsersController',
    'subjects' => 'SubjectsController',
    'courses' => 'CoursesController',
    'enrollments' => 'EnrollmentsController',
]);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users', 'UsersController@index')->name('users.index');
    // Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    // Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    //Route::post('users/{user}/make-teacher', 'UsersController@makeTeacher')->name('users.make-teacher');
    // Route::get('subjects/create', 'SubjectsController@create')->name('subjects.create');
    // Route::get('courses/create', 'CoursesController@create')->name('courses.create');
    // Route::get('subjects/{subject}/edit', 'SubjectsController@edit')->name('subjects.edit');
    // Route::get('courses/{course}/edit', 'CoursesController@edit')->name('courses.edit');
});