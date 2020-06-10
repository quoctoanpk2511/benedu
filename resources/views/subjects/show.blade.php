@extends('layouts.master')

@section('content')
<div class="slider_area ">
    <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="slider_info mt-5">
                    <h3>Learn your <br>
                        Favorite Course <br>
                        From Online</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="container mt-4">
        <div class="popular_courses">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title text-center mb-100">
                            <h3>{{ $subject->name }}</h3>
                            <p>Your domain control panel is designed for ease-of-use and <br> allows for all aspects of your
                                domains.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all_courses">
                <div class="container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                @foreach($subject->courses as $course)
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                        <div class="single_courses">
                                            <div class="thumb">
                                                <a href="{{ route('courses.show', $course->id) }}">
                                                    <img src="{{ asset('storage/'.$course->image) }}"  width="340px" height="191px">
                                                </a>
                                            </div>
                                            <div class="courses_info">
                                                <span>{{ $course->subject->name }}</span>
                                                <h3><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h3>
                                                <div class="star_prise d-flex justify-content-between">
                                                    <div class="star">
                                                        <i class="flaticon-mark-as-favorite-star"></i>
                                                        @php
                                                            $star = \App\Votes::where(['course_id' => $course->id])->avg('star') ;
                                                            $starFloat=round($star,1);
                                                        @endphp
                                                        <span>{{$starFloat }}</span>
                                                    </div>
                                                    <div class="prise">
                                                        <span class="active_prise">
                                                            ${{$course->cost}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                <div class="col-xl-12">
                                        <div class="more_courses text-center">
                                            <a href="#" class="boxed_btn_rev">More Courses</a>
                                        </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection