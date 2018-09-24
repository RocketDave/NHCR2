<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

isset($_SESSION['batch_id'])?$batch_id=$_SESSION['batch_id']:$batch_id='';

?>
<!DOCTYPE html>
<html>
<head>
<title>Person Search</title>
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
<input type="hidden" name="person_id" id="person_id">
<input type="hidden" name="ssn_srch" id="ssn_srch">
<input type="hidden" name="dob_srch" id="dob_srch">
<input type="hidden" name="last_srch" id="last_srch">
<input type="hidden" name="first_srch" id="first_srch">
<input type="hidden" name="middle_srch" id="middle_srch">

<div class="container-fluid">
    <h3> Person Search </h3>
<?php if(isset($_SESSION['batch_id']))  {
    echo '<h3 class="alert-info"> Working on Batch #'.$_SESSION['batch_id'].'</h3>';
    } 
?>
    <div class="table-responsive">
      <table id="persons" class="table table-striped">
        <thead>
            <tr>
                <th> Person ID</th>
                <th> SSN</th>
                <th> DOB</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Middle Name</th>
            </tr>
        </thead>
         <tfoot>
                <th> Person ID</th>
                <th> SSN</th>
                <th> DOB</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Middle Name</th>
        </tfoot>
      </table>
    </div>

    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
        <button id="new_person" type="button" class="btn btn-primary">New Person</button>
   </div>

    <div class="form-group row">
        <a href="batchentry.php">Return to Batch Entry List</a>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/personsrch_v2.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>

</body>
</html>
