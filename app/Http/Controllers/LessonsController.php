<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;

use Illuminate\Http\Request;
use App\Http\Requests\Lessons\CreateLessonsRequest;
use App\Http\Requests\Lessons\UpdateLessonsRequest;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson = Lesson::orderBy('created_at', 'desc')->paginate(8);
        return view('lessons.index')->with('lessons', $lesson);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->isStudent()) {
            return redirect(route('home'));
        }
        return view('lessons.create')->with('courses', Course::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLessonsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        if (auth()->user()->isStudent()) {
            return redirect(route('home'));
        }
        return view('lessons.edit')->with('lesson', $lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonsRequest $request, Lesson $lesson)
    {
        $data = $request->only(['title', 'description']);
        
        $lesson->update($data);

        session()->flash('success', 'Lesson updated successfully.');
        // redirect user
        return redirect(route('lessons.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        session()->flash('success', 'Lesson deleted successfully.');
        return redirect(route('lessons.index'));
    }
}
