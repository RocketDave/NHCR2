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
<title>Path Requests</title>
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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" name="path_request_id" id="path_request_id">

<div class="container-fluid">
    <h3> Path Requests </h3>
    <table id="pathrequests" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Path Request ID </th>
                <th scope="col"> Facility </th>
                <th scope="col"> Event Date </th>
                <th scope="col"> Print Date </th>
            </tr>
        </thead>
         <tfoot>
            <tr>
                <th scope="col"> Path Request ID </th>
                <th scope="col"> Facility </th>
                <th scope="col"> Event Date </th>
                <th scope="col"> Print Date </th>
            </tr>
        </tfoot>
	</table>


    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/pathrequests_p.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>