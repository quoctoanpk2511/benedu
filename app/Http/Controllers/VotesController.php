<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Votes\CreateVotesRequest;
use App\Votes;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Votes::orderBy('created_at', 'desc')->get();
        return view('votes.index')->with('votes', $votes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVotesRequest $request)
    {
        // Votes::create([
        //     'star' => $request->star,
        //     'student_id' => $request->student_id,
        //     'course_id' => $request->course_id
            
        // ]);
        DB::table('votes')
            ->updateOrInsert(
                ['student_id' => $request->student_id, 'course_id' => $request->course_id],
                ['star' => $request->star]
    );
        
        // redirect back
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
    public function destroy($id)
    {
        //
    }

    public static function checkVote($current_id, $course_id)
    {   
        $votes = Votes::all();
        foreach($votes as $vote) {
            if(($vote->student_id == $current_id) && ($vote->course_id == $course_id))
                return $vote->star;
        }
        return 0;
    }
}
