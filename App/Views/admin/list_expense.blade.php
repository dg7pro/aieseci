@extends('layouts.boot')

@section('content')

    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-info">
                        <li class="breadcrumb-item"><a href="{{'/'}}">RS Lectures</a></li>
                        <li class="breadcrumb-item"><a href="{{'/admin/index'}}">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expenses in Rupees</li>
                    </ol>
                </nav>
            </div>
        </div>


        <!-- First Row  -->
        <div class="row mt-3 mb-3">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>
                            Daily Expenses
                            <button onclick="showNewExpenseForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-danger">Add Expense +</button>
                        </h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-5">Here is the list of all the courses available on this portal</p>

                        <div id="records_content">


                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- New Expense Modal -->
        <div class="modal fade" id="modal-new-expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="new-expense-amount" class="col-form-label">Amount:</label>
                                <input type="text" class="form-control" id="new-expense-amount">
                            </div>
                            <div class="form-group">
                                <label for="new-expense-tag" class="col-form-label">Description:</label>
                                <textarea class="form-control" id="new-expense-tag"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="new-expense-date" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" id="new-expense-date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="createNewExpense()">Add Expense</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Update Group Modal -->
        <div class="modal fade" id="modal-expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Group Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="expense-amount" class="col-form-label">Amount:</label>
                                <input type="text" class="form-control" id="expense-amount">
                            </div>
                            <div class="form-group">
                                <label for="expense-tag" class="col-form-label">Abbreviation</label>
                                <textarea class="form-control" id="expense-tag"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="expense-date" class="col-form-label">Dated:</label>
                                <input type="date" class="form-control" id="expense-date">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateExpenseInfo()">Update Expense</button>
                        <input type="hidden" name="" id="group-id">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')

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
                url: "/adjax/fetchExpenseRecords",
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

        // ====================
        // Crud Update
        // ====================
        function getExpenseInfo(id){
            console.log(id);
            $('#expense_id').val(id);
            $.post("/adjax/fetchSingleExpenseRecord",{expenseId:id},function (data, status) {

                console.log(data);
                var expense = JSON.parse(data);
                $('#expense-amount').val(expense.amount);
                $('#expense-tag').val(expense.tag);
                $('#expense-date').val(expense.dated);

            });
            $('#modal-expense').modal("show");
        }

        function updateExpenseInfo(){

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
            $.post("/adjax/updateSingleExpenseRecord",{
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

        // ================
        // Crud Create
        // =================
        function showNewExpenseForm(){
            $('#modal-new-expense').modal("show");
        }

        function createNewExpense(){

            var amount = $('#new-expense-amount').val();
            var tag = $('#new-expense-tag').val();
            var date = $('#new-expense-date').val();

            $.post("/adjax/insertNewExpenseRecord",{
                amount:amount,
                tag:tag,
                date:date
            },function (data, status) {
                console.log(data);
                $('#modal-new-expense').modal("hide");
                readRecords();
            });
        }

        // ==============
        // Crud Delete
        //=================
        function deleteExpenseInfo(id){

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

