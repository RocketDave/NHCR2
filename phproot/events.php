<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Events</title>
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
<input type="hidden" name="event_id" id="event_id">

<div class="container-fluid">
    <h3> Events </h3>
    <div class="table-responsive">
        <table id="events" class="table table-striped">
            <thead>
                <tr>
                    <th> Event ID </th>
                    <th> Person ID </th>
                    <th> Batch ID </th>
                    <th> Facility ID </th>
                    <th> Event Date</th>
                    <th> Patient Barcode</th>
                    <th> Endo Barcode</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th> Event ID </th>
                    <th> Person ID </th>
                    <th> Batch ID </th>
                    <th> Facility ID </th>
                    <th> Event Date</th>
                    <th> Patient Barcode</th>
                    <th> Endo Barcode</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div>
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/events_v3.js"></script>

</body>
</html>
