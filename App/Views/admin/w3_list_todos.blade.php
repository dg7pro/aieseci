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
                    <li class="active"><i class="fas fa-angle-right"></i>Todos</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <section class="w3l-contact" id="contact">
        <div class="container py-md-5">

            <h1 class="text-info text-secondary">
                Todos List
                <button onclick="showNewTodoForm()" type="button" class="mb-1 ml-3 btn btn-sm btn-danger">+ Todos</button>
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

            <!-- New todos Modal -->
            <div class="modal fade" id="modal-new-todo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="new-todo-task" class="col-form-label">Todo task:</label>
                                    <input type="text" class="form-control" id="new-todo-task">
                                </div>
                                <div class="form-group">
                                    <label for="new-todo-deadline" class="col-form-label">Deadline:</label>
                                    <input type="date" class="form-control datepicker" id="new-todo-deadline">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="createNewTodo()">Add todo</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update todos Modal -->
            <div class="modal fade" id="modal-todo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Todo Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="todo-task" class="col-form-label">Tasks:</label>
                                    <input type="text" class="form-control" id="todo-task">
                                </div>

                                <div class="form-group">
                                    <label for="todo-deadline" class="col-form-label">Dated:</label>
                                    <input type="date" class="form-control" id="todo-deadline">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updateTodoInfo()">Update todo</button>
                            <input type="hidden" name="" id="todo-id">
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
                url: "/Adjax/search-todos",
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
        function getTodoInfo(id){
            console.log(id);
            $('#todo_id').val(id);
            $.post("/adjax/fetchSingleTodoRecord",{todoId:id},function (data, status) {

                console.log(data);
                var todo = JSON.parse(data);
                $('#todo-task').val(todo.task);
                $('#todo-deadline').val(todo.deadline);
                $('#todo-id').val(todo.id);

            });
            $('#modal-todo').modal("show");
        }

        function updateTodoInfo(){

            var task = $('#todo-task').val();
            var deadline = $('#todo-deadline').val();
            var id = $('#todo-id').val();
            $.post("/adjax/updateSingleTodoRecord",{
                task:task,
                deadline:deadline,
                id:id
            },function (data, status) {
                console.log(data);
                $('#modal-todo').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

        // ================
        // Crud Create
        // =================
        function showNewTodoForm(){
            $('#modal-new-todo').modal("show");
        }

        function createNewTodo(){

            var task = $('#new-todo-task').val();
            var deadline = $('#new-todo-deadline').val();

            $.post("/adjax/insertNewTodoRecord",{
                task:task,
                deadline:deadline
            },function (data, status) {
                console.log(data);
                $('#modal-new-todo').modal("hide");
                var query = $('#search_box').val();
                load_data(1,query);
            });
        }

        // ==============
        // Crud Delete
        //=================
        function deleteTodoInfo(id){

            var result = window.confirm('Are you sure?');
            if (result === false) {
                // e.preventDefault();
                console.log('He cancelled');
            }else {
                console.log('He is sure');
                $.post("/adjax/deleteTodoRecord",{
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
