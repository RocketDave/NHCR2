<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}
if (isset($_POST['batch_id'])) {
    $_SESSION['batch_id']=$_POST['batch_id'];
    $batch_id = $_POST['batch_id'];
}
else if (isset($_SESSION['batch_id'])){
    $batch_id = $_SESSION['batch_id'];
}
else {
    $batch_id = '-9';
}

$batch_array = array();
$result = pg_query ('select batch_id, facility_id, arrival_date from batch where entry_completed = 0 order by arrival_date desc;' ) ;
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
<title>Batch Entry</title>
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
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)" >
<input type="hidden" name="event_id" id="event_id">
<input type="hidden" name="batch_end" id="batch_end">
<div class="container-fluid">
    <h3> Batch Entry </h3>
    <div class="form-group row">
      <label class="control-label col-md-1 bg-info" for="batch_id">You can select a batch from here or add a new one:</label>
        <div class="col-md-3">
             <select name="batch_id" class="form-control" id="batch_id">
                <option value=-9 >Select </option>
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
    <div class="table-responsive">
      <table id="entry" class="table table-striped">
        <thead>
            <tr>
                <th> Event ID</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Patient Barcode</th>
                <th> Endo Barcode</th>
                <th> Event Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = pg_query("select e.event_id,last_name,first_name,patient_barcode,endo_barcode,event_date
                    from vEvents_p e join person p on e.person_id = p.person_id where batch_id = ".$batch_id);
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="event.php" data-id=<?php echo $row['event_id'];?>>
                <td> <?php echo $row['event_id']?></td>
                <td> <?php echo $row['last_name']?></td>
                <td> <?php echo $row['first_name']?></td>
                <td> <?php echo $row['patient_barcode']?></td>
                <td> <?php echo $row['endo_barcode']?></td>
                <td> <?php echo $row['event_date']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
         <tfoot>
                <th> Event ID</th>
                <th> Last Name</th>
                <th> First Name</th>
                <th> Patient Barcode</th>
                <th> Endo Barcode</th>
                <th> Event Date</th>
        </tfoot>
      </table>
    </div>
    <div class="form-group row">
        <button id="start_entry" type="button" class="btn btn-primary">Start/Continue Entry</button>
        <button id="end_entry" type="button" class="btn btn-primary">Finish Entry</button>
   </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="./js/buttons.print.min.js"></script>
<script type="text/javascript" src="./js/buttons.html5.min.js"></script>
<script type="text/javascript" src="./js/buttons.flash.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./js/batchentryv2.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>

</body>
</html>
