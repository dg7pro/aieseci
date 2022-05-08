@extends('lays.app')

@section('content')

    <!-- inner banner -->
    <!--<section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-4 pb-sm-4">
                <h4 class="inner-text-title pt-5">Enroll Form</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><i class="fas fa-angle-right"></i>Student Enroll</li>
                </ul>
            </div>
        </div>
    </section>-->
    <!-- //inner banner -->



    <section class="w3l-contact py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">Get Admission</p>
                <h3 class="title-style">Enroll Now</h3>
            </div>

            @include('layouts.partials.flash')

            <div>
            <form action="{{'/home/enroll-student'}}" method="POST">

                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="course" name="course" aria-label="Floating label select example">
                                <option selected>Choose</option>
                                <option value="1">Nielit O Level</option>
                                <option value="2">Hardware & Network Engineering</option>
                                <option value="3">Fullstack Web development</option>
                            </select>
                            <label for="course">Course</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ravi">
                            <label for="first_name">First name</label>
                        </div>
                    </div>
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Kumar">
                            <label for="last_name">Last name</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-md mb-1">
                        <div class="form-floating">
                            <select class="form-select" id="gender" name="gender" aria-label="Floating label select example">
                                <option selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="gender">Your Gender</label>
                        </div>
                    </div>
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
                            <label for="dob">DOB</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                    </div>

                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="8887610230">
                            <label for="mobile">Mobile No.</label>
                        </div>
                    </div>
                </div>

                <!--Parents Name-->
                <div class="row g-2 mb-3">
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="father" name="father" placeholder="Rajesh kumar singh">
                            <label for="father">Father's Name</label>
                        </div>
                    </div>
                    <div class="col-lg mb-1">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="mother" name="mother" placeholder="Kumar">
                            <label for="mother">Mother's Name</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Full address here" id="address" name="address" style="height: 100px"></textarea>
                        <label for="address">Permanent Full Address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <button type="submit" class="btn btn-info btn-lg">Submit Application</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </section>


@endsection