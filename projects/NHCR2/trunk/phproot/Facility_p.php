<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
isset($_POST['pathfac_id'])?$pathfac_id=$_POST['pathfac_id']:$pathfac_id="";

$pathfac_array = array();
$result = pg_query ('select lab_code as pathfac_id, lab_name from path_lab order by lab_name;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $pathfac_array[$curr_row][$curr_col] = $row[$curr_col];
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
    isset($pth_reports_contact_name)?$pth_reports_contact_name:$pth_reports_contact_name="";
    isset($pth_reports_contact_phone)?$pth_reports_contact_phone:$pth_reports_contact_phone="";
    isset($pth_reports_contact_email)?$pth_reports_contact_email:$pth_reports_contact_email="";
    isset($pth_req_required)?$pth_req_required:$pth_req_required=0;
    isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd=0;
    isset($pth_req_instructions)?$pth_req_instructions:$pth_req_instructions="";

    try {
        $result = pg_query($conn,"update facility set 
                    pth_reports_contact_name = '".$pth_reports_contact_name."',
                    pth_reports_contact_phone = '".$pth_reports_contact_phone."',
                    pth_reports_contact_email = '".$pth_reports_contact_email."',
                    pth_consent_form_reqd = ".$pth_consent_form_reqd.",
                    pth_req_required = ".$pth_req_required.",
                    pth_req_instructions = '".$pth_req_instructions."' 
                    where facility_id = '".$facility_id."';");
        if($result)
            $submit_message  = 'Record updated';
        else
            throw new exception ('Problem updating record.');
    }
    catch (Exception $e) {
        echo $e;;
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
isset($pth_reports_contact_name)?$pth_reports_contact_name:$pth_reports_contact_name="";
isset($pth_reports_contact_phone)?$pth_reports_contact_phone:$pth_reports_contact_phone="";
isset($pth_reports_contact_email)?$pth_reports_contact_email:$pth_reports_contact_email="";
isset($pth_req_required)?$pth_req_required:$pth_req_required=0;
isset($pth_consent_form_reqd)?$pth_consent_form_reqd:$pth_consent_form_reqd=0;
isset($pth_req_instructions)?$pth_req_instructions:$pth_req_instructions="";
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
<script type="text/javascript" >
    function delPathFac(pathfac_id) {
        if ($("#facility_id").val() == '') {
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("thePathFac").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","path_fac.php?q="+pathfac_id+"&f="+$("#facility_id").val()+"&t=del",true);
            xmlhttp.send();
        }
    }
</script>
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
    <h4> Path Requests </h4>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="pth_req_required">Path Request Required</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="pth_req_required" id="pth_req_required" value="1" <?php echo $pth_req_required=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="pth_consent_form_reqd">Consent Form Required</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="pth_consent_form_reqd" id="pth_consent_form_reqd" value="1" <?php echo $pth_consent_form_reqd=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="pth_req_instructions"> Path Request Instructions:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="pth_req_instructions"  id="pth_req_instructions"><?php echo $pth_req_instructions;?> </textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="pth_reports_contact_name">Contact:</label>
        <div class="col-md-2">
            <input type="text" name="pth_reports_contact_name" class="form-control" id="pth_reports_contact_name" value="<?php echo $pth_reports_contact_name; ?>">
        </div>
        <label class="control-label col-md-1" for="pth_reports_contact_phone">Phone:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" id="pth_reports_contact_phone" name="pth_reports_contact_phone" placeholder="888-888-8888" title="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $pth_reports_contact_phone;?>">
        </div>
        <label class="control-label col-md-1" for="pth_reports_contact_email">Email:</label>
        <div class="col-md-2">
            <input type="email" name="pth_reports_contact_email" class="form-control" id="pth_reports_contact_email" value="<?php echo $pth_reports_contact_email; ?>">
        </div>
    </div>
    <h4> Labs </h4>
    <div id="thePathFac"></div>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add Path Lab</button>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Path Labs</h4>
                 </div>
                <div class="modal-body">
                    <select name="pathfac_id" class="form-control" id = "pathfac_id">
                        <option value="">Make selection </option>
                            <?php
                                foreach ($pathfac_array as $v) {
                            ?>
                                <option value="<?php echo $v[0]?>" 
                            <?php
                                if(trim($pathfac_id) == $v[0]){
                                    echo "selected=\"selected\""; 
                                }
                            ?>
                           >
                            <?php echo $v[0] ,' - ',$v[1]?>
                            </option>
                            <?php
                                }
                            ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="add_pathfac" id="add_pathfac">Add</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
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
<script type="text/javascript" src="./js/facility_p.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>