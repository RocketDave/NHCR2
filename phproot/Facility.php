<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();
$current_date = date("Y-m-d");

$submit_message = "";
isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
$state_list = array();
$result = pg_query ($conn,'select fips_alpha_code from public.FIPS_STATE where display_order=1 order by get_order;' ) ;

while ($row = pg_fetch_row ($result)) { 
	$state_list[] = $row[0];
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
    isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
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
    isset($ctc)?$ctc:$ctc=0;
    isset($how_write_reports)?$how_write_reports:$how_write_reports="";
    isset($comments)?$comments:$comments="";
    isset($contact1_name)?$contact1_name:$contact1_name="";
    isset($contact1_phone)?$contact1_phone:$contact1_phone="";
    isset($contact1_email)?$contact1_email:$contact1_email="";
    isset($contact1_type)?$contact1_type:$contact1_type="";
    isset($contact2_name)?$contact2_name:$contact2_name="";
    isset($contact2_phone)?$contact2_phone:$contact2_phone="";
    isset($contact2_email)?$contact2_email:$contact2_email="";
    isset($contact2_type)?$contact2_type:$contact2_type="";
    isset($contact3_name)?$contact3_name:$contact3_name="";
    isset($contact3_phone)?$contact3_phone:$contact3_phone="";
    isset($contact3_email)?$contact3_email:$contact3_email="";
    isset($contact3_type)?$contact3_type:$contact3_type="";
    isset($facility_type)?$facility_type:$facility_type="";

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_facility($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,$25,$26,$27,$28,$29)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $facility_id,
                $facility_name,
                $facility_pseudo_name,
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
                $ctc,
                $comments,
                $contact1_name,
                $contact1_phone,
                $contact1_email,
                $contact1_type,
                $contact2_name,
                $contact2_phone,
                $contact2_email,
                $contact2_type,
                $contact3_name,
                $contact3_phone,
                $contact3_email,
                $contact3_type,
                $facility_type)
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $facility_id = $rows['lcl_facility_id'];
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
isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
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
isset($ctc)?$ctc:$ctc=0;
isset($how_write_reports)?$how_write_reports:$how_write_reports="";
isset($comments)?$comments:$comments="";
isset($contact1_name)?$contact1_name:$contact1_name="";
isset($contact1_phone)?$contact1_phone:$contact1_phone="";
isset($contact1_email)?$contact1_email:$contact1_email="";
isset($contact1_type)?$contact1_type:$contact1_type="";
isset($contact2_name)?$contact2_name:$contact2_name="";
isset($contact2_phone)?$contact2_phone:$contact2_phone="";
isset($contact2_email)?$contact2_email:$contact2_email="";
isset($contact2_type)?$contact2_type:$contact2_type="";
isset($contact3_name)?$contact3_name:$contact3_name="";
isset($contact3_phone)?$contact3_phone:$contact3_phone="";
isset($contact3_email)?$contact3_email:$contact3_email="";
isset($contact3_type)?$contact3_type:$contact3_type="";
isset($facility_type)?$facility_type:$facility_type="";



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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<div class="container-fluid">
    <?php include("includes/header_f.php"); ?>
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <div>
        <b><?php echo $facility_name; ?><br>
        ID:<?php echo $facility_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="facility_name"> Name:</label> 
      <div class="col-md-4">
        <input type="text" name="facility_name" class="form-control" id="facility_name" value="<?php echo $facility_name; ?>">
      </div>
      <label class="control-label col-md-2" for ="facility_pseudo_name"> Pseudo name:</label> 
      <div class="col-md-1">
        <input type="text" name="facility_pseudo_name" class="form-control" id="facility_pseudo_name" value="<?php echo $facility_pseudo_name; ?>">
      </div>
      <label class="control-label col-md-1" for ="facility_id"> ID:</label> 
      <div class="col-md-1">
        <input type="text" name="facility_id" class="form-control" id="facility_id" value="<?php echo $facility_id; ?>" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="facility_type">Facility Type</label>
      <div class="col-md-2">
            <select class="form-control" id="facility_type" name="facility_type">
                <option value="" 
                <?php 
                    if($facility_type==""){
                        echo "selected=\"selected\""; 
                    }
                ?>>Select
                </option>
                <option value="Teaching hospital" 
                <?php 
                    if($facility_type=='Teaching hospital'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Teaching hospital
                </option>
                <option value="Hospital" 
                <?php 
                    if($facility_type=='Hospital'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Hospital
                </option>
                <option value="Ambulatory surgery center" 
                <?php 
                    if($facility_type=='Ambulatory surgery center'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Ambulatory surgery center
                </option>
                <option value="Private Practice" 
                <?php 
                    if($facility_type=='Private Practice'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Private Practice
                </option>
            </select>
      </div>
        <label class="control-label col-md-1" for ="status"> Status:</label> 
        <div class="col-md-2">
            <select class="form-control" id="status" name="status">
                <option value="" 
                <?php 
                    if($status==""){
                        echo "selected=\"selected\""; 
                    }
                ?>> Select
                </option>
                <option value="Active" 
                <?php 
                    if($status=='Active'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Active
                </option>
                <option value="Inactive" 
                <?php 
                    if($status=='Inactive'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Inactive
                </option>
                <option value="Paused" 
                <?php 
                    if($status=='Paused'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Paused
                </option>
                <option value="Refused" 
                <?php 
                    if($status=='Refused'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Refused
                </option>
                <option value="Merged" 
                                <?php 
                    if($status=='Merged'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Merged
                </option>
            </select>
        </div>
        <label class="control-label col-md-1" for="status_date">As of:</label>
        <div class="col-md-2">
            <input type="date" name="status_date" class="form-control" id="status_date" value="<?php echo $status_date; ?>">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="how_write_reports">How site does reports:</label>
      <div class="col-md-2">
            <select class="form-control" id="how_write_reports" name="how_write_reports">
                <option value="" 
                <?php 
                    if($how_write_reports==''){
                        echo "selected=\"selected\""; 
                    }
                ?>>Select
                <option value="Dictation" 
                <?php 
                    if($how_write_reports=='Dictation'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Dictation
                </option>
                <option value="Provatio" 
                <?php 
                    if($how_write_reports=='Provatio'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Provatio
                </option>
                <option value="Pentax" 
                <?php 
                    if($how_write_reports=='Pentax'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Pentax
                </option>
            </select>
      </div>
      <label class="control-label col-md-1" for="fax">Fax:</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="fax" id="fax" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $fax;?>">
      </div>

    <label class="control-label col-md-1" for="implementation_date">Implementation:</label>
      <div class="col-md-2">
        <input type="date" name="implementation_date" id="implementation_date" class="form-control"  value="<?php echo $implementation_date; ?>">
      </div>
    <label class="control-label col-md-1" for ="ctc">CTC:</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ctc" id="ctc" value="1" <?php echo $ctc=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="address1">Address:</label>
      <div class="col-md-6">
        <input type="text" name="address1" id="address1" class="form-control address"  placeholder="address line 1" value="<?php echo $address1; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="address2"></label>
      <div class="col-md-6">
        <input type="text" name="address2" id="address2" class="form-control address" placeholder="address line 2" value="<?php echo $address2; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="address3"></label>
      <div class="col-md-6">
        <input type="text" name="address3" id="address3" class="form-control address"  placeholder="address line 3" value="<?php echo $address3; ?>">
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
                <option value="">Select
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
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Contacts</label>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Type:</label>
        <div class="col-md-1">
            <input type="text" name="contact1_type" class="form-control" id="contact1_type" value="<?php echo $contact1_type; ?>">
        </div>
        <label class="control-label col-md-1">Name:</label>
        <div class="col-md-2">
            <input type="text" name="contact1_name" class="form-control" id="contact1_name" value="<?php echo $contact1_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact1_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact1_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact1_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="contact1_email" class="form-control" id="contact1_email" value="<?php echo $contact1_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Type:</label>
        <div class="col-md-1">
            <input type="text" name="contact2_type" class="form-control" id="contact2_type" value="<?php echo $contact2_type; ?>">
        </div>
        <label class="control-label col-md-1">Name:</label>
        <div class="col-md-2">
            <input type="text" name="contact2_name" class="form-control" id="contact2_name" value="<?php echo $contact2_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact2_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact2_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact2_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="contact2_email" class="form-control" id="contact2_email" value="<?php echo $contact2_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Type:</label>
        <div class="col-md-1">
            <input type="text" name="contact3_type" class="form-control" id="contact3_type" value="<?php echo $contact3_type; ?>">
        </div>
        <label class="control-label col-md-1">Name:</label>
        <div class="col-md-2">
            <input type="text" name="contact3_name" class="form-control" id="contact3_name" value="<?php echo $contact3_name; ?>">
        </div>
        <label class="control-label col-md-1">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="contact3_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $contact3_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact3_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="contact3_email" class="form-control" id="contact3_email" value="<?php echo $contact3_email; ?>">
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
<script type="text/javascript" src="./js/facility.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>