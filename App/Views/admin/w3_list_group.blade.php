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
                    <li class="active"><i class="fas fa-angle-right"></i>Courses</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <section class="w3l-contact" id="contact">
        <div class="container py-md-5">
            <!--<div class="title-main text-center mx-auto mb-md-5 mb-4" style="max-width:500px;">
                <p class="text-uppercase">Get Admission</p>
                <h3 class="title-style">Enroll Now</h3>
            </div>-->

            <h1 class="text-info text-secondary">Courses</h1>

            <!-- First Row  -->
            <div class="row mt-3 mb-3">
                <div class="col-lg-12">
                  {{--  <div class="card card-default">
                        <div class="card-header card-header-border-bottom">--}}
                            {{--<h2>
                                Courses/Groups
                                <button onclick="showNewGroupForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-primary">Add Group +</button>
                                <a href="{{'/admin/change-group-order'}}" class="mb-1 ml-3 btn btn-sm btn-dark">Change Order</a>
                                <button onclick="showDiscountForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-success">Apply Discount</button>
                            </h2>--}}
                      {{--  </div>
                        <div class="card-body">--}}
                            <p class="mb-3">Here is the list of all the courses available on this portal</p>

                            <div class="mb-1">
                                <a href="{{'/admin/change-group-order'}}" class="mb-1 ml-3 btn btn-sm btn-secondary">Change Order</a>
                                <button onclick="showNewGroupForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-primary">Add Course</button>
                            </div>

                            <div id="records_content">


                            </div>
                        {{--</div>
                    </div>--}}
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modal-new-group" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="new-group-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="new-group-name">
                                </div>
                                <div class="form-group">
                                    <label for="new-group-short" class="col-form-label">Abbreviation:</label>
                                    <input type="text" class="form-control" id="new-group-short">
                                </div>
                                <div class="form-group">
                                    <label for="new-group-degree" class="col-form-label">Degree:</label>
                                    <textarea class="form-control" id="new-group-degree"></textarea>
                                </div>
                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="new-group-fees" class="col-form-label">Fees:</label>
                                        <input type="text" class="form-control" id="new-group-fees">
                                    </div>
                                    <div class="col">
                                        <label for="new-group-discount" class="col-form-label">Discount:</label>
                                        <input type="text" class="form-control" id="new-group-discount">
                                    </div>
                                    <div class="col">
                                        <label for="new-group-instalments" class="col-form-label">Instalments:</label>
                                        <select class="form-control" id="new-group-instalments">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="new-group-term" class="col-form-label">Term:</label>
                                        <select class="form-control" id="new-group-term">
                                            <option value="">Select</option>
                                            @for($i=1;$i<=10;$i++)
                                                <option value={{$i}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{--<div class="col">
                                        <label for="new-group-term" class="col-form-label">Term:</label>
                                        <input type="text" class="form-control" id="new-group-term">
                                    </div>--}}
                                    <div class="col">
                                        <label for="new-group-tenure" class="col-form-label">Tenure:</label>
                                        <select class="form-control" id="new-group-tenure">
                                            <option value="">Select</option>
                                            <option value="month">Month</option>
                                            <option value="sem">Sem</option>
                                            <option value="year">Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new-group-color">Select Color:</label>
                                    <select class="form-control" id="new-group-color">
                                        <option value="">Select</option>
                                        <option value="orange">Orange</option>
                                        <option value="lightcoral">LightCoral</option>
                                        <option value="lightsalmon">LightSalmon</option>
                                        <option value="" disabled>***</option>
                                        <option value="lightseagreen">LightSeaGreen</option>
                                        <option value="lightsteelblue">LightSteelBlue</option>
                                        <option value="Thistle">Thistle</option>
                                        <option value="" disabled>***</option>
                                        <option value="SandyBrown">SandyBrown</option>
                                        <option value="Wheat">Wheat</option>
                                        <option value="PaleGoldenRod">PaleGoldenRod</option>
                                        <option value="" disabled>***</option>
                                        <option value="Khaki">Khaki</option>
                                        <option value="LavenderBlush">LavenderBlush</option>
                                        <option value="LightGoldenRodYellow">LightGoldenRodYellow</option>
                                    </select>
                                </div>

                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="new-group-open">Registration Open:</label>
                                        <select class="form-control" id="new-group-open">
                                            <option value="">Select</option>
                                            <option value=0 selected>Closed (By Default)</option>
                                            <option value=1>Open</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="new-group-deactive">Deactive:</label>
                                        <select class="form-control" id="new-group-deactive">
                                            <option value="">Select</option>
                                            <option value=0 selected>No</option>
                                            <option value=1>Yes</option>
                                        </select>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="createNewGroup()">Create Group</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Modal -->
            <div class="modal fade" id="modal-group" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Group Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="group-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="group-name">
                                </div>
                                <div class="form-group">
                                    <label for="group-short" class="col-form-label">Abbreviation</label>
                                    <input type="text" class="form-control" id="group-short">
                                </div>
                                <div class="form-group">
                                    <label for="group-degree" class="col-form-label">Degree/Certificate:</label>
                                    <textarea class="form-control" id="group-degree"></textarea>
                                </div>

                                {{--Fees Block Start--}}
                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="group-fees" class="col-form-label">Fees:</label>
                                        <input type="text" class="form-control" id="group-fees">
                                    </div>
                                    <div class="col">
                                        <label for="group-discount" class="col-form-label">Discount:</label>
                                        <input type="text" class="form-control" id="group-discount">
                                    </div>
                                    <div class="col">
                                        <label for="group-installment" class="col-form-label">Installments:</label>
                                        <select class="form-control" id="group-installment">
                                            <option value="">Select</option>
                                            <option value="Yes">Available</option>
                                            <option value="No">Not Available</option>
                                        </select>
                                    </div>
                                </div>

                                {{--Duration Block Start--}}
                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="group-term" class="col-form-label">Term:</label>
                                        <select class="form-control" id="group-term">
                                            <option value="">Select</option>
                                            @for($i=1;$i<=10;$i++)
                                                <option value={{$i}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="group-tenure" class="col-form-label">Tenure:</label>
                                        <select class="form-control" id="group-tenure">
                                            <option value="">Select</option>
                                            <option value="sem">Sem</option>
                                            <option value="year">Year</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="group-color">Select Color:</label>
                                    <select class="form-control" id="group-color">
                                        <option value="">Select</option>
                                        <option value="orange">Orange</option>
                                        <option value="lightcoral">LightCoral</option>
                                        <option value="lightsalmon">LightSalmon</option>
                                        <option value="" disabled>***</option>
                                        <option value="lightseagreen">LightSeaGreen</option>
                                        <option value="lightsteelblue">LightSteelBlue</option>
                                        <option value="Thistle">Thistle</option>
                                        <option value="" disabled>***</option>
                                        <option value="SandyBrown">SandyBrown</option>
                                        <option value="Wheat">Wheat</option>
                                        <option value="PaleGoldenRod">PaleGoldenRod</option>
                                        <option value="" disabled>***</option>
                                        <option value="Khaki">Khaki</option>
                                        <option value="LavenderBlush">LavenderBlush</option>
                                        <option value="LightGoldenRodYellow">LightGoldenRodYellow</option>

                                    </select>
                                </div>

                                <div class="form-group form-row">
                                    <div class="col">
                                        <label for="group-open">Registration Open:</label>
                                        <select class="form-control" id="group-open">
                                            <option value="">Select</option>
                                            <option value=0 selected>Closed (By Default)</option>
                                            <option value=1>Open</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="group-deactive">Deactive:</label>
                                        <select class="form-control" id="group-deactive">
                                            <option value="">Select</option>
                                            <option value=0>No (By Default)</option>
                                            <option value=1>Yes</option>
                                        </select>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateGroupInfo()">Update Group</button>
                            <input type="hidden" name="" id="group-id">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>



@endsection

@section('custom_js')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            readRecords();
        });

        //=================
        // Read Record
        //=================
        function readRecords() {
            var readrecord = "readrecord";
            $.ajax({
                url: "/adjax/fetchGroupRecords",
                type: "POST",
                data: {
                    readrecord:readrecord
                },
                success: function(data,status){
                    //console.log(data);
                    $('#records_content').html(data);
                }
            })
        }

        function getGroupInfo(id){
            console.log(id);
            $('#group_id').val(id);
            $.post("/adjax/fetchSingleGroupRecord",{groupId:id},function (data, status) {

                console.log(data);
                var group = JSON.parse(data);
                $('#group-name').val(group.name);
                $('#group-short').val(group.short);
                $('#group-degree').val(group.degree);
                $('#group-fees').val(group.fees);
                $('#group-discount').val(group.discount);
                $('#group-installment').val(group.instalments);
                $('#group-term').val(group.term);
                $('#group-tenure').val(group.tenure);
                $('#group-color').val(group.color);
                $('#group-open').val(group.open);
                $('#group-deactive').val(group.deactive);
                $('#group-id').val(group.id);

            });
            $('#modal-group').modal("show");
        }

        function updateGroupInfo(){

            var name = $('#group-name').val();
            var short = $('#group-short').val();
            var degree = $('#group-degree').val();
            var fees = $('#group-fees').val();
            var discount = $('#group-discount').val();
            var installment = $('#group-installment').val();
            var term = $('#group-term').val();
            var tenure = $('#group-tenure').val();
            var color = $('#group-color').val();
            var open = $('#group-open').val();
            var deactive = $('#group-deactive').val();
            var id = $('#group-id').val();
            $.post("/adjax/updateSingleGroupRecord",{
                name:name,
                short:short,
                degree:degree,
                fees:fees,
                discount:discount,
                installment:installment,
                term:term,
                tenure:tenure,
                color:color,
                open:open,
                deactive:deactive,
                id:id

            },function (data, status) {
                console.log(data);
                $('#modal-group').modal("hide");
                readRecords();
            });
        }

        function showDiscountForm(){
            $('#modal-new-discount').modal("show");
        }

        function applyDiscount(){

            var discount = $('#new-discount-percent').val();
            console.log(discount);

            $.post("/adjax/applyDiscount",{
                discount:discount

            },function (data, status) {
                console.log(data);
                $('#modal-new-discount').modal("hide");
                readRecords();
            });
        }

        function removeDiscount(){

            //console.log(discount);

            $.post("/adjax/removeDiscount",{

            },function (data, status) {
                console.log(data);
                $('#modal-new-discount').modal("hide");
                readRecords();
            });
        }

        function showNewGroupForm(){
            $('#modal-new-group').modal("show");
        }

        function createNewGroup(){

            var name = $('#new-group-name').val();
            var short = $('#new-group-short').val();
            var degree = $('#new-group-degree').val();
            var fees = $('#new-group-fees').val();
            var discount = $('#new-group-discount').val();
            var instalments = $('#new-group-instalments').val();
            var term = $('#new-group-term').val();
            var tenure = $('#new-group-tenure').val();
            var color = $('#new-group-color').val();
            var open = $('#new-group-open').val();
            var deactive = $('#new-group-deactive').val();

            $.post("/adjax/insertNewGroupRecord",{
                name:name,
                short:short,
                degree:degree,
                fees:fees,
                discount:discount,
                instalments:instalments,
                term:term,
                tenure:tenure,
                color:color,
                open:open,
                deactive:deactive

            },function (data, status) {
                console.log(data);
                $('#modal-new-group').modal("hide");
                readRecords();
            });
        }

        function deleteGroupInfo(id){

            var result = window.confirm('Are you sure?');
            if (result === false) {
                // e.preventDefault();
                console.log('He cancelled');
            }else {
                console.log('He is sure');
                $.post("/adjax/deleteGroupRecord",{
                    id:id

                },function (data, status) {
                    console.log(data);
                    readRecords();
                    var response = $.parseJSON(data);
                    if(response.status === false){
                        alert(response.message);
                    }
                });
            }

        }
    </script>
@endsection
