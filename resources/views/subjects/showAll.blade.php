@extends('layouts.master')

@section('content')
<div class="slider_area ">
    <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="slider_info mt-5">
                    <h3>Over 50 <br>
                        Subjects Online</h3>
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
                            <h3>All Subjects</h3>
                            <p>Explore our programs and courses, try an exercise or two<br> 
                        and join our community of 45 million learners.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all_courses">
                <div class="container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                @foreach($subjects as $subject)
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                        <div class="single_courses">
                                            <div class="thumb">
                                                <a href="{{ route('subjects.show', $subject->id) }}">
                                                </a>
                                            </div>
                                            <div class="courses_info">
                                                <h3><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></h3>
                                                <div class="star_prise d-flex justify-content-between">
                                                    <!-- <div class="star">
                                                        <i class="flaticon-mark-as-favorite-star"></i>
                                                        <span>{{rand(40, 50) / 10 }}</span>
                                                    </div> -->
                                                    <div class="prise">
                                                        <span class="active_prise">Number of courses:  </span>
                                                        <span class="active_prise">
                                                        {{ $subject->courses->count() }}
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
                                        <!-- <a href="#" class="boxed_btn_rev">More Subjects</a> -->
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