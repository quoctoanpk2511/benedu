<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Http\Requests\Subjects\UpdateSubjectsRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects =  Subject::orderBy('created_at', 'desc')->paginate(5);
        return view('subjects.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect(route('home'));
            
        }
            return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {

        Subject::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Subject created successfully.');
        return redirect(route('subjects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subjects.show')->with('subject', $subject)->with('courses', Course::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect(route('home'));
        }
        return view('subjects.create')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectsRequest $request, Subject $subject)
    {
        $subject->update([
            'name' => $request->name
        ]);
        session()->flash('success', 'Subject updated successfully.');
        return redirect(route('subjects.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if ($subject->courses->count() > 0) {
            session()->flash('success', 'Subject cannot be deleted because it has some courses.');
            return redirect(route('subjects.index'));
        }
        $subject->delete();
        session()->flash('success', 'Subject deleted successfully.');
        return redirect(route('subjects.index'));
    }

    public function showAll()
    {
        return view('subjects.showAll')->with('subjects', Subject::all());
    }
}
