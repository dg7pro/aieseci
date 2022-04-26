@extends('layouts.boot')

@section('custom_css')
    <style>
        .my-coral{
            background-color: coral;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-info">
                        <li class="breadcrumb-item"><a href="{{'/'}}">RS Lectures</a></li>
                        <li class="breadcrumb-item"><a href="{{'/admin/index'}}">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Queries</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h3>New Queries</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" id="search_box" name="search_box" class="form-control"
                           placeholder="Type your search query here...">
                </div>
                <div class="table-responsive" id="dynamic_content"></div>
            </div>
        </div>



        <!-- Update Group Modal -->
        <div class="modal fade" id="modal-inquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inquiry details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="inquiry-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="inquiry-name">
                            </div>
                            <div class="form-group">
                                <label for="inquiry-subject" class="col-form-label">Subject:</label>
                                <input type="text" class="form-control" id="inquiry-subject">
                            </div>
                            <div class="form-group">
                                <label for="inquiry-message" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="inquiry-message"></textarea>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateInquiryInfo()">Update Inquiry</button>
                        <input type="hidden" name="" id="inquiry-id">

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
                url: "/Adjax/search-query",
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

        // ====================
        // Crud Update
        // ====================
        function getInquiryInfo(id){
            console.log(id);
            $('#inquiry_id').val(id);
            $.post("/adjax/fetchSingleInquiryRecord",{inquiryId:id},function (data, status) {

                console.log(data);
                var inquiry = JSON.parse(data);
                $('#inquiry-name').val(inquiry.name);
                $('#inquiry-subject').val(inquiry.subject);
                $('#inquiry-message').val(inquiry.message);
                $('#inquiry-id').val(inquiry.id);
            });
            $('#modal-inquiry').modal("show");
        }

        function updateInquiryInfo(){

            var name = $('#inquiry-name').val();
            var subject = $('#inquiry-subject').val();
            var message = $('#inquiry-message').val();
            var id = $('#inquiry-id').val();
            $.post("/adjax/updateSingleInquiryRecord",{
                name:name,
                subject:subject,
                message:message,
                id:id

            },function (data, status) {
                console.log(data);
                $('#modal-inquiry').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

    </script>

@endsection

