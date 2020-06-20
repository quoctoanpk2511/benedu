<?php

namespace App\Http\Controllers;

use App\Learned;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Learned\CreateLearnedRequest;

class LearnedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('learneds.index')->with('learneds', Learned::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('learneds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLearnedRequest $request)
    {
        Learned::create([
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
            'course_id' => $request->course_id
        ]);
        return redirect()->back();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Learned $learned)
    {
        $learned->delete();

        session()->flash('success', 'Learned deleted successfully.');
        
        return redirect(route('learneds.index'));
    }

    public static function checkLearned($current_id, $lesson_id)
    {   
        $learneds = Learned::all();
        foreach($learneds as $learned) {
            if(($learned->student_id == $current_id) && ($learned->lesson_id == $lesson_id))
                return true;
        }
        return false;
    }

    public static function countLearned($current_id, $course_id)
    {   
        $count = Learned::where
        ([
            ['student_id', $current_id],
            ['course_id', $course_id],
        ])->count();
        return $count;
    }
}
