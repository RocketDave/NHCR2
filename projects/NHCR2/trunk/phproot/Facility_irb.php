<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$fac_id = "";
$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";

$fac_array = array();
$result = pg_query ($conn,'select facility_id as fac_id, facility_name from Facility order by facility_name;' ) ;
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
    isset($facility_id)?$facility_id:$facility_id="";
    isset($facility_name)?$facility_name:$facility_name="";
    isset($irb_of_record)?$irb_of_record:$irb_of_record="";
    isset($irb_review_date)?$irb_review_date:$irb_review_date="";
    isset($irb_consent_form)?$irb_consent_form:$irb_consent_form="";
    isset($irb_active_consent_version)?$irb_active_consent_version:$irb_active_consent_version="";
    isset($irb_approval_date)?$irb_approval_date:$irb_approval_date="";
    isset($irb_expiration_date)?$irb_expiration_date:$irb_expiration_date="";
    isset($irb_contact_name)?$irb_contact_name:$irb_contact_name="";
    isset($irb_contact_phone)?$irb_contact_phone:$irb_contact_phone="";
    isset($irb_contact_email)?$irb_contact_email:$irb_contact_email="";

    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.set_facility_irb($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $facility_id,
                $irb_of_record,
                $irb_review_date,
                $irb_consent_form,
                $irb_active_consent_version,
                $irb_approval_date,
                $irb_expiration_date,
                $irb_contact_name,
                $irb_contact_phone,
                $irb_contact_email)
                );
            if($result)
                $submit_message  = 'Record updated';
            else
                throw new exception ('Problem updating record.');
        }
    }
    catch (Exception $e) {
        echo 'ERROR: '.$e;
    }
}
$result = pg_query($conn,"select * from vFacilities where facility_id = '" . $facility_id . "'");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($facility_id)?$facility_id:$facility_id="";
isset($facility_name)?$facility_name:$facility_name="";
isset($irb_of_record)?$irb_of_record:$irb_of_record="";
isset($irb_review_date)?$irb_review_date:$irb_review_date="";
isset($irb_consent_form)?$irb_consent_form:$irb_consent_form="";
isset($irb_active_consent_version)?$irb_active_consent_version:$irb_active_consent_version="";
isset($irb_approval_date)?$irb_approval_date:$irb_approval_date="";
isset($irb_expiration_date)?$irb_expiration_date:$irb_expiration_date="";
isset($irb_contact_name)?$irb_contact_name:$irb_contact_name="";
isset($irb_contact_phone)?$irb_contact_phone:$irb_contact_phone="";
isset($irb_contact_email)?$irb_contact_email:$irb_contact_email="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Facility</title>
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
<input type="hidden" id="facility_id" name="facility_id" value="<?php echo $facility_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
<?php include("includes/header_f.php"); ?>
    <div>
        <b><?php echo $facility_name; ?><br>
        ID:<?php echo $facility_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <h4> IRB </h4>
    <div class="form-group row">
      <label class="control-label col-md-2" for="irb_of_record">IRB of record</label>
      <div class="col-md-2">
            <select class="form-control" id="irb_of_record" name="irb_of_record">
                <option value="">Make selection </option>
                <option value="Local" 
                <?php 
                    if($irb_of_record=='Local'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Local
                </option>
                <option value="CPHS" 
                <?php 
                    if($irb_of_record=='CPHS'){
                        echo "selected=\"selected\""; 
                    }
                ?>>CPHS
                </option>
                <option value="Delegated to CPHS" 
                <?php 
                    if($irb_of_record=='Delegated to CPHS'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Delegated to CPHS
                </option>
                <option value="Other" 
                <?php 
                    if($irb_of_record=='Other'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Other
                </option>
            </select>
      </div>
        <label class="control-label col-md-2" for="irb_review_date">Initial IRB review date:</label>
        <div class="col-md-2">
            <input type="date" name="irb_review_date" class="form-control" id="irb_review_date" value="<?php echo $irb_review_date; ?>">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="irb_consent_form">Consent form</label>
      <div class="col-md-2">
            <select class="form-control" id="irb_consent_form" name="irb_consent_form">
                <option value="">Make selection </option>
                <option value="CPHS approved (generic)" 
                <?php 
                    if($irb_consent_form=='CPHS approved (generic)'){
                        echo "selected=\"selected\""; 
                    }
                ?>>CPHS approved (generic)
                </option>
                <option value="locally approved" 
                <?php 
                    if($irb_consent_form=='locally approved'){
                        echo "selected=\"selected\""; 
                    }
                ?>>locally approved
                </option>
            </select>
      </div>
        <label class="control-label col-md-2" for="irb_active_consent_version">Active Consent form version (if locally approved):</label>
        <div class="col-md-3">
            <input type="text" name="irb_active_consent_version" class="form-control" id="irb_active_consent_version" value="<?php echo $irb_active_consent_version; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="irb_contact_name">Contact:</label>
        <div class="col-md-2">
            <input type="text" name="irb_contact_name" class="form-control" id="irb_contact_name" value="<?php echo $irb_contact_name; ?>">
        </div>
        <label class="control-label col-md-2" for="irb_contact_phone">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" id="irb_contact_phone" name="irb_contact_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $irb_contact_phone;?>">
        </div>
        <label class="control-label col-md-1" for="irb_contact_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="irb_contact_email" class="form-control" id="irb_contact_email" value="<?php echo $irb_contact_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="irb_approval_date">IRB approval date:</label>
        <div class="col-md-2">
            <input type="date" name="irb_approval_date" class="form-control" id="irb_approval_date" value="<?php echo $irb_approval_date; ?>">
        </div>
        <label class="control-label col-md-2" for="irb_expiration_date">IRB expiration date:</label>
        <div class="col-md-2">
            <input type="date" name="irb_expiration_date" class="form-control" id="irb_expiration_date" value="<?php echo $irb_expiration_date; ?>">
        </div>
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
<script type="text/javascript" src="./js/facility_irb.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>