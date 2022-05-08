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
                    <li class="active"><i class="fas fa-angle-right"></i>Expenses in INR</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <section class="w3l-contact" id="contact">
        <div class="container py-md-5">

            <h1 class="text-info text-secondary">
                Daily Expenses
                <button onclick="showNewExpenseForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-danger">+ Expenses</button>
            </h1>

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

            <!-- New Expenses Modal -->
            <div class="modal fade" id="modal-new-expense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="createNewExpense()">Add Expense</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Expense Modal -->
            <div class="modal fade" id="modal-expense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Expense Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateExpenseInfo()">Update Expense</button>
                            <input type="hidden" name="" id="expense-id">
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
                url: "/Adjax/search-expenses",
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
        function getExpenseInfo(id){
            console.log(id);
            $('#expense_id').val(id);
            $.post("/adjax/fetchSingleExpenseRecord",{expenseId:id},function (data, status) {

                console.log(data);
                var expense = JSON.parse(data);
                $('#expense-amount').val(expense.amount);
                $('#expense-tag').val(expense.tag);
                $('#expense-date').val(expense.dated);
                $('#expense-id').val(expense.id);

            });
            $('#modal-expense').modal("show");
        }

        function updateExpenseInfo(){

            var amount = $('#expense-amount').val();
            var tag = $('#expense-tag').val();
            var date = $('#expense-date').val();
            var id = $('#expense-id').val();
            $.post("/adjax/updateSingleExpenseRecord",{
                amount:amount,
                tag:tag,
                date:date,
                id:id
            },function (data, status) {
                console.log(data);
                $('#modal-expense').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
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
                var query = $('#search_box').val();
                load_data(1,query);
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
                $.post("/adjax/deleteExpenseRecord",{
                    id:id

                },function (data, status) {
                    console.log(data);
                    // readRecords();
                    var query = $('#search_box').val();
                    load_data(1, query);
                    var response = $.parseJSON(data);
                    if(response.status === false){
                        alert(response.message);
                    }
                });
            }

        }
    </script>
@endsection
