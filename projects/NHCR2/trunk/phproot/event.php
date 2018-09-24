<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

$current_date = date("m/d/Y");
$cuttoff = date("m/d/Y",strtotime("-2 days"));
$daylen=60*60*24;

$submit_message = "";
$error_message = "";
$errors = 0;

isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id=-9;
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";
isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
isset($_SESSION['batch_id'])?$batch_id=$_SESSION['batch_id']:$batch_id=null;

if ($batch_id != null ) {
	$result = pg_query ($conn,'select facility_id from Batch where batch_id = '.$batch_id);
	if ($result) {
		$rows = pg_fetch_assoc( $result );
		$facility_id = $rows['facility_id'];
	}
}

/* see if the page was submitted	*/
if (array_key_exists('confirm_submit', $_POST))   {
	foreach ($_POST as $key => $value)	{
		  /* assign to var (strip whitespace if 2t an array)	*/
		  ${$key} = is_array($value) ? $value : trim($value);
	}

	isset($action_on)?$action_on:$action_on="";
	isset($action_by)?$action_by:$action_by="";
	isset($inserted_on)?$inserted_on:$inserted_on="";
	isset($event_id)?$event_id:$event_id=-9;
	isset($person_id)?$person_id:$person_id="";
	isset($endo_barcode)?$endo_barcode:$endo_barcode="";
	isset($patient_barcode)?$patient_barcode:$patient_barcode="";
	isset($event_date)?$event_date:$event_date="";
	isset($event_type)?$event_type:$event_type="Colonoscopy";
	isset($batch_id)?$batch_id:$batch_id=null;
	isset($medical_record_number)?$medical_record_number:$medical_record_number="";
	isset($endo_code)?$endo_code:$endo_code=0;
	isset($est_exam_date)?$est_exam_date:$est_exam_date=0;
	isset($signature_present)?$signature_present:$signature_present=null;
	isset($comments)?$comments:$comments="";
	isset($second_batch)?$second_batch:$second_batch=null;

	$yr_check = explode('-',$event_date,3);
	$the_yr = $yr_check[0];

	if ($event_date == "") {
		$errors = 1;
		$error_message = 'Please enter the exam date.';
	}

	if(trim($event_date) != '') {
		if(strtotime($event_date) > strtotime(date('m/d/Y'))) {
			$errors = 1;
			$error_message = 'Exam date cannot be in the future.';
		}elseif($the_yr < 2004) {
				$error_message = 'Exam date cannot be before 2004. </font>';
				$errors = 1;
		}
	}

	if ($patient_barcode == "" and $endo_barcode == "") {
		$errors = 1;
		$error_message  = 'You must enter at least one barcode';
	}

	if ($event_date == "") {
		$errors = 1;
		$error_message = 'Please enter the exam date.';
	}

	if ($endo_code == 0) {
		$errors = 1;
		$error_message = 'Please select an endoscopist';
	}

	if ($signature_present == "") {
		$errors = 1;
		$error_message = 'Please make a selection for signature';
	}

	if ($errors == 1) {
		$error_message = $error_message.' -  RECORD NOT SAVED!!!';
	}

	if ($errors == 0) {
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
					$signature_present,
					$comments,
					$facility_id,
					(int)$second_batch
					)
				);
				if($result) {
						$rows = pg_fetch_assoc( $result );
						$event_id = $rows['lcl_event_id'];
						$submit_message = $rows['lcl_message'];
						if ($submit_message != 'Record Updated') {
							$errors = 1;
							$error_message = $submit_message.' -  RECORD NOT SAVED!!!';
							$submit_message = '';
						}
					}
				else
					throw new Exception(pg_last_error($conn));
			} else	{
					throw new Exception(pg_last_error($conn));
				}
		}	catch(Exception $e)	{
			echo 'ERROR: '.$e;
		}
	}
}

if ($errors == 0) {
	$result = pg_query("select * from vEvents where event_id = " . $event_id);

	while($row = pg_fetch_array($result)){
		foreach ($row as $key => $value) {
			/* assign to var (strip whitespace if 2t an array)	*/
			${$key} = is_array($value) ? $value : trim($value);
		}
	}

	isset($action_on)?$action_on:$action_on="";
	isset($action_by)?$action_by:$action_by="";
	isset($inserted_on)?$inserted_on:$inserted_on="";
	isset($event_id)?$event_id:$event_id=-9;
	isset($person_id)?$person_id:$person_id="";
	isset($endo_barcode)?$endo_barcode:$endo_barcode="";
	isset($patient_barcode)?$patient_barcode:$patient_barcode="";
	isset($event_date)?$event_date:$event_date="";
	isset($event_type)?$event_type:$event_type="Colonoscopy";
	isset($batch_id)?$batch_id:$batch_id=null;
	isset($medical_record_number)?$medical_record_number:$medical_record_number="";
	isset($endo_code)?$endo_code:$endo_code=0;
	isset($est_exam_date)?$est_exam_date:$est_exam_date=0;
	isset($signature_present)?$signature_present:$signature_present=null;
	isset($comments)?$comments:$comments="";
	isset($second_batch)?$second_batch:$second_batch=null;
}

$endo_array = array();
if ($facility_id != "") {
	$result = pg_query ("select endoscopist_id as endo_code,mail_name,endo_last_name from vEndoFac where endo_status = 'Active' and facility_id = '".$facility_id."' union select 8888,'to be determined','zz' union select 9999,'unknown or refused','zz'  order by endo_last_name;" ) ;
}
else {
	$result = pg_query ("select endoscopist_id as endo_code,mail_name,endo_last_name from vEndoFac where endo_status = 'Active' union select 8888,'to be determined','zz' union select 9999,'unknown or refused','zz' order by endo_last_name;" ) ;
}

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

?>
<!DOCTYPE html>
<head>
<title>Event</title>
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
<input type="hidden" id="facility_id" name="facility_id" value="<?php echo $facility_id; ?>"/>
<div class="container-fluid">

<?php
	if(isset($submit_message))	{	
		echo '<div class="text-center bg-info h3">'.$submit_message.'</div>'; 
	}
	if(isset($error_message))	{	
			echo '<div class="text-center bg-danger h3">'.$error_message.'</div>'; 
	}
?>
	<h3> Event Information</h3>
<?php if(isset($_SESSION['batch_id']))  {
	echo '<h3 class="alert-info"> Working on Batch #'.$_SESSION['batch_id'].'</h3>';
	} 
?>
	<div>
		<b>EVENT ID:<?php echo $event_id; ?><br>
		<b>Facility ID:<?php echo $facility_id; ?><br>
		Last Update: <?php echo $action_on;?><br>
		By: <?php echo $action_by; ?></b><br>
		Inserted ON: <?php echo $inserted_on; ?></b><br><br>

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
	  <label class="control-label col-md-1" for ="batch_id"> Batch</label> 
	  <div class="col-md-1">
		<input type="text" name="batch_id" class="form-control" id="batch_id" value="<?php echo $batch_id; ?>" <?php echo ($batch_id!= "")?"readonly":""; ?>>
	  </div>
	  <label class="control-label col-md-1" for ="second_batch"> Second Batch</label> 
	  <div class="col-md-1">
		<input type="text" name="second_batch" class="form-control" id="second_batch" value="<?php echo $second_batch; ?>">
	  </div>
	</div>
	<div class="form-group row">
	  <label class="control-label col-md-2" for ="patient_barcode"> Patient Barcode</label> 
	  <div class="col-md-2">
		<input type="text" name="patient_barcode" class="form-control required text-capitalize" id="patient_barcode" value="<?php echo $patient_barcode; ?>" <?php echo (($inserted_on!=$current_date and $inserted_on != "") and ($patient_barcode!=""))?"readonly":""; ?> autofocus>
	  </div>
	  <label class="control-label col-md-1" for ="endo_barcode"> Colonoscopy Barcode</label> 
	  <div class="col-md-2">
		<input type="text" name="endo_barcode" class="form-control required text-capitalize" id="endo_barcode" value="<?php echo $endo_barcode; ?>" <?php echo (($inserted_on!=$current_date and $inserted_on != "") and ($endo_barcode!="")) ?"readonly":""; ?>>
	  </div>
	</div>
	<div class="form-group row">
	  <label class="control-label col-md-2" for ="event_date"> Exam Date</label> 
	  <div class="col-md-2">
		<input type="date" name="event_date" class="form-control required" id="event_date" value="<?php echo $event_date; ?>">
	  </div>
	  <label class="control-label col-md-1" for ="est_exam_date"> Exam Date was Estimated</label> 
	  <div class="checkbox col-md-1">
		<input type="checkbox" name="est_exam_date" id="est_exam_date" value="1" <?php echo $est_exam_date=="1"?"checked":""; ?>>
	  </div>
	  <label class="control-label col-md-1" for ="medical_record_number"> Medical Record Number</label> 
	  <div class="col-md-2">
		<input type="text" name="medical_record_number" class="form-control" id="medical_record_number" value="<?php echo $medical_record_number; ?>">
	  </div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2">Signature</label> 
		<div class="col-md-1">
		<label class="radio-inline">
			<input type="radio" name="signature_present" value="1" <?php echo $signature_present=="1"?"checked":""; ?>>Present</label>
		 </div>
		<div class="col-md-1">
		<label class="radio-inline">
			<input type="radio" name="signature_present" value="0" <?php echo $signature_present=="0"?"checked":""; ?>>Not present</label>
		</div>
		<div class="col-md-1">
		<label class="radio-inline">
			<input type="radio" name="signature_present" value="2" <?php echo $signature_present=="2"?"checked":""; ?>>PIF complete, consent unsigned</label>
		</div>
	</div>

	<div class="form-group row">
	  <label class="control-label col-md-2" for="endo_code">Endoscopist:</label>
		<div class="col-md-3">
		<select name="endo_code" class="form-control required" id = "endo_code">
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

<?php

	if ((strtotime($cuttoff)-strtotime($inserted_on))/$daylen < 1) {
	echo '<div class="form-group row">';
		echo '<div class="text-center">';
			echo '<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">Delete this record</button></div></div>';
	echo '<div id="myModal" class="modal fade" role="dialog">';
		echo '<div class="modal-dialog modal-sm">';
			echo '<div class="modal-content">';
				echo '<div class="modal-header">';
					echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
					echo '<h4 class="modal-title">Delete Record</h4>';
				 echo '</div>';
				echo '<div class="modal-body">';
					echo '<p id="confirmMessage">Are you sure?</p>';
				echo '</div>';
				echo '<div class="modal-footer">';
					echo '<button class="btn" id="confirmFalse">Cancel</button>';
					echo '<button class="btn btn-primary" id="confirmTrue">OK</button>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	}
?>

	<div class="text-center form-group row">
		<input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save">
	</div>

<?php if (isset($_SESSION['batch_id'])) { echo
	'<div class="text-center form-group row">
		<a href="batchentry.php">Return to Entry</a>
	</div>';
}?>

	<div class="form-group row">
		<div class="text-center">
			<button id="to_person" type="button" class="btn btn-link">Return to Person</button>
		</div>
	</div>

	<div class="text-center form-group row">
		<a href="events.php">Return to Events</a>
	</div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/event_v7.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
		pg_close($conn);
} 
?>