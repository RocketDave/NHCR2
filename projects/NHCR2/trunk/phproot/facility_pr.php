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
$submit_message = "";

isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";


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
    isset($status)?$status:$status="";
    isset($pth_reports_contact_name)?$pth_reports_contact_name:$pth_reports_contact_name="";
    isset($pth_reports_contact_phone)?$pth_reports_contact_phone:$pth_reports_contact_phone="";
    isset($pth_reports_contact_email)?$pth_reports_contact_email:$pth_reports_contact_email="";
    isset($pth_req_required)?$pth_req_required:$pth_req_required="";
    isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd="";
    isset($pth_req_instructions)?$pth_req_instructions:$pth_req_instructions="";
    isset($pth_req_sort_col)?$pth_req_sort_col:$pth_req_sort_col="";

}

$result = $session->db_query("select * from vFacilities where facility_id = '" . $facility_id . "'");

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
    isset($status)?$status:$status="";
    isset($pth_reports_contact_name)?$pth_reports_contact_name:$pth_reports_contact_name="";
    isset($pth_reports_contact_phone)?$pth_reports_contact_phone:$pth_reports_contact_phone="";
    isset($pth_reports_contact_email)?$pth_reports_contact_email:$pth_reports_contact_email="";
    isset($pth_req_required)?$pth_req_required:$pth_req_required="";
    isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd="";
    isset($pth_req_sort_col)?$pth_req_sort_col:$pth_req_sort_col="";

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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="facility_id" name="facility_id" value="<?php echo $facility_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h3> Facility </h3>
    <div>
        Facility:<?php echo $facility_name; ?><br>
        ID:<b><?php echo $facility_id; ?><br>
        Status:<?php echo $status; ?><br>
        Last Update: <?php echo $action_on; ?><br>
        By: <?php echo $action_by; ?><br><br>
    </div>
    <ul class="nav nav-tabs">
    <?php
        echo "<li><a href=\"javascript:setPatientAction('facility.php');\"> Home</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('facility_e.php');\"> Endoscopists</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('facility_a.php');\"> Associated Facilities</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('facility_p.php');\"> Labs</a></li>";
        echo "<li class='active'><a href=\"javascript:setPatientAction('facility_pr.php');\"> Path Requests</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('facility_irb.php');\"> IRB</a></li>";
    ?>
    </ul>
    <h4> Path Requests </h4>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="pth_req_required">Path Request Required</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="pth_req_required" value="1" <?php echo $pth_req_required=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="pth_consent_form_reqd">Consent Form Required</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="pth_consent_form_reqd" value="1" <?php echo $pth_consent_form_reqd=="1"?"checked":""; ?>>
        </div>
      <div class="col-md-2">
            <select class="form-control" id="pth_req_sort_col" name="pth_req_sort_col">
                <option value="">Make selection </option>
                <option value="Last name" 
                <?php 
                    if($pth_req_sort_col=='Last name'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Las name
                </option>
                <option value="Exam date" 
                <?php 
                    if($pth_req_sort_col=='Exam date'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Exam date
                </option>
                <option value="No choice" 
                <?php 
                    if($pth_req_sort_col=='No choice'){
                        echo "selected=\"selected\""; 
                    }
                ?>>No choice
                </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="pth_req_instructions"> Path Request Instructions:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="pth_req_instructions" ><?php echo $pth_req_instructions;?> </textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="pth_reports_contact_name">Contact:</label>
        <div class="col-md-2">
            <input type="text" name="pth_reports_contact_name" class="form-control" id="pth_reports_contact_name" value="<?php echo $pth_reports_contact_name; ?>">
        </div>
        <label class="control-label col-md-1" for="pth_reports_contact_phone">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" id="pth_reports_contact_phone" name="pth_reports_contact_phone"placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $pth_reports_contact_phone;?>">
        </div>
        <label class="control-label col-md-1" for="pth_reports_contact_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="pth_reports_contact_email" class="form-control" id="pth_reports_contact_email" value="<?php echo $pth_reports_contact_email; ?>">
        </div>
    </div>
<div class="text-center">
    <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save">
</div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/facility_a.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
<script type="text/javascript" >
</html>