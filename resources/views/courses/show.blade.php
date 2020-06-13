@extends('layouts.master')

@section('content')
<div class="courses_details_banner">
         <div class="container">
             <div class="row">
                 <div class="col-xl-6">
                     <div class="course_text">
                            <h3>{{ $course->title }}</h3>
                            @php
                                $star = \App\Votes::where(['course_id' => $course->id])->avg('star') ;
                                $starInt = round($star);
                                $starFloat=round($star,1);
                            @endphp
                            <div class="stars mt-2 mb-3" style="font-size: 20px;">
                                @for ($i = 0; $i < $starInt; $i++)
                                    <span class='fa fa-star checked' ></span>
                                @endfor
                                @for ($i = $starInt; $i < 5; $i++)
                                    <span class='fa fa-star' style="color : white" ></span>
                                @endfor
                                
                                @if ( \App\Votes::where(['course_id' => $course->id]) )
                                    <span class="indexVote">{{$starFloat}}</span>
                                @else
                                    <span class="indexVote">0.0</span>
                                @endif
                            </div>
                            <div class="hours">
                                <div class="video">
                                     <div class="single_video">
                                            <i class="fa fa-play-circle-o"></i> <span>{{$course->lessons->count()}} Lessons</span>
                                     </div>
                                     <div class="single_video">
                                            <i class="fa fa-clock-o"></i> <span>{{rand(1,10)}} Hours</span>
                                     </div>
                                   
                                </div>
                            </div>
                            <br>
                            @auth
                            @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $course->id) )
                                <a href="#" class="boxed_btn start-btn">CONTINUE</a>
                            @else
                                <button class="boxed_btn start-btn" onclick="handle()">START</button>
                            @endif
                            @endauth
                     </div>
                 </div>
             </div>
         </div>
    </div>

<div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="joinCourseForm" action="{{ route('enrollments.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @auth
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Join Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <!-- <p class="text-center text-bold">
                    The price of course is <b>${{$course->cost}}</b>
                </p> -->
                <p class="text-center text-bold">
                    Are you sure you want to join this course ?
                </p>
            </div>
            
            <input type="hidden" class="form-control" name="student_id" id="student_id" value="{{ Auth::user()->id }}">
            <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{ $course->id }}">

            <input type="hidden" class="form-control" name="course_cost" id="course_cost" value="{{ $course->cost }}">
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, I'm sure</button>
            </div>
            </div>
            @endauth
        </form>
    </div>
</div>

<div class="courses_details_info">
        <div class="container">
            <div class="row">   
                <div class="col-xl-7 col-lg-7">

                    @auth
                    @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $course->id) )
                    <div class="single_courses outline_courses_info mt-5">
                        <h3 >Lesson</h3>
                        <div id="accordion">
                            @foreach ($course->lessons as $lesson)
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#{{$lesson->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="flaticon-question"></i> {{$lesson->title}}
                                            </button>
                                        </h5>
                                    </div>
                                    @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $course->id) )
                                        <div id="{{$lesson->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <a href="{{$lesson->description}}" target="_blank">
                                                {{$lesson->description}}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                        <h3 class="pt-4">Enroll this course to see more awesome content !</h3>
                    @endif
                    @endauth
                    @guest
                    <h3 class="pt-4">Please log in to see this course !</h3>
                    @endguest
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="courses_sidebar">
                        <div class="video_thumb">
                            <img src="{{ asset('storage/'.$course->image) }}" alt="">
                            <a class="popup-video" href="https://www.youtube.com/watch?v=AjgD3CvWzS0">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                        <div class="author_info">
                            <div class="auhor_header">
                                
                                <div class="name">
                                    <h2>People Enrolled</h2>
                                    <br>
                                    <h2 >{{ \App\Enrollment::where(['course_id' => $course->id])->count() }}</h2>
                                </div>
                            </div>
                            
                        </div>
                        <!-- author info Shin -->
                        @auth
                        @if( \App\Http\Controllers\EnrollmentsController::checkEnroll(Auth::user()->id, $course->id) )
                        <div class="feedback_info">
                            <h2>Write your feedback</h2>
                            <p>Your rating</p>
                            <form action="{{ route('votes.store') }}" enctype="multipart/form-data" method = "POST">
                                @csrf
		                        <fieldset class='rate'>
                                    <input id='rate1-star5' type='radio' name='star' value='5' />
                                    <label for='rate1-star5' title='Excellent'>5</label>
                                    <input id='rate1-star4' type='radio' name='star' value='4' />
                                    <label for='rate1-star4' title='Good'>4</label>
                                    <input id='rate1-star3' type='radio' name='star' value='3' />
                                    <label for='rate1-star3' title='Satisfactory'>3</label>
                                    <input id='rate1-star2' type='radio' name='star' value='2' />
                                    <label for='rate1-star2' title='Bad'>2</label>
                                    <input id='rate1-star1' type='radio' name='star' value='1' />
                                    <label for='rate1-star1' title='Very bad'>1</label>
                                </fieldset>
                                @for ($i = 1; $i < 6; $i++)
                                    @if( \App\Http\Controllers\VotesController::checkVote(Auth::user()->id, $course->id) == $i )
                                        <script>document.getElementById("rate1-star" + <?php echo $i; ?>).checked = true;</script>
                                        @break
                                    @endif
                                @endfor
                                <input type="hidden" class="form-control" name="student_id" id="student_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{ $course->id}}">
	  	                        <input type="submit" class="btn btn-primary d-block" value="Submit">
	                        </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function handle() {
            var form = document.getElementById('joinCourseForm')
            $('#joinModal').modal('show')
        }
    </script>
@endsection