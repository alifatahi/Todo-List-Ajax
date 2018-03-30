<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax ToDo List</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CDN For Auto Search -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <input type="text" class="form-control" name="searchItem" id="searchItem" placeholder="Search For Task">
        </div>
        <br>
        <br>
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ToDo List
                        <a href="#" id="addNew" data-toggle="modal" data-target="#myModal" class="pull-right">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </h3>
                </div>

                <div class="panel-body" id="items">
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">
                                <input type="hidden" id="itemId" value="{{$task->id}}">
                                {{$task->task}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="title">Add New Task</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <p><input type="text" placeholder="Write Tasks" id="addItem" class="form-control"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">
                    Delete
                </button>
                <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal"
                        style="display: none">Save changes
                </button>
                <button type="button" class="btn btn-primary" id="AddButton" data-dismiss="modal">Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{csrf_field()}}

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<!-- CDN For Auto Search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    // Edit Modal
    $(document).ready(function () {
        //Use Document so each things has they own functionality
        $(document).on('click', '.ourItem', function () {
            //Cache text
            var text = $(this).text();
            // Cache ID By Find Id of Item
            var id = $(this).find('#itemId').val();
            //Change Title
            $('#title').text('Edit Task');
            // Add Value to input
            // use trim Method to skip extra Space
            $('#addItem').val($.trim(text));
            //Show Delete btn on edit Modal
            $('#delete').show('100');
            //Show Save btn on edit Modal
            $('#saveChanges').show('100');
            //Hide Add btn on edit Modal
            $('#AddButton').hide('100');
            // Pass Id of Item
            $('#id').val(id);
        });

        // Add New Modal
        $(document).on('click', '#addNew', function () {
            // Pass Text
            $('#title').text('Add New Task');
            // Add Value to input Which is NULL
            $('#addItem').val('');
            //Hide Delete btn on edit Modal
            $('#delete').hide('100');
            //Hide Save btn on edit Modal
            $('#saveChanges').hide('100');
            //Show Add btn on edit Modal
            $('#AddButton').show('100');
        });

        // Add Button in Form
        $('#AddButton').click(function () {
            //Get Input Value
            var text = $('#addItem').val();
            //Check If Not Empty
            if (text == '') {
                alert('Please Type Your Task');
            }
            //Ajax
            //Url , Data | Token , CallBack
            $.post('create',
                //here we declare first text as name of column and second as value
                {'text': text, '_token': $('input[name=_token]').val()},
                function (data) {
                    console.log(data);
                    //Load Page After Add new Task
                    //Load is Ajax method that very powerful (URL,Data,CallBack)
                    // Space in ' #items' is very important
                    $('#items').load(location.href + ' #items');
                });
        });

        // Delete
        $('#delete').click(function () {
            // Cache & Get ID of Item
            var id = $('#id').val();
            //Ajax For Remove
            //pass id and csrf
            $.post('remove', {'id': id, '_token': $('input[name=_token]').val()}, function (data) {
                //Load Page after Done
                $('#items').load(location.href + ' #items');
                console.log(data);
            });
        });

        // Edit
        $('#saveChanges').click(function () {
            // Cache & Get ID of Item
            var id = $('#id').val();
            //Cache Value
            var value = $('#addItem').val();
            //Ajax For Remove
            //pass id , Value and csrf
            $.post('update', {'id': id, 'value': value, '_token': $('input[name=_token]').val()}, function (data) {
                //Load Page after Done
                $('#items').load(location.href + ' #items');
                console.log(data);
            });
        });

        //Method for AutoSearch
        $(function () {
            //Get Input & Use autocomplete Method for get Result
            $("#searchItem").autocomplete({
                //Route For Get Result
                source: 'http://localhost/Todo-List-Ajax/public/search'
            });
        });
    });

</script>

</body>
</html>