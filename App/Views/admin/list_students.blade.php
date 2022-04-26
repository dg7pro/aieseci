@extends('layouts.boot')

@section('custom_css')
    <style>
        .my-coral{
            background-color: coral;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div class="row mt-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-info">
                        <li class="breadcrumb-item"><a href="{{'/'}}">RS Lectures</a></li>
                        <li class="breadcrumb-item"><a href="{{'/admin/index'}}">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Students</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h3>
                    Search Students
                    <button onclick="showNewStudentForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-danger">+ Student Account</button>
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" id="search_box" name="search_box" class="form-control"
                           placeholder="Type your search query here...">
                </div>
                <div class="table-responsive" id="dynamic_content"></div>
            </div>
        </div>


        <div class="modal fade" id="modal-user-groups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Associated Groups</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div id="associated_groups">

                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- New Student Modal -->
        <div class="modal fade" id="modal-new-student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Student A/c</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="new-student-first-name" class="col-form-label">Firstname:</label>
                                <input type="text" class="form-control" id="new-student-first-name">
                            </div>
                            <div class="form-group">
                                <label for="new-student-last-name" class="col-form-label">Lastname:</label>
                                <input type="text" class="form-control" id="new-student-last-name">
                            </div>
                            <div class="form-group">
                                <label for="new-student-email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="new-student-email">
                            </div>
                            <div class="form-group">
                                <label for="new-student-mobile" class="col-form-label">Mobile:</label>
                                <input type="text" class="form-control" id="new-student-mobile">
                            </div>
                            <div class="form-group">
                                <label for="new-student-password" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="new-student-password">
                            </div>
                           {{-- <input type="hidden" class="form-control" id="new-student-type" value="Student">--}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="createNewStudent()">Add Account</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Student Modal -->
        <div class="modal fade" id="modal-student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Student A/c</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="student-first-name" class="col-form-label">Firstname:</label>
                                <input type="text" class="form-control" id="student-first-name">
                            </div>
                            <div class="form-group">
                                <label for="student-last-name" class="col-form-label">Lastname:</label>
                                <input type="text" class="form-control" id="student-last-name">
                            </div>
                            <div class="form-group">
                                <label for="student-email" class="col-form-label">Email:</label>
                                <input type="text" class="form-control" id="student-email">
                            </div>
                            <div class="form-group">
                                <label for="student-mobile" class="col-form-label">Mobile:</label>
                                <input type="text" class="form-control" id="student-mobile">
                            </div>
                            {{--<div class="form-group">
                                <label for="student-password" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="student-password">
                            </div>--}}
                            {{-- <input type="hidden" class="form-control" id="new-student-type" value="Student">--}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateStudentInfo()">Update Student</button>
                        <input type="hidden" name="" id="student-id">
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollment Modal -->
        <div class="modal fade" id="modal-new-enrollment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enroll Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="new-group-term" class="col-form-label">Courses:</label>
                                <select class="form-control" id="new-student-course">
                                    <option value="">Select</option>
                                    @foreach($grps as $grp)
                                        <option value={{$grp['id']}}>{{$grp['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new-group-color">Session:</label>
                                <select class="form-control" id="new-student-session">
                                    <option value="">Select</option>
                                    @foreach($fys as $fy)
                                        <option value={{$fy['code']}} {{($fy['active']==1) ?'selected':''}}>{{$fy['fy']}}</option>
                                    @endforeach
                                   {{-- <option value="2122">2122</option>
                                    <option value="2223">2223</option>
                                    <option value="2324">2324</option>
                                    <option value="2425">2425</option>--}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new-student-fees" class="col-form-label">Fees:</label>
                                <input type="text" class="form-control" id="new-student-fees">
                            </div>

                            <div class="form-group">
                                <label for="new-student-joining" class="col-form-label">Joining: (m-d-Y)</label>
                                <input type="date" class="form-control" id="new-student-joining" value="{{date('Y-m-d')}}">
                            </div>
                            {{-- <input type="hidden" class="form-control" id="new-student-type" value="Student">--}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="enrollStudent()">Generate Enrollment No.</button>
                        <input type="hidden" name="" id="student-id">
                    </div>
                </div>
            </div>
        </div>



        <!-- Enrollment Info Modal -->
        <div class="modal fade" id="modal-enrollment-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Associated Enrolls</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="associated_enrolls">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function (){

            load_data(1);

            $(document).on('click', '.page-link', function(){
                var page = $(this).data('page_number');
                var query = $('#search_box').val();
                load_data(page, query);
            });

            $('#search_box').keyup(function(){
                var query = $('#search_box').val();
                load_data(1, query);
            });

        });

        function load_data(page, query=''){
            $.ajax({
                url: "/Adjax/search-student",
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

        // ================
        // Crud Create
        // =================
        function showNewStudentForm(){
            $('#modal-new-student').modal("show");
        }

        function createNewStudent(){

            var first_name = $('#new-student-first-name').val();
            var last_name = $('#new-student-last-name').val();
            var mobile = $('#new-student-mobile').val();
            var email = $('#new-student-email').val();
            var password = $('#new-student-password').val();

            $.post("/adjax/insertNewStudentRecord",{
                first_name:first_name,
                last_name:last_name,
                mobile:mobile,
                email:email,
                password:password
            },function (data, status) {
                console.log(data);
                $('#modal-new-student').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

        function getStudentDetails(id){
            console.log(id);
            $.post("/adjax/fetchThisStudentDetails",{studentId:id},function (data, status) {
                console.log(data);
                $('#associated_groups').html(data);
            });
            $('#modal-student-details').modal("show");
        }



        function getStudentInfo(id){
            console.log(id);
            $.post("/adjax/fetchSingleStudentRecord",{userId:id},function (data, status) {
                console.log(data);
                var student = JSON.parse(data);
                $('#student-first-name').val(student.first_name);
                $('#student-last-name').val(student.last_name);
                $('#student-email').val(student.email);
                $('#student-mobile').val(student.mobile);
                $('#student-id').val(student.id);
            });
            $('#modal-student').modal("show");
        }

        function updateStudentInfo(){

            var first_name = $('#student-first-name').val();
            var last_name = $('#student-last-name').val();
            var email = $('#student-email').val();
            var mobile = $('#student-mobile').val();
            var id = $('#student-id').val();
            $.post("/adjax/updateSingleStudentRecord",{
                first_name:first_name,
                last_name:last_name,
                email:email,
                mobile:mobile,
                id:id

            },function (data, status) {
                console.log(data);
                $('#modal-student').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

        // ================
        // Enroll Student and generate enroll no.
        // =================
        function showEnrollmentForm(id){
            console.log(id);
            $('#student-id').val(id);
            $('#modal-new-enrollment').modal("show");
        }

        function enrollStudent(){

            var course = $('#new-student-course').val();
            var session = $('#new-student-session').val();
            var fees = $('#new-student-fees').val();
            var joining = $('#new-student-joining').val();
            var userId = $('#student-id').val();

            $.post("/adjax/insertNewEnrollmentRecord",{
                course:course,
                session:session,
                fees:fees,
                joining:joining,
                userId:userId
            },function (data, status) {
                console.log(data);
                $('#modal-new-enrollment').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

        function getEnrollmentInfo(id){
            console.log(id);
            $.ajax({
                url: "/Adjax/enrollment-info",
                method: "POST",
                data:{
                    id:id
                },
                success:function(data){
                    $('#dynamic_content').html(data);
                    $('#modal-enrollment-info').modal("show");
                }
            })

        }

        function getEnrollmentInfo(id){
            console.log(id);
            $.post("/adjax/enrollment-info",{userId:id},function (data, status) {
                console.log(data);
                $('#associated_enrolls').html(data);
            });
            $('#modal-enrollment-info').modal("show");
        }

    </script>

@endsection

