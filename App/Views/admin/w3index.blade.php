@extends('lays.app')

@section('content')

    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-4 pb-sm-4">
                <h4 class="inner-text-title pt-5">Admin</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{'/'}}">Home</a></li>
                    <li class="active"><i class="fas fa-angle-right"></i>Admin</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <section class="w3l-contact" id="contact">
        <div class="container py-md-5 py-4">
            <!--<div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">Get Admission</p>
                <h3 class="title-style">Enroll Now</h3>
            </div>-->

            <h1 class="text-info text-secondary">
               {{-- <span class="mx-2"><a href=""><i class="fas fa-bars text-muted"></i></a></span>--}}
                <span class="mx-2"><a href=""><i class="fa fa-grip-horizontal text-muted"></i></a></span>
                Admin Dashboard
            </h1>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Courses/Groups</h5>
                            <p class="card-text">Complete List and Management of different Courses or Groups</p>
                            <a href="{{'/admin/list-group'}}" class="btn btn-danger">Manage Courses</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Students/Users</h5>
                            <p class="card-text">Manage and enlist all students/users of this portal.</p>
                            <a href="{{'/admin/list-students'}}" class="btn btn-warning">Users/Students</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Expenses</h5>
                            <p class="card-text">Administrator can add day to day expenses in chronological order</p>
                            <a href="{{'/admin/list-expense'}}" class="btn btn-success">Manage Expense</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Todo List</h5>
                            <p class="card-text">Manage and assign your work. This way you will never forget imp. things</p>
                            <a href="{{'/admin/list-todos'}}" class="btn btn-primary">Task Manager</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Enquires</h5>
                            <p class="card-text">Quickly respond to new enquires and admission request </p>
                            <a href="{{'/admin/list-enquires'}}" class="btn btn-dark">Handle Enquires</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Enrolments</h5>
                            <p class="card-text">Student online Enrolled List and convert them into admissions</p>
                            <a href="{{'/admin/list-enrolls'}}" class="btn btn-danger">New Enrolments</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Notices</h5>
                            <p class="card-text">Display notices, news & latest updates on website</p>
                            <a href="{{'/admin/list-notices'}}" class="btn btn-success">Notices</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Staff Management</h5>
                            <p class="card-text">List and manage staff with the greatest efficacy and peace of mind</p>
                            <a href="{{'/admin/list-staff'}}" class="btn btn-info">Manage Staff</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employment</h5>
                            <p class="card-text">View resumes and biodata of new employment requests</p>
                            <a href="{{'/admin/employment-exchange'}}" class="btn btn-warning">Exchange</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage PDF</h5>
                            <p class="card-text">Manage unattached PDF files ie. the files which are not attached to its content.</p>
                            <a href="{{'/admin/list-files'}}" class="btn btn-primary">Manage Files</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Upload PDF</h5>
                            <p class="card-text">Upload PDF Files to the server, multiple files with same name is restricted</p>
                            <a href="{{'/admin/upload-files-new'}}" class="btn btn-dark">Upload Files</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payments Record</h5>
                            <p class="card-text">Online payment records and total Revenue generated is visible here</p>
                            <a href="{{'/admin/payment-orders'}}" class="btn btn-success">Payment Statics</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4  mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Franchise</h5>
                            <p class="card-text">Manage & provide Franchise to center requesting for franchise</p>
                            <a href="{{'/admin/payment-orders'}}" class="btn btn-danger">Manage Centers</a>
                        </div>
                    </div>
                </div>


            </div>




        </div>

    </section>



@endsection

