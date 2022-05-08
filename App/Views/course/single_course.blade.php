@extends('lays.app')

@section('content')

    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-4 pb-sm-4">
                <h4 class="inner-text-title pt-5">Blog Single</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><i class="fas fa-angle-right"></i>Blog Single</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <!-- blog-post -->
    <section class="w3l-blogpost-content py-5">
        <div class="container py-md-5 py-4">
            <div class="row">
                <div class="text-11 col-lg-8">
                    <div class="text11-content">
                        <h4 class="mb-3">{{$content['name']}}</h4>
                        <img src="{{'/assets/images/'.$content['blog_img']}}" class="img-fluid radius-image" alt="" />
                       {!! $content['blog'] !!}

                    </div>
                </div>
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5 ps-md-5">
                    <aside class="sidebar">
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- //blog-posts -->

    <!-- call block -->
    <section class="w3l-call-to-action-6">
        <div class="container py-md-5 py-sm-4 py-5">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="left-content-call">
                    {{--<h3 class="title-big">Call To Enroll Your Child</h3>--}}
                    <h3 class="title-big">Call us to Get Admission</h3>
                    <p class="text-white mt-1">Begin the change today!</p>
                </div>
                <div class="right-content-call mt-lg-0 mt-4">
                    <ul class="buttons">
                        <li class="phone-sec me-lg-4"><i class="fas fa-phone-volume"></i>
                            <a class="call-style-w3" href="tel:+91 941530 1989">+91 941530 1989</a>
                        </li>
                        <li><a href="{{'enroll'}}" class="btn btn-style btn-style-2 mt-lg-0 mt-3">Enroll now</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- //call block -->




@endsection

