<?php

namespace App\Http\Controllers;

use App\Enrollment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Enrollments\CreateEnrollmentsRequest;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enrollments.index')->with('enrollments', Enrollment::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enrollments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEnrollmentsRequest $request)
    {
        Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id
        ]);
        // $current_wallet = User::where('id',$request->student_id)->first()->wallet;
        // $current_wallet = $current_wallet - $request->course_cost;
        // User::where('id',$request->student_id)->update(['wallet' => $current_wallet]);
        // session()->flash('success', 'Enrollment created successfully.');
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
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        session()->flash('success', 'Enrollment deleted successfully.');
        
        return redirect(route('enrollments.index'));
    }

    public static function checkEnroll($current_id, $course_id)
    {   
        $enrollments = Enrollment::all();
        foreach($enrollments as $enrollment) {
            if(($enrollment->student_id == $current_id) && ($enrollment->course_id == $course_id))
                return true;
        }
        return false;
    }
}
