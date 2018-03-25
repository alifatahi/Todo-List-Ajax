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

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ToDo List
                        <a href="#" data-toggle="modal" data-target="#myModal" class="pull-right">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Cras justo odio
                        </li>
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Dapibus ac
                            facilisis in
                        </li>
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Morbi leo risus
                        </li>
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Porta ac
                            consectetur ac
                        </li>
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">Vestibulum at
                            eros
                        </li>
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
                <p><input type="text" placeholder="Write Tasks" id="addItem" class="form-control"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">
                    Delete
                </button>
                <button type="button" class="btn btn-primary" id="saveChanges" style="display: none">Save changes
                </button>
                <button type="button" class="btn btn-primary" id="AddButton">Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    // Edit Modal
    $(document).ready(function () {
        // Loop through each Items
        $('.ourItem').each(function () {
            // when click on each item
            $(this).click(function () {
                // Pass Text of each item
                var text = $(this).text();
                $('#title').text('Edit Task');
                // Add Value to input
                $('#addItem').val(text);
                //Show Delete btn on edit Modal
                $('#delete').show('100');
                //Show Save btn on edit Modal
                $('#saveChanges').show('100');
                //Hide Add btn on edit Modal
                $('#AddButton').hide('100');
            });
        });
    });
</script>

</body>
</html>