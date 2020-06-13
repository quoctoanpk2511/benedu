@extends('layouts.master')

@section('content')
<div class="slider_area ">
    <div class="bradcam_area breadcam_bg overlay2">
        <h3>Search Result</h3>
    </div>
</div>

<div class="container">
    @if(isset($details))
    <div class="container mt-4">
        <div class="popular_courses">
            <div class="all_courses">
                <div class="container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                @foreach($details as $course)
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection