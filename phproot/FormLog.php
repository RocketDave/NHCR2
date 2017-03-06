<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['form_log_id'])?$form_log_id=$_POST['form_log_id']:$form_log_id="-9";

$fac_array = array();
$result = pg_query ('select facility_id as fac_id, facility_name from Facility order by facility_name;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $fac_array[$curr_row][$curr_col] = $row[$curr_col];
               $curr_col ++;
        } 
}


/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($form_log_id)?$form_log_id:$form_log_id="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($form_is_patient)?$form_is_patient:$form_is_patient="";
    isset($start_barcode)?$start_barcode:$start_barcode="";
    isset($end_barcode)?$end_barcode:$end_barcode="";
    isset($ship_date)?$ship_date:$ship_date="";

    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.set_form_log($1,$2,$3,$4,$5,$6)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $form_log_id,
                $facility_id,
                $form_is_patient,
                $start_barcode,
                $end_barcode,
                $ship_date)
                );
            if($result) {
                $rows = pg_fetch_assoc( $result );
                $form_log_id = $rows['lcl_form_log_id'];
                $submit_message = $rows['lcl_message'];
            }
            else
                throw new exception ('Problem updating record.');
        }
    }
    catch (Exception $e) {
        echo 'ERROR: '.$e;
    }
}

$result = pg_query("select * from vForm_logs_2 where form_log_id = '" . $form_log_id . "'");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($form_log_id)?$form_log_id:$form_log_id="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($form_is_patient)?$form_is_patient:$form_is_patient="";
    isset($start_barcode)?$start_barcode:$start_barcode="";
    isset($end_barcode)?$end_barcode:$end_barcode="";
    isset($ship_date)?$ship_date:$ship_date="";


?>
<!DOCTYPE html>
<head>
<title>Form Log</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="form_log_id" name="form_log_id" value="<?php echo $form_log_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Form Log</h4>
    <div>
        ID:<?php echo $form_log_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<p><p>
    <div class="form-group row">
      <label class="control-label col-md-2" for="main_site">Facility:</label>
        <div class="col-md-3">
        <select name="facility_id" class="form-control" id = "facility_id">
                <option value="" selected>
                <?php
                    foreach ($fac_array as $v) {
                ?>
                    <option value="<?php echo $v[0]?>" 
                <?php
                    if($facility_id == $v[0]){
                        echo "selected=\"selected\""; 
                    }
                ?>
                    >
                <?php echo $v[1]?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
        <label class="control-label col-md-1"> Type:</label> 
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="form_is_patient" value="1" <?php echo $form_is_patient=="1"?"checked":""; ?> >Patient</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="form_is_patient" value="0" <?php echo $form_is_patient=="0"?"checked":""; ?> >Endoscopist</label>
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="start_barcode" >Starting Barcode:</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="start_barcode" id="start_barcode" value="<?php echo $start_barcode;?>">
      </div>
      <label class="control-label col-md-2" for="end_barcode" >Ending Barcode:</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="end_barcode" id="end_barcode" value="<?php echo $end_barcode;?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Ship Date:</label> 
        <div class="col-md-2">
        <input type="date" class="form-control" name="ship_date" value="<?php echo $ship_date;?>" >
        </div>
    </div>
    <div class="text-center form-group row">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Submit">
    </div>
    <div class="text-center form-group row">
        <button id="return" type="button" class="btn btn-link">Return to Form Logs</button>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/FormLog.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>