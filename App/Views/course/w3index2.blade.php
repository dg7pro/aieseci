@extends('lays.app')

@section('content')

    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-4 pb-sm-4">
                <h4 class="inner-text-title pt-5">Courses</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{'/'}}">Home</a></li>
                    <li class="active"><i class="fas fa-angle-right"></i>Courses</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <!-- courses section -->
    <div class="w3l-grids-block-5 py-5">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">Best Courses</p>
                <h3 class="title-style">Find The Right Course For You</h3>
            </div>
            <div class="row justify-content-center">
                @foreach($groups as $group)
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="coursecard-single">
                        <div class="grids5-info position-relative">
                            <img src="{{'assets/images/'.$group['intro_img']}}" alt="" class="img-fluid" />
                            <div class="meta-list">
                                <a href="{{'/course/details?cid='.$group['id']}}" class="{{'sec-'.$group['sec']}}">{{$group['short']}}</a>
                            </div>
                        </div>
                        <div class="content-main-top">
                            <div class="content-top mb-4 mt-3">
                                <ul class="list-unstyled d-flex align-items-center justify-content-between">
                                    <li> <i class="fas fa-book-open"></i> Duration: {{$group['term'].''.$group['tenure']}}</li>
                                    <li> <i class="fas fa-star"></i> 4.5</li>
                                </ul>
                            </div>
                            <h4><a href="{{'/course/details?cid='.$group['id']}}">{{$group['name']}}</a></h4>
                            <p>{!! $group['intro'] !!}</p>
                            <div class="top-content-border d-flex align-items-center justify-content-between mt-4 pt-4">
                                {{--<h6>$42.00</h6>--}}
                                <h6>&#8377; {{$group['fees']/1000}} K</h6>
                                <a class="btn btn-style-primary" href="{{'/course/details?cid='.$group['id']}}">Know Details<i
                                            class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>



            <!-- pagination -->
            <div class="pagination-style text-center mt-5">
                <ul>
                    <li> <a href="#none" class="not-allowed" disabled="">
                            <span class="fa fa-angle-double-left" aria-hidden="true"></span>
                        </a>
                    </li>
                    <li><a class="active" href="#page">1</a></li>
                    <li>
                        <a href="#page">2</a>
                    </li>
                    <li>
                        <a href="#page">3</a>
                    </li>
                    <li>
                        <a href="#page"><span class="fa fa-angle-double-right" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //pagination -->
        </div>
    </div>
    <!-- //courses section -->



@endsection

