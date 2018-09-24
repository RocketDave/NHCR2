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
isset($_POST['path_lab_id'])?$path_lab_id=$_POST['path_lab_id']:$path_lab_id=-9;
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
    isset($path_lab_id)?$path_lab_id:$path_lab_id=-9;
    isset($lab_code)?$lab_code:$lab_code="";
    isset($lab_name)?$lab_name:$lab_name="";
    isset($address1)?$address1:$address1="";
    isset($address2)?$address2:$address2="";
    isset($city)?$city:$city="";
    isset($state)?$state:$state="";
    isset($zip)?$zip:$zip="";
    isset($fax)?$fax:$fax="";
    isset($status)?$status:$status="";
    isset($status_date)?$status_date:$status_date="";
    isset($comments)?$comments:$comments="";
    isset($contact1_name)?$contact1_name:$contact1_name="";
    isset($contact1_phone)?$contact1_phone:$contact1_phone="";
    isset($contact1_email)?$contact1_email:$contact1_email="";
    isset($contact1_type)?$contact1_type:$contact1_type="";
    isset($contact2_name)?$contact2_name:$contact2_name="";
    isset($contact2_phone)?$contact2_phone:$contact2_phone="";
    isset($contact2_email)?$contact2_email:$contact2_email="";
    isset($contact2_type)?$contact2_type:$contact2_type="";

    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.set_pathlab($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $path_lab_id,
                $lab_code,
                $lab_name,
                $address1,
                $address2,
                $city,
                $state,
                $zip,
                $fax,
                $status,
                $status_date,
                $comments,
                $contact1_name,
                $contact1_phone,
                $contact1_email,
                $contact1_type,
                $contact2_name,
                $contact2_phone,
                $contact2_email,
                $contact2_type)
                );
            if($result) {
                $rows = pg_fetch_assoc( $result );
                $path_lab_id = $rows['lcl_path_lab_id'];
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

$result = pg_query($conn,"select * from path_lab where path_lab_id = ".$path_lab_id);

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($path_lab_id)?$path_lab_id:$path_lab_id=-9;
isset($lab_code)?$lab_code:$lab_code="";
isset($lab_name)?$lab_name:$lab_name="";
isset($address1)?$address1:$address1="";
isset($address2)?$address2:$address2="";
isset($city)?$city:$city="";
isset($state)?$state:$state="";
isset($zip)?$zip:$zip="";
isset($fax)?$fax:$fax="";
isset($status)?$status:$status="";
isset($status_date)?$status_date:$status_date="";
isset($comments)?$comments:$comments="";
isset($contact1_name)?$contact1_name:$contact1_name="";
isset($contact1_phone)?$contact1_phone:$contact1_phone="";
isset($contact1_email)?$contact1_email:$contact1_email="";
isset($contact1_type)?$contact1_type:$contact1_type="";
isset($contact2_name)?$contact2_name:$contact2_name="";
isset($contact2_phone)?$contact2_phone:$contact2_phone="";
isset($contact2_email)?$contact2_email:$contact2_email="";
isset($contact2_type)?$contact2_type:$contact2_type="";


?>
<!DOCTYPE html>
<head>
<title>Path Labs</title>
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
<input type="hidden" id="path_lab_id" name="path_lab_id" value="<?php echo $path_lab_id; ?>">
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
} ?>
    <h4> Path Lab </h4>
<?php include("includes/header_pl.php"); ?>
    <div>
        ID:<?php echo $path_lab_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br>
    </div>

    <div class="form-group row">
      <label class="control-label col-md-2" for ="lab_name"> Name:</label> 
      <div class="col-md-4">
        <input type="text" name="lab_name" class="form-control" id="lab_name" value="<?php echo $lab_name; ?>" required>
      </div>
      <label class="control-label col-md-1" for ="lab_code"> ID:</label> 
      <div class="col-md-1">
        <input type="text" name="lab_code" class="form-control" id="lab_code" value="<?php echo $lab_code; ?>" required>
      </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="status"> Status:</label> 
        <div class="col-md-2">
            <select class="form-control" id="status" name="status">
                <option value="">Make selection </option>
                <option value="Collecting" 
                <?php 
                    if($status=='Collecting'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Collecting
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
        <label class="control-label col-md-2" for="fax">Fax:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="fax" id="fax" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $fax;?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="address1">Address:</label>
        <div class="col-md-6">
            <input type="text" name="address1" class="form-control address" id="address1" placeholder="address line 1" value="<?php echo $address1; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="address2"></label>
        <div class="col-md-6">
            <input type="text" name="address2" class="form-control address" id="address2" placeholder="address line 2" value="<?php echo $address2; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="city">City:</label>
        <div class="col-md-2">
            <input type="text" name="city" class="form-control address" id="city" placeholder="City" value="<?php echo $city; ?>">
        </div>

        <label class="control-label col-md-1" for="state">State:</label>
        <div class="col-md-2">
            <select name="state" class="address form-control address" id="state">
                <option value="">Make selection </option>
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
            <input type="text" class="form-control" name="contact1_phone" id="contact1_phone" value="<?php echo $contact1_phone;?>">
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
            <input type="text" class="form-control" name="contact2_phone" id="contact2_phone" value="<?php echo $contact2_phone;?>">
        </div>
        <label class="control-label col-md-1" for="contact2_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="contact2_email" class="form-control" id="contact2_email" value="<?php echo $contact2_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
        </div>
    </div>
    <div class="text-center">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save">
    </div>
</div>
</form>
<?php include("includes/footer.php"); ?>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="./js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/pathlab.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>