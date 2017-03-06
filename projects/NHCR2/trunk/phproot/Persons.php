<?php
require_once("includes/Project.php");
authenticate();

?>
<!DOCTYPE html>
<html>
<head>
<title>Persons</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" name="person_id" id="person_id">

<div class="container-fluid">
    <h3> Persons </h3>
    <table id="persons" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>DOB</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>DOB</th>
            </tr>
        </tfoot>
	</table>

    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
        <a href="Person.php" id="add_person" role="button" class="btn btn-primary">Add Person</a>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/persons.js"></script>

</body>
</html>
