<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();
$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id=-9;
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";
isset($_POST['batch_id'])?$batch_id=$_POST['batch_id']:$batch_id="";

$endo_array = array();
$result = pg_query ('select endoscopist_id as endo_code,mail_name from Endoscopist order by endo_last_name;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $endo_array[$curr_row][$curr_col] = $row[$curr_col];
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
    isset($event_id)?$event_id:$event_id=-9;
    isset($person_id)?$person_id:$person_id="";
    isset($endo_barcode)?$endo_barcode:$endo_barcode="";
    isset($patient_barcode)?$patient_barcode:$patient_barcode="";
    isset($event_date)?$event_date:$event_date="";
    isset($event_type)?$event_type:$event_type="Colonoscopy";
    isset($batch_id)?$batch_id:$batch_id=-9;
    isset($medical_record_number)?$medical_record_number:$medical_record_number="";
    isset($endo_code)?$endo_code:$endo_code=-9;
    isset($est_exam_date)?$est_exam_date:$est_exam_date=0;
    isset($not_approached)?$not_approached:$not_approached=0;
    isset($signature_present)?$signature_present:$signature_present=0;
    isset($disabled)?$disabled:$disabled=0;
    isset($comments)?$comments:$comments="";

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_event($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $event_id,
                    $person_id,
                    $endo_barcode,
                    $patient_barcode,
                    $event_date,
                    $event_type,
                    $batch_id,
                    $medical_record_number,
                    $endo_code,
                    $est_exam_date,
                    $not_approached,
                    $signature_present,
                    $disabled,
                    $comments
                    )
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $event_id = $rows['lcl_event_id'];
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

$result = pg_query("select * from vEvents where event_id = " . $event_id);

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}
    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($event_id)?$event_id:$event_id=-9;
    isset($person_id)?$person_id:$person_id="";
    isset($endo_barcode)?$endo_barcode:$endo_barcode="";
    isset($patient_barcode)?$patient_barcode:$patient_barcode="";
    isset($event_date)?$event_date:$event_date="";
    isset($event_type)?$event_type:$event_type="Colonoscopy";
    isset($batch_id)?$batch_id:$batch_id=-9;
    isset($medical_record_number)?$medical_record_number:$medical_record_number="";
    isset($endo_code)?$endo_code:$endo_code=-9;
    isset($est_exam_date)?$est_exam_date:$est_exam_date=0;
    isset($not_approached)?$not_approached:$not_approached=0;
    isset($signature_present)?$signature_present:$signature_present=0;
    isset($disabled)?$disabled:$disabled=0;
    isset($comments)?$comments:$comments="";


?>
<!DOCTYPE html>
<head>
<title>Visit</title>
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
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Visit Information</h4>
    <div>
        <b>EVENT ID:<?php echo $event_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?></b><br><br>
    </div>
<p><p>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="person_id"> Person ID</label> 
      <div class="col-md-1">
        <input type="text" name="person_id" class="form-control" id="person_id" value="<?php echo $person_id; ?>" readonly>
      </div>
      <label class="control-label col-md-1" for ="event_type"> Event Type</label> 
      <div class="col-md-2">
        <input type="text" name="event_type" class="form-control" id="event_type" value="<?php echo $event_type; ?>" readonly> 
      </div>
      <label class="control-label col-md-1" for ="patient_barcode"> Patient Barcode</label> 
      <div class="col-md-1">
        <input type="text" name="patient_barcode" class="form-control" id="patient_barcode" value="<?php echo $patient_barcode; ?>">
      </div>
      <label class="control-label col-md-1" for ="endo_barcode"> Colonoscopy Barcode</label> 
      <div class="col-md-1">
        <input type="text" name="endo_barcode" class="form-control" id="endo_barcode" value="<?php echo $endo_barcode; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="event_date"> Exam Date</label> 
      <div class="col-md-2">
        <input type="date" name="event_date" class="form-control" id="event_date" value="<?php echo $event_date; ?>" required>
      </div>
      <label class="control-label col-md-1" for ="est_exam_date"> Exam Date was Estimated</label> 
      <div class="checkbox col-md-1">
        <input type="checkbox" name="est_exam_date" id="est_exam_date" value="1" <?php echo $est_exam_date=="1"?"checked":""; ?>>
      </div>
      <label class="control-label col-md-1" for ="medical_record_number"> Medical Record Number</label> 
      <div class="col-md-1">
        <input type="text" name="medical_record_number" class="form-control" id="medical_record_number" value="<?php echo $medical_record_number; ?>">
      </div>
      <label class="control-label col-md-1" for ="batch_id"> Batch</label> 
      <div class="col-md-1">
        <input type="text" name="batch_id" class="form-control" id="batch_id" value="<?php echo $batch_id; ?>" readonly>
      </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Signature</label> 
        <div class="checkbox col-md-2">
            <input type="checkbox" name="signature_present" value="1" <?php echo $signature_present=="1"?"checked":""; ?>>Present
        </div>
        <div class="checkbox col-md-2">
            <input type="checkbox" name="not_approached" value="1" <?php echo $not_approached=="1"?"checked":""; ?>>Not Approached
        </div>
        <div class="checkbox col-md-6">
            <input type="checkbox" name="disabled" value="1" <?php echo $disabled=="1"?"checked":""; ?>>Disabled
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_code">Endoscopist:</label>
        <div class="col-md-3">
        <select name="endo_code" class="form-control" id = "endo_code">
                <option value="">Make selection </option>
                <?php
                    foreach ($endo_array as $v) {
                ?>
                    <option value="<?php echo $v[0]?>" 
                <?php
                    if($endo_code == $v[0]){
                        echo "selected=\"selected\""; 
                    }
                ?>
                    >
                <?php echo $v[0].' - '.$v[1]?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
        </div>
    </div>

    <div class="text-center form-group row">
        <button id="return_entry" type="button" class="btn btn-link">Return to Data Entry</button>
    </div>

    <div class="text-center">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Submit">
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/event.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>