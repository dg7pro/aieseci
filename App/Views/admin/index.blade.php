@extends('layouts.boot')

@section('content')

    <div class="container">
        <h1 class="mt-3 mb-5 text-info text-secondary">Administrator Dashboard</h1>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Courses/Groups</h5>
                        <p class="card-text">Complete List and Management of different Courses or Groups</p>
                        <a href="{{'/admin/list-group'}}" class="btn btn-danger">Manage Courses</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Students/Users</h5>
                        <p class="card-text">Manage and enlist all students/users of this portal.</p>
                        <a href="{{'/admin/list-students'}}" class="btn btn-warning">Users/Students</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Expenses</h5>
                        <p class="card-text">Administrator can add day to day expenses in chronological order</p>
                        <a href="{{'/admin/list-expense'}}" class="btn btn-success">Manage Expense</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Todo List</h5>
                        <p class="card-text">Manage and assign your work. This way you will never forget imp. things</p>
                        <a href="{{'/admin/list-todos'}}" class="btn btn-primary">Task Manager</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Query</h5>
                        <p class="card-text">Quickly respond to new enquires and admission request </p>
                        <a href="{{'/admin/list-queries'}}" class="btn btn-dark">Handle Queries</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enrolments</h5>
                        <p class="card-text">Student online Enrolled List and convert them into admissions</p>
                        <a href="{{'/admin/enrolments'}}" class="btn btn-danger">New Enrolments</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Notices</h5>
                        <p class="card-text">Display notices, news & latest updates on website</p>
                        <a href="{{'/admin/list-notices'}}" class="btn btn-success">Notices</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Staff Management</h5>
                        <p class="card-text">List and manage staff with the greatest efficacy and peace of mind</p>
                        <a href="{{'/admin/list-staff'}}" class="btn btn-info">Manage Staff</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employment</h5>
                        <p class="card-text">View resumes and biodata of new employment requests</p>
                        <a href="{{'/admin/employment-exchange'}}" class="btn btn-warning">Exchange</a>
                    </div>
                </div>
            </div>

            {{--<div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payments/Revenue</h5>
                        <p class="card-text">Latest payment made and total Revenue generated is visible here</p>
                        <a href="{{'/admin/payment-orders'}}" class="btn btn-success">Payment Statics</a>
                    </div>
                </div>
            </div>--}}

            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage PDF</h5>
                        <p class="card-text">Manage unattached PDF files ie. the files which are not attached to its content.</p>
                        <a href="{{'/admin/list-files'}}" class="btn btn-primary">Manage Files</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4  mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upload PDF</h5>
                        <p class="card-text">Upload PDF Files to the server, multiple files with same name is restricted</p>
                        <a href="{{'/admin/upload-files-new'}}" class="btn btn-dark">Upload Files</a>
                    </div>
                </div>
            </div>
        </div>


        {{--<div class="card mt-5 mb-3">
            <div class="card-header">
                Search User
            </div>
            <div class="card-body">
               <div class="form-group">
                   <input type="text" id="search_box" name="search_box" class="form-control"
                          placeholder="Type your search query here...">
               </div>
                <div class="table-responsive" id="dynamic_content"></div>
            </div>
        </div>--}}

    </div>

@endsection

@section('script')

    {{--<script>
        $(document).ready(function (){

            load_data(1);

            function load_data(page, query=''){
                $.ajax({
                    url: "/Adjax/search-user",
                    method: "POST",
                    data:{
                        page:page,
                        query:query
                    },
                    success:function(data){
                        $('#dynamic_content').html(data);
                    }
                })
            }

            $(document).on('click', '.page-link', function(){
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function(){
                var query = $('#search_box').val();
                load_data(1, query);
            });

        })


    </script>
--}}
@endsection