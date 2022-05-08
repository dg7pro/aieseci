@extends('lays.app')

@section('content')

    <!-- inner banner -->
    <section class="inner-banner py-5">
        <div class="w3l-breadcrumb py-lg-5">
            <div class="container pt-4 pb-sm-4">
                <h4 class="inner-text-title pt-5">Admin</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{'/'}}">Home</a></li>
                    <li><i class="fas fa-angle-right"></i><a href="{{'/admin'}}">Admin</a></li>
                    <li class="active"><i class="fas fa-angle-right"></i>Enquires</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <section class="w3l-contact" id="contact">
        <div class="container py-md-5">

            <h1 class="text-info text-secondary">New Enquires</h1>

            <!-- First Row  -->
            <div class="row mt-3 mb-3">
                <div class="col-lg-12">

                    {{--<p class="mb-3">Here is the list of all the courses available on this portal</p>--}}

                    <div class="form-group mb-3">
                        <input type="text" id="search_box" name="search_box" class="form-control"
                               placeholder="Type your search query here...">
                    </div>

                    <div id="dynamic_content">

                    </div>

                </div>
            </div>

            <!-- Update enquiry Modal -->
            <div class="modal fade" id="modal-enquiry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enquiry Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="enquiry-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="enquiry-name" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-email" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" id="enquiry-email" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-mobile" class="col-form-label">Mobile:</label>
                                    <input type="text" class="form-control" id="enquiry-mobile" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-message" class="col-form-label">Message:</label>
                                    <textarea class="form-control" id="enquiry-message" placeholder="Please type your message" rows="7" disabled></textarea>
                                </div>

                                <div class="mb-3">...</div>
                                <div class="form-group">
                                    <label for="enquiry-cs" class="col-form-label">Status:</label>
                                    <select class="form-select" aria-label="Default select example" id="enquiry-cs">
                                        <option value="" selected>Change</option>
                                        <option value="Success">Success</option>
                                        <option value="Failure">Failure</option>
                                        <option value="Unable to reach">Unable to reach</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="enquiry-note" class="col-form-label">Note:</label>
                                    <textarea class="form-control" id="enquiry-note" placeholder="Note for future office use" rows="4"></textarea>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateEnquiryInfo()">Update enquiry</button>
                            <input type="hidden" name="" id="enquiry-id">
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>



@endsection

@section('custom_js')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>



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
                url: "/Adjax/search-enquires",
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
        function getEnquiryInfo(id){
            console.log(id);
            //$('#todo_id').val(id);
            $.post("/adjax/fetchSingleEnquiryRecord",{enquiryId:id},function (data, status) {

                console.log(data);
                var enquiry = JSON.parse(data);
                $('#enquiry-name').val(enquiry.name);
                $('#enquiry-mobile').val(enquiry.mobile);
                $('#enquiry-email').val(enquiry.email);
                $('#enquiry-message').val(enquiry.message);
                $('#enquiry-id').val(enquiry.id);
                $('#enquiry-cs').val(enquiry.response);
                $('#enquiry-note').val(enquiry.note);

            });
            $('#modal-enquiry').modal("show");
        }

        function updateEnquiryInfo(){

            var cs = $('#enquiry-cs').val();
            var note = $('#enquiry-note').val();
            var id = $('#enquiry-id').val();
            $.post("/adjax/updateSingleEnquiryRecord",{
                cs:cs,
                note:note,
                id:id
            },function (data, status) {
                console.log(data);
                $('#modal-enquiry').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }




    </script>
@endsection
