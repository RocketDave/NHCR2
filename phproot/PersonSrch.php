<?php
/* Check to see if person accessing this page is logged in.    */
require_once("/includes/Project.php");
authenticate();

try {
    $conn = connect();
    if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
        $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
        header('Location: Logout.php');
    }
}
catch (Exception $e) {
    $session->info['message'] = $e->getMessage();
}

$_SESSION['previous_location'] = 'PersonSrch.php';
$_SESSION['previous_location_title'] = 'Data Entry';
isset($_POST['batch_id'])?$batch_id=$_POST['batch_id']:$batch_id='';

$batch_array = array();
$result = pg_query ('select batch_id, facility_id, arrival_date from batch order by arrival_date desc;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $batch_array[$curr_row][$curr_col] = $row[$curr_col];
               $curr_col ++;
        } 
}

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
    <link rel="shortcut icon" href="">
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
      <table id="persons" class="table table-striped hidden">
        <thead>
            <tr>
                <th> Person ID</th>
                <th> SSN</th>
                <th> MRN</th>
                <th> DOB</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Middle Name</th>
                <th> Address </th>
                <th> City </th>
            </tr>
        </thead>
         <tfoot>
            <tr>
                <th> Person ID</th>
                <th> SSN</th>
                <th> MRN</th>
                <th> DOB</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Middle Name</th>
                <th> Address </th>
                <th> City </th>
            </tr>
        </tfoot>
      </table>

    <div class="form-group row">
      <label class="control-label col-md-1" for="batch_id">Batch:</label>
        <div class="col-md-3">
        <select name="batch_id" class="form-control" id = "batch_id">
                <option value="">Make selection </option>
                <?php
                    foreach ($batch_array as $v) {
                ?>
                    <option value="<?php echo $v[0]?>" 
                <?php
                    if($batch_id == $v[0]){
                        echo "selected=\"selected\""; 

                    }
                ?>
                    >
                <?php echo $v[0].' - '.$v[1].' - '.$v[2];?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
    </div>

    <div class="text-center">
        <button id="new_person" type="button" class="btn btn-primary">New Person</button>
   </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/personsrch.js"></script>

</body>
</html>
