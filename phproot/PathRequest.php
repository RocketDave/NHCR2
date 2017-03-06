`<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['path_request_id'])?$path_request_id=$_POST['path_request_id']:$path_request_id="";

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($path_request_id)?$path_request_id:$path_request_id="";
    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($event_id)?$event_id:$event_id="";
    isset($exam_date)?$exam_date:$exam_date="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($patient_id)?$patient_id:$patient_id="";
    isset($print_date)?$print_date:$print_date="";
    isset($recvd_date)?$recvd_date:$recvd_date="";
    isset($n_a_reason)?$n_a_reason:$n_a_reason="";
    isset($notes)?$notes:$notes="";
    isset($med_rec_num)?$med_rec_num:$med_rec_num="";
    isset($no_path_report)?$no_path_report:$no_path_report="";
    isset($path_report_id)?$path_report_id:$path_report_id="";
    isset($fac_requires_request)?$fac_requires_request:$fac_requires_request="";


    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_path_request($1,$2,$3,$4,$5)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $path_request_id,
                $n_a_reason,
                $no_path_report,
                $recvd_date,
                $notes)
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $path_request_id = $rows['lcl_path_request_id'];
                        $submit_message = $rows['lcl_message'];
                    }
                else
                    throw new Exception(pg_last_error($conn));
            } else    {
                    throw new Exception(pg_last_error($conn));
                }
    }    catch(Exception $e)    {
        echo 'ERROR: '.$e;
    }
}
if ($path_request_id != '') {
    $result = pg_query("select * from vPathRequest where path_request_id = ".$path_request_id);

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    }
}
    isset($path_request_id)?$path_request_id:$path_request_id="";
    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($event_id)?$event_id:$event_id="";
    isset($exam_date)?$exam_date:$exam_date="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($patient_id)?$patient_id:$patient_id="";
    isset($print_date)?$print_date:$print_date="";
    isset($recvd_date)?$recvd_date:$recvd_date="";
    isset($n_a_reason)?$n_a_reason:$n_a_reason="";
    isset($notes)?$notes:$notes="";
    isset($med_rec_num)?$med_rec_num:$med_rec_num="";
    isset($no_path_report)?$no_path_report:$no_path_report="";
    isset($path_report_id)?$path_report_id:$path_report_id="";
    isset($fac_requires_request)?$fac_requires_request:$fac_requires_request="";

?>
<!DOCTYPE html>
<head>
<title>Path Request</title>
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
    <link rel="shortcut icon" href="">
</head>
<body >
<?php include("includes/header.php"); ?>

<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="path_request_id" name="path_request_id" value="<?php echo $path_request_id; ?>"/>


<div class="container">
<?php   if(    isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> PATH REQUEST </h4>
    <div>
        Path Request ID:<?php echo $path_request_id; ?><br>
        Last Update: <?php echo $action_on.' - ' .$action_by; ?><br><br></b>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for="fac_requires_request">Facility Requires Request</label>
        <div class="checkbox col-md-1">
            <input type="checkbox" name="fac_requires_request" id="fac_requires_request" value="<?php echo $fac_requires_request; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Facility ID</label>
        <div class="col-md-2">
            <input type="text" name="facility_id" class="form-control" id="facility_id" value="<?php echo $facility_id; ?>" readonly>
        </div>
        <label class="control-label col-md-2">Visit ID</label>
        <div class="col-md-2">
            <input type="text" name="event_id" class="form-control" id="event_id" value="<?php echo $event_id; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Visit Date</label>
        <div class="col-md-2">
            <input type="date" name="exam_date" class="form-control" id="exam_date" value="<?php echo $exam_date; ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Patient ID</label>
        <div class="col-md-2">
            <input type="text" name="patient_id" class="form-control" id="patient_id" value="<?php echo $patient_id; ?>" readonly>
        </div>
        <label class="control-label col-md-2">Medical Record Number</label>
        <div class="col-md-2">
            <input type="text" name="med_rec_num" class="form-control" id="med_rec_num" value="<?php echo $med_rec_num; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Print Date</label>
        <div class="col-md-2">
            <input type="date" name="print_date" class="form-control" id="print_date" value="<?php echo $print_date; ?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Info N-A Reason</label>
        <div class="col-md-2">
            <select class="form-control" id="n_a_reason" name="n_a_reason">
                <option value="" 
                <?php 
                    if($n_a_reason==''){
                        echo "selected=\"selected\""; 
                    }
                ?>>
                </option>
                <option value="No Response" 
                <?php 
                    if($n_a_reason=="No Response"){
                        echo "selected=\"selected\""; 
                    }
                ?>>No Response
                </option>
                <option value="Doesn't Exist" 
                <?php 
                    if($n_a_reason=="Doesn't Exist"){
                        echo "selected=\"selected\""; 
                    }
                ?>>Doesn't Exist
                </option>
                <option value="Not Needed" 
                <?php 
                    if($n_a_reason=="Not Needed"){
                        echo "selected=\"selected\""; 
                    }
                ?>>Not Needed
                </option>
                <option value="Delay Request" 
                <?php 
                    if($n_a_reason=="Delay Request"){
                        echo "selected=\"selected\""; 
                    }
                ?>>Delay Request
                </option>
            </select>
        </div>

        <label class="control-label col-md-2" for="no_path_report">No Path Report</label>
        <div class="checkbox col-md-1">
            <input type="checkbox" name="no_path_report" id="no_path_report" value="<?php echo $no_path_report; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Received Date</label>
        <div class="col-md-2">
            <input type="date" name="recvd_date" class="form-control" id="recvd_date" value="<?php echo $recvd_date; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Path Report ID</label>
        <div class="col-md-2">
            <input type="text" name="path_report_id" class="form-control" id="path_report_id" value="<?php echo $path_report_id; ?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2"> Notes:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="notes"><?php echo $notes;?> </textarea>
        </div>
    </div>

    <div class="form-group row text-center">
        <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Save Record">
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="./js/dataTables.colVis.js"></script>
<script type="text/javascript" src="./js/pathrequest.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>