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
isset($_POST['fac_id'])?$fac_id=$_POST['fac_id']:$fac_id="";


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
    isset($status)?$status:$status="";
    isset($status_date)?$status_date:$status_date="";
    isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";
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
isset($status)?$status:$status="";
isset($status_date)?$status_date:$status_date="";
isset($facility_pseudo_name)?$facility_pseudo_name:$facility_pseudo_name="";

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
    function delFac(fac_id) {
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
                    document.getElementById("theFac").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","assoc_fac.php?q="+fac_id+"&f="+$("#facility_id").val()+"&t=del",true);
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
    <h4> Associated Facilities </h4>
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
                    <select name="fac_id" class="form-control" id="fac_id">
                        <option value="">Make selection </option>
                            <?php
                                foreach ($fac_array as $v) {
                            ?>
                                <option value="<?php echo $v[0] ,' - ',$v[1]?>" 
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
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/facility_a.js"></script>
</body>
</html>

<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>