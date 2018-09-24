<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}
/* Making the database connection here becuase it is going to be used to load the dropdown menus    */

$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['endoscopist_id'])?$endoscopist_id=$_POST['endoscopist_id']:$endoscopist_id="";
isset($_POST['fac_id'])?$fac_id=$_POST['fac_id']:$fac_id="";

$fac_array = array();
$result = pg_query ('select facility_id as fac_id, facility_name from Facility order by facility_name;' ) ;
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
    isset($endoscopist_id)?$endoscopist_id:$endoscopist_id="";
    isset($participating)?$participating:$participating=0;
    isset($main_site)?$main_site:$main_site="";
    isset($report_handling)?$report_handling:$report_handling="";
    isset($enroll_survey_done)?$enroll_survey_done:$enroll_survey_done=0;
    isset($steering_committee)?$steering_committee:$steering_committee=0;

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_endoscopist_fg($1,$2,$3,$4,$5,$6)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $endoscopist_id,
                $participating,
                $main_site,
                $report_handling,
                $enroll_survey_done,
                $steering_committee)
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

$result = pg_query("select * from vEndoscopist where endoscopist_id = '" . $endoscopist_id . "'");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($endoscopist_id)?$endoscopist_id:$endoscopist_id="";
isset($mail_name)?$mail_name:$mail_name="";
isset($participating)?$participating:$participating=0;
isset($main_site)?$main_site:$main_site="";
isset($report_handling)?$report_handling:$report_handling="";
isset($enroll_survey_done)?$enroll_survey_done:$enroll_survey_done=0;
isset($steering_committee)?$steering_committee:$steering_committee=0;


?>
<!DOCTYPE html>
<html lang="en">
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
<script type="text/javascript" >
    function delFac(fac_id) {
        if ($("#endoscopist_id").val() == '') {
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
                    document.getElementById("theFac").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","fac_endo.php?f="+fac_id+"&q="+$("#endoscopist_id").val()+"&t=del",true);
            xmlhttp.send();
        }
    }
</script>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="endoscopist_id" name="endoscopist_id" value="<?php echo $endoscopist_id; ?>"/>
<div class="container-fluid">
<?php
    if(isset($submit_message))    {    
            echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
} ?>
    <h4> Endoscopist </h4>
<?php include("includes/header_e.php"); ?>
    <div>
        <b><?php echo $mail_name; ?><br>
        ID:<?php echo $endoscopist_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="participating">Participating in Registry</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="participating" id="participating" value="1" <?php echo $participating=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for="enroll_survey_done">Enrollment Survey Done</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="enroll_survey_done" id="enroll_survey_done" value="1" <?php echo $enroll_survey_done=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="steering_committee">Steering Committee Member</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="steering_committee" id="steering_committee" value="1" <?php echo $steering_committee=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for="report_handling"> Report Handling:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="report_handling" id="report_handling" ><?php echo $report_handling;?> </textarea>
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="main_site">Main Site:</label>
        <div class="col-md-3">
        <select name="main_site" class="form-control" id = "main_site">
                <option value="">Make selection </option>
                <?php
                    foreach ($fac_array as $v) {
                ?>
                    <option value="<?php echo $v[0]?>" 
                <?php
                    if($main_site == $v[0]){
                        echo "selected=\"selected\""; 
                    }
                ?>
                    >
                <?php echo $v[1]?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
    </div>

    <h4> Facilities </h4>
    <div id="theFac"></div>
    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Add</button>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Facilities</h4>
                 </div>
                <div class="modal-body">
                    <select name="fac_id" class="form-control col-md-3" id="fac_id">
                        <option value="" selected>Select
                            <?php
                                foreach ($fac_array as $v) {
                            ?>
                                <option value="<?php echo $v[0]?>" 
                            <?php
                                if(trim($fac_id) == $v[0]){
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
                    <button type="button" class="btn btn-default" name="add_fac" id="add_fac">Add</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist_fg.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>