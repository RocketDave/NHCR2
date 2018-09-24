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
$errors =  0;
$error_message = "";
$warning_message  = "";

isset($_POST['endoscopist_id'])?$endoscopist_id=$_POST['endoscopist_id']:$endoscopist_id='-9';

$state_list = array();
$result = pg_query ('select fips_alpha_code from public.FIPS_STATE where display_order=1 order by get_order;' ) ;

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
    isset($endo_first_name)?$endo_first_name:$endo_first_name="";
    isset($endo_middle_name)?$endo_middle_name:$endo_middle_name="";
    isset($endo_last_name)?$endo_last_name:$endo_last_name="";
    isset($endo_name_suffix)?$endo_name_suffix:$endo_name_suffix="";
    isset($endo_initials)?$endo_initials:$endo_initials="";
    isset($endo_pseudo_name)?$endo_pseudo_name:$endo_pseudo_name="";
    isset($endo_degree)?$endo_degree:$endo_degree="";
    isset($salutation)?$salutation:$salutation="";
    isset($mail_name)?$mail_name:$mail_name="";
    isset($endo_address1)?$endo_address1:$endo_address1="";
    isset($endo_address2)?$endo_address2:$endo_address2="";
    isset($endo_address3)?$endo_address3:$endo_address3="";
    isset($endo_city)?$endo_city:$endo_city="";
    isset($endo_state)?$endo_state:$endo_state="";
    isset($endo_zip)?$endo_zip:$endo_zip="";
    isset($endo_direct_phone)?$endo_direct_phone:$endo_direct_phone="";
    isset($endo_pager)?$endo_pager:$endo_pager="";
    isset($endo_other_phone)?$endo_other_phone:$endo_other_phone="";
    isset($endo_email)?$endo_email:$endo_email="";
    isset($endo_dob)?$endo_dob:$endo_dob="";
    isset($endo_gender_male)?$endo_gender_male:$endo_gender_male="";
    isset($comments)?$comments:$comments="";
    isset($endo_status)?$endo_status:$endo_status="Active";
    isset($endo_status_date)?$endo_status_date:$endo_status_date="";

    if ($endo_last_name == "") {
        $errors = 1;
        $error_message  = 'You must enter last name.';
    }

    if ($endo_first_name == "") {
        $errors = 1;
        $error_message  = 'You must enter first name.';
    }

        if ($mail_name == "") {
        $errors = 1;
        $error_message  = 'You must enter mail name.';
    }

    if ($errors == 0) {
        try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_endoscopist($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,$25)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $endoscopist_id,
                $endo_first_name,
                $endo_middle_name,
                $endo_last_name,
                $endo_name_suffix,
                $endo_initials,
                $endo_pseudo_name,
                $endo_degree,
                $salutation,
                $mail_name,
                $endo_address1,
                $endo_address2,
                $endo_address3,
                $endo_city,
                $endo_state,
                $endo_zip,
                $endo_direct_phone,
                $endo_pager,
                $endo_other_phone,
                $endo_email,
                $endo_dob,
                $endo_gender_male,
                $comments,
                $endo_status,
                $endo_status_date)
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $endoscopist_id = $rows['lcl_endoscopist_id'];
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
}
if ($endoscopist_id != '' and $errors == 0) {
    $result = pg_query("select * from vEndoscopist where endoscopist_id = ".$endoscopist_id);

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    }
}
isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($endo_first_name)?$endo_first_name:$endo_first_name="";
isset($endo_middle_name)?$endo_middle_name:$endo_middle_name="";
isset($endo_last_name)?$endo_last_name:$endo_last_name="";
isset($endo_name_suffix)?$endo_name_suffix:$endo_name_suffix="";
isset($endo_initials)?$endo_initials:$endo_initials="";
isset($endo_pseudo_name)?$endo_pseudo_name:$endo_pseudo_name="";
isset($endo_degree)?$endo_degree:$endo_degree="";
isset($salutation)?$salutation:$salutation="";
isset($mail_name)?$mail_name:$mail_name="";
isset($endo_address1)?$endo_address1:$endo_address1="";
isset($endo_address2)?$endo_address2:$endo_address2="";
isset($endo_address3)?$endo_address3:$endo_address3="";
isset($endo_city)?$endo_city:$endo_city="";
isset($endo_state)?$endo_state:$endo_state="";
isset($endo_zip)?$endo_zip:$endo_zip="";
isset($endo_direct_phone)?$endo_direct_phone:$endo_direct_phone="";
isset($endo_pager)?$endo_pager:$endo_pager="";
isset($endo_other_phone)?$endo_other_phone:$endo_other_phone="";
isset($endo_email)?$endo_email:$endo_email="";
isset($endo_dob)?$endo_dob:$endo_dob="";
isset($endo_gender_male)?$endo_gender_male:$endo_gender_male="";
isset($comments)?$comments:$comments="";
    isset($endo_status)?$endo_status:$endo_status="Active";
isset($endo_status_date)?$endo_status_date:$endo_status_date="";

?>
<!DOCTYPE html>
<head>
<title>Endoscopists</title>
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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<div class="container-fluid">
    <h4> Endoscopist </h4>
    <?php include("includes/header_e.php"); ?>
<?php
    if(isset($submit_message))    {    
        echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } 
    if(isset($error_message))    {    
        echo '<div class="text-center bg-warning h3">'.$error_message.'</div>'; 
    }
?>
    <div>
        <b><?php echo $mail_name; ?><br>
        ID:<?php echo $endoscopist_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="endoscopist_id"> Code:</label> 
      <div class="col-md-1">
        <input type="text" name="endoscopist_id" class="form-control" id="endoscopist_id" value="<?php echo $endoscopist_id; ?>" readonly>
      </div>
      <label class="control-label col-md-1" for ="endo_initials"> Initials:</label> 
      <div class="col-md-1">
        <input type="text" name="endo_initials" class="form-control" id="endo_initials" value="<?php echo $endo_initials; ?>">
      </div>
        <label class="control-label col-md-1" for ="endo_pseudo_name"> Pseudo Name:</label> 
      <div class="col-md-2">
            <input type="text" class="form-control" name="endo_pseudo_name" id="endo_pseudo_name" placeholder="pseudo name" value="<?php echo $endo_pseudo_name;?>" readonly>
      </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="endo_status"> Status:</label> 
        <div class="col-md-2">
            <select class="form-control" id="endo_status" name="endo_status">
                <option value="">Make selection </option>
                <option value="Active" 
                <?php 
                    if($endo_status=='Active'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Active
                </option>
                <option value="Inactive" 
                <?php 
                    if($endo_status=='Inactive'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Inactive
                </option>
                <option value="Retired" 
                <?php 
                    if($endo_status=='Retired'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Retired
                </option>
            </select>
        </div>
      <label class="control-label col-md-1" for ="endo_status_date"> As of:</label> 
      <div class="col-md-2">
        <input type="date" name="endo_status_date" class="form-control" id="endo_status_date" value="<?php echo $endo_status_date; ?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="salutation">Name:</label>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize" name="salutation " id="salutation" placeholder="Salutation" value="<?php echo $salutation;?>">
      </div>
      <div class="col-md-2">
            <input type="text" class="form-control text-capitalize full_name" name="endo_first_name" id="endo_first_name"  placeholder="First" value="<?php echo $endo_first_name;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize full_name" name="endo_middle_name" id="endo_middle_name" placeholder="Middle" value="<?php echo $endo_middle_name;?>">
      </div>
      <div class="col-md-2">
            <input type="text" class="form-control text-capitalize full_name" name="endo_last_name" id="endo_last_name" placeholder="Last" value="<?php echo $endo_last_name;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize full_name" name="endo_name_suffix" ID="endo_name_suffix" placeholder="suffix" value="<?php echo $endo_name_suffix;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control text-uppercase full_name" name="endo_degree" ID="endo_degree" placeholder="degree" value="<?php echo $endo_degree;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="mail_name">Mail Name:</label>
      <div class="col-md-3">
            <input type="text" class="form-control text-capitalize" name="mail_name" id="mail_name" value="<?php echo $mail_name;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_address1">Address:</label>
      <div class="col-md-6">
        <input type="text" name="endo_address1" class="form-control text-capitalize endo_address" id="endo_address1" placeholder="Address line 1" value="<?php echo $endo_address1; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="endo_address2"></label>
      <div class="col-md-6">
        <input type="text" name="endo_address2" class="form-control text-capitalize endo_address" id="endo_address2" placeholder="Address line 2" value="<?php echo $endo_address2; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="endo_address3"></label>
      <div class="col-md-6">
        <input type="text" name="endo_address3" class="form-control text-capitalize endo_address" id="endo_address3" placeholder="Address line 3" value="<?php echo $endo_address3; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="endo_city">City:</label>
      <div class="col-md-2">
        <input type="text" name="endo_city" class="form-control text-capitalize address" id="endo_city" placeholder="City" value="<?php echo $endo_city; ?>">
      </div>
      <label class="control-label col-md-1" for="endo_state">State:</label>
        <div class="col-md-2">
            <select name="endo_state" class="address form-control address" id = "endo_state">
                <option value="">Make selection </option>
                <?php
                    foreach ($state_list as $key=>$v) {
                ?>
                    <option value="<?php echo $v?>" 
                <?php
                    if(trim($endo_state) == trim($v)){
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
      <label class="control-label col-md-1" for="endo_zip">zip:</label>
      <div class="col-md-2">
        <input type="text" name="endo_zip" class="form-control address" id="endo_zip" placeholder="zip" value="<?php echo $endo_zip; ?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="endo_direct_phone"  id="endo_direct_phone" value="<?php echo $endo_direct_phone;?>">
        </div>
        <label class="control-label col-md-1">Pager:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="endo_pager" id="endo_pager" value="<?php echo $endo_pager;?>">
        </div>
        <label class="control-label col-md-1">Other phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="endo_other_phone" id="endo_other_phone" value="<?php echo $endo_other_phone;?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="endo_email">Email:</label>
        <div class="col-md-3">
            <input type="email" name="endo_email" class="form-control" id="endo_email" value="<?php echo $endo_email; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="endo_dob">Birthdate:</label>
        <div class="col-md-2">
            <input type="date" name="endo_dob" class="form-control" id="endo_dob" value="<?php echo $endo_dob; ?>">
        </div>
        <label class="control-label col-md-1"> Gender:</label> 
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="endo_gender_male" value="1" <?php echo $endo_gender_male=="1"?"checked":""; ?> >Male</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="endo_gender_male" value="0" <?php echo $endo_gender_male=="0"?"checked":""; ?> >Female</label>
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
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="./js/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist_v3.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>