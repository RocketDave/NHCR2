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

$endo_id = "";
$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
isset($_POST['endo_id'])?$endo_id=$_POST['endo_id']:$endo_id="";

$endo_array = array();
$result = $session->db_query ('select endoscopist_id as endo_id, mail_name from Endoscopist order by endoscopist_id;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $endo_array[$curr_row] = $row[$curr_col];
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
    isset($status)?$status:$status="";
    isset($status_date)?$status_date:$status_date="";
    isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
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
isset($status_date)?$status_date:$status_date="";
isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";

?>
<!DOCTYPE HTML>
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
    <h3> Facility </h3>
    <div>
        Facility:<?php echo $facility_name; ?><br>
        ID:<b><?php echo $facility_id; ?><br>
        Status:<?php echo $status; ?><br>
        Last Update: <?php echo $action_on; ?><br>
        By: <?php echo $action_by; ?><br><br>
    </div>
    <h4> Endoscopists </h4>
    <div id="theEndo"></div>

    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Add</button>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Endoscopists</h4>
      </div>
      <div class="modal-body">
        <select name="endo_id" class="form-control" id = "endo_id">
                <option value="" selected>
                <?php
                    foreach ($endo_array as $key=>$v) {
                ?>
                    <option value="<?php echo $v?>" 
                <?php
                    if(trim($endo_id) == trim($v)){
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" name="add_endo" id="add_endo">Add</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/facility_e.js"></script>
</body>
</html>