<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");

$session->check_session($_SERVER['REQUEST_URI']);

try {
    $session->db_reconnect();
    if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
        $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
        header('Location: Logout.php');
    }
}
catch (Exception $e) {
    $session->info['message'] = $e->getMessage();
}

$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
echo 'Facility ID' . $_POST['facility_id'];
$state_list = array();
$result = $session->db_query ('select fips_alpha_code from public.FIPS_STATE where display_order=1 order by get_order;' ) ;

while ($row = pg_fetch_row ($result)) { 
	$state_list[] = $row[0];
}

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($facility_id)?$facility_id:$facility_id="";
    isset($facility_name)?$facility_name:$facility_name="";
    isset($address1)?$address1:$address1="";
    isset($address2)?$address2:$address2="";
    isset($address3)?$address3:$address3="";
    isset($city)?$city:$city="";
    isset($state)?$state:$state="";
    isset($zip)?$zip:$zip="";
    isset($fax)?$fax:$fax="";
    isset($status)?$status:$status="";
    isset($status_date)?$status_date:$status_date="";
    isset($implementation_date)?$implementation_date:$implementation_date="";
    isset($how_write_reports)?$how_write_reports:$how_write_reports="";
    isset($comments)?$comments:$comments="";
    isset($contact_doctor_name)?$contact_doctor_name:$contact_doctor_name="";
    isset($contact_doctor_phone)?$contact_doctor_phone:$contact_doctor_phone="";
    isset($contact_doctor_email)?$contact_doctor_email:$contact_doctor_email="";
    isset($contact_staff_name)?$contact_staff_name:$contact_staff_name="";
    isset($contact_staff_phone)?$contact_staff_phone:$contact_staff_phone="";
    isset($contact_staff_email)?$contact_staff_email:$contact_staff_email="";
    isset($contact_computer_name)?$contact_computer_name:$contact_computer_name="";
    isset($contact_computer_phone)?$contact_computer_phone:$contact_computer_phone="";
    isset($contact_computer_email)?$contact_computer_email:$contact_computer_email="";
    isset($contact_path_name)?$contact_path_name:$contact_path_name="";
    isset($contact_path_phone)?$contact_path_phone:$contact_path_phone="";
    isset($contact_path_email)?$contact_path_email:$contact_path_email="";
    isset($contact_irb_name)?$contact_irb_name:$contact_irb_name="";
    isset($contact_irb_phone)?$contact_irb_phone:$contact_irb_phone="";
    isset($contact_irb_email)?$contact_irb_email:$contact_irb_email="";
    isset($facility_type)?$facility_type:$facility_type="";
    isset($contact_reports_name)?$contact_reports_name:$contact_reports_name="";
    isset($contact_reports_phone)?$contact_reports_phone:$contact_reports_phone="";
    isset($contact_reports_email)?$contact_reports_email:$contact_reports_email="";
    isset($reports_notes)?$reports_notes:$reports_notes="";
    isset($reports_instructions)?$reports_instructions:$reports_instructions="";
    isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd="";
    isset($pth_req_sort_col)?$pth_req_sort_col:$pth_req_sort_col="";
    isset($pth_req_notes)?$pth_req_notes:$pth_req_notes="";
    isset($pth_req_instructions)?$pth_req_instructions:$pth_req_instructions="";
    isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
    isset($pth_req_required)?$pth_req_required:$pth_req_required="";

    try{
        if(empty($html_errors))    {
            $stmt = pg_prepare($conn, "call public.set_subject(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); /* 21 */
            if ($stmt) {
                pg_stmt_bind_param($stmt, "sssssssssssssssssssss",
                    $facility_id,
                    $facility_name,
                    $address1,
                    $address2,
                    $address3,
                    $city,
                    $state,
                    $zip,
                    $fax,
                    $status,
                    $status_date,
                    $implementation_date,
                    $how_write_reports,
                    $comments,
                    $contact_doctor_name,
                    $contact_doctor_phone,
                    $contact_doctor_email,
                    $contact_staff_name,
                    $contact_staff_phone,
                    $contact_staff_email,
                    $contact_computer_name,
                    $contact_computer_phone,
                    $contact_computer_email,
                    $contact_path_name,
                    $contact_path_phone,
                    $contact_path_email,
                    $contact_irb_name,
                    $contact_irb_phone,
                    $contact_irb_email,
                    $facility_type,
                    $contact_reports_name,
                    $contact_reports_phone,
                    $contact_reports_email,
                    $reports_notes,
                    $reports_instructions,
                    $pth_consent_form_reqd,
                    $pth_req_sort_col,
                    $pth_req_notes,
                    $pth_req_instructions,
                    $facility_pseudo_name,
                    $pth_req_required
                        );
                if(pg_stmt_execute($stmt)) {
                    $result = pg_stmt_result_metadata($stmt);
                    if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $facility_id = $rows['in_facility_id'];
                        $submit_message = $rows['lcl_message'];
                    }
                 }    else    {
                    throw new Exception(pg_stmt_error("On execute: ".$stmt));
                }
            }    else    {
                 throw new Exception(pg_stmt_error("On declaration: ".$stmt));
            }
        }
    }    catch(Exception $e)    {
        echo 'ERROR: '.$e;
    }
}

$result = $session->db_query("select * from vFacilities where facility_id = '" . $facility_id . "'");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

    isset($facility_id)?$facility_id:$facility_id="";
    isset($facility_name)?$facility_name:$facility_name="";
    isset($address1)?$address1:$address1="";
    isset($address2)?$address2:$address2="";
    isset($address3)?$address3:$address3="";
    isset($city)?$city:$city="";
    isset($state)?$state:$state="";
    isset($zip)?$zip:$zip="";
    isset($fax)?$fax:$fax="";
    isset($status)?$status:$status="";
    isset($status_date)?$status_date:$status_date="";
    isset($implementation_date)?$implementation_date:$implementation_date="";
    isset($how_write_reports)?$how_write_reports:$how_write_reports="";
    isset($comments)?$comments:$comments="";
    isset($contact_doctor_name)?$contact_doctor_name:$contact_doctor_name="";
    isset($contact_doctor_phone)?$contact_doctor_phone:$contact_doctor_phone="";
    isset($contact_doctor_email)?$contact_doctor_email:$contact_doctor_email="";
    isset($contact_staff_name)?$contact_staff_name:$contact_staff_name="";
    isset($contact_staff_phone)?$contact_staff_phone:$contact_staff_phone="";
    isset($contact_staff_email)?$contact_staff_email:$contact_staff_email="";
    isset($contact_computer_name)?$contact_computer_name:$contact_computer_name="";
    isset($contact_computer_phone)?$contact_computer_phone:$contact_computer_phone="";
    isset($contact_computer_email)?$contact_computer_email:$contact_computer_email="";
    isset($contact_path_name)?$contact_path_name:$contact_path_name="";
    isset($contact_path_phone)?$contact_path_phone:$contact_path_phone="";
    isset($contact_path_email)?$contact_path_email:$contact_path_email="";
    isset($contact_irb_name)?$contact_irb_name:$contact_irb_name="";
    isset($contact_irb_phone)?$contact_irb_phone:$contact_irb_phone="";
    isset($contact_irb_email)?$contact_irb_email:$contact_irb_email="";
    isset($facility_type)?$facility_type:$facility_type="";
    isset($contact_reports_name)?$contact_reports_name:$contact_reports_name="";
    isset($contact_reports_phone)?$contact_reports_phone:$contact_reports_phone="";
    isset($contact_reports_email)?$contact_reports_email:$contact_reports_email="";
    isset($reports_notes)?$reports_notes:$reports_notes="";
    isset($reports_instructions)?$reports_instructions:$reports_instructions="";
    isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd="";
    isset($pth_req_sort_col)?$pth_req_sort_col:$pth_req_sort_col="";
    isset($pth_req_notes)?$pth_req_notes:$pth_req_notes="";
    isset($pth_req_instructions)?$pth_req_instructions:$pth_req_instructions="";
    isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
    isset($pth_req_required)?$pth_req_required:$pth_req_required="";


?>
<!DOCTYPE html>
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
    <ul class="nav nav-tabs">
    <?php
        echo "<li class='active'><a href=\"javascript:setPatientAction('Facility.php');\"> Home</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('Facility_e.php');\"> Endoscopists</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('Facility_a.php');\"> Associated Facilities</a></li>";
        echo "<li><a href=\"javascript:setPatientAction('Facility_p.php');\"> Labs</a></li>";
    ?>
    </ul>
    <h3> Facility </h3>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="facility_name"> Name:</label> 
      <div class="col-md-4">
        <input type="text" name="facility_name" class="form-control" id="facility_name" value="<?php echo $facility_name; ?>">
      </div>
      <label class="control-label col-md-1" for ="facility_id"> ID:</label> 
      <div class="col-md-1">
        <input type="text" name="facility_id" class="form-control" id="facility_id" value="<?php echo $facility_id; ?>">
      </div>
      <label class="control-label col-md-2" for ="facility_pseudo_name"> Pseudo name:</label> 
      <div class="col-md-1">
        <input type="text" name="facility_pseudo_name" class="form-control" id="facility_pseudo_name" value="<?php echo $facility_pseudo_name; ?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="status"> Status:</label> 
        <div class="col-md-2">
            <select class="form-control" id="status" name="status">
                <option value="<?php echo $status; ?>" 
                <?php 
                    if($status=='Active'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Active
                </option>
                <option value="<?php echo $status; ?>" 
                <?php 
                    if($status=='Inactive'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Inactive
                </option>
                <option value="<?php echo $status; ?>" 
                <?php 
                    if($status=='Paused'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Paused
                </option>
                <option value="<?php echo $status; ?>" 
                <?php 
                    if($status=='Refused'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Refused
                </option>
                <option value="<?php echo $status; ?>" 
                                <?php 
                    if($status=='Merged'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Merged
                </option>
            </select>
        </div>
        <label class="control-label col-md-2" for="status_date">As of:</label>
        <div class="col-md-2">
            <input type="date" name="status_date" class="form-control" id="status_date" value="<?php echo $status_date; ?>">
        </div>
      <label class="control-label col-md-2" for="implementation_date">Implementation:</label>
      <div class="col-md-2">
        <input type="date" name="implementation_date" class="form-control" id="implementation_date" value="<?php echo $implementation_date; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="how_write_reports">How site does reports</label>
      <div class="col-md-2">
            <select class="form-control" id="how_write_reports" name="how_write_reports">
                <option value="<?php echo $how_write_reports; ?>" 
                <?php 
                    if($how_write_reports=='Dictation'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Dictation
                </option>
                <option value="<?php echo $how_write_reports; ?>" 
                <?php 
                    if($how_write_reports=='Provatio'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Provatio
                </option>
                <option value="<?php echo $how_write_reports; ?>" 
                <?php 
                    if($how_write_reports=='Pentax'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Pentax
                </option>
            </select>
      </div>
      <label class="control-label col-md-2" for="fax">Fax:</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="fax" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $fax;?>">
      </div>
    </div>


    <div class="form-group row">
      <label class="control-label col-md-2" for="addr1">Address line 1:</label>
      <div class="col-md-6">
        <input type="text" name="address1" class="form-control address" id="address1" placeholder="address line 1" value="<?php echo $address1; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="addr2">Address line 2:</label>
      <div class="col-md-6">
        <input type="text" name="address2" class="form-control address" id="address2" placeholder="address line 2" value="<?php echo $address2; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="addr3">Address line 3:</label>
      <div class="col-md-6">
        <input type="text" name="address3" class="form-control address" id="address3" placeholder="address line 3" value="<?php echo $address3; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="city">City:</label>
      <div class="col-md-2">
        <input type="text" name="city" class="form-control address" id="city" placeholder="City" value="<?php echo $city; ?>">
      </div>
      <label class="control-label col-md-1" for="state">State:</label>
        <div class="col-md-2">
        <select name="state" class="address form-control address" id = "state">
                <option value="" selected>
                <?php
                    foreach ($state_list as $key=>$v) {
                ?>
                    <option value="<?php echo $v?>" 
                <?php
                    if(trim($state) == trim($v)){
                        echo "selected=\"selected\""; 
                    }
                ?>
                    >
                <?php echo $v?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
      <label class="control-label col-md-1" for="zip">Zip:</label>
      <div class="col-md-1">
        <input type="text" name="zip" class="form-control address" id="zip" placeholder="zip" value="<?php echo $zip; ?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name=comments><?php echo $comments;?> </textarea>
        </div>
    </div>
        <h4> Contacts </h4>
    <div class="form-group row">
        <label class="control-label col-md-2">Doctor:</label>
        <div class="col-md-3">
            <input type="text" name="contact_doctor_name" class="form-control" id="contact_doctor_name" value="<?php echo $contact_doctor_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact_doctor_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact_doctor_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact_doctor_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="contact_doctor_email" class="form-control" id="contact_doctor_email" value="<?php echo $contact_doctor_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Staff:</label>
        <div class="col-md-3">
            <input type="text" name="contact_staff_name" class="form-control" id="contact_staff_name" value="<?php echo $contact_staff_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact_staff_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact_staff_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact_staff_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="contact_staff_email" class="form-control" id="contact_staff_email" value="<?php echo $contact_staff_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Computer</label>
        <div class="col-md-3">
            <input type="text" name="contact_computer_name" class="form-control" id="contact_computer_name" value="<?php echo $contact_computer_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact_computer_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact_computer_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact_computer_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="contact_computer_email" class="form-control" id="contact_computer_email" value="<?php echo $contact_computer_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Pathology</label>
        <div class="col-md-3">
            <input type="text" name="contact_path_name" class="form-control" id="contact_path_name" value="<?php echo $contact_path_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact_path_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact_path_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact_path_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="contact_path_email" class="form-control" id="contact_path_email" value="<?php echo $contact_path_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">IRB</label>
        <div class="col-md-3">
            <input type="text" name="contact_irb_name" class="form-control" id="contact_irb_name" value="<?php echo $contact_irb_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact_irb_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact_irb_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact_irb_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="contact_irb_email" class="form-control" id="contact_irb_email" value="<?php echo $contact_irb_email; ?>">
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
</body>
</html>