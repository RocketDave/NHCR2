<?php
/* Check to see if person accessing this page is logged in.    */
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();
$current_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html>
<head>
<title>Form Logs</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" name="form_log_id" id="form_log_id">

<div class="container-fluid">
    <h3> Form Logs </h3>
    <table id="form_logs" class="table table-striped display">
        <thead>
            <tr>
                <th scope="col"> Form Log ID </th>
                <th scope="col"> Facility ID </th>
                <th scope="col"> Facility Name </th>
                <th scope="col"> Type </th>
                <th scope="col"> Barcode From </th>
                <th scope="col"> Barcode To </th>
                <th scope="col"> Date Shipped</th>
            </tr>
        </thead>
         <tfoot>
            <tr>
                <th scope="col"> Form Log ID </th>
                <th scope="col"> Facility ID </th>
                <th scope="col"> Facility Name </th>
                <th scope="col"> Type </th>
                <th scope="col"> Barcode From </th>
                <th scope="col"> Barcode To </th>
                <th scope="col"> Date Shipped</th>
            </tr>
        </tfoot>
    </table>
    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
        <a href="FormLog.php" id="add_form" role="button" class="btn btn-primary">New Form Shipment</a>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/dataTables.js"></script>
<script type="text/javascript" src="./js/FormLogs.js"></script>

</body>
</html>
