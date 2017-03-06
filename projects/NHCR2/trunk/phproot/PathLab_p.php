<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$pathologist_code = "";
$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['path_lab_id'])?$path_lab_id=$_POST['path_lab_id']:$path_lab_id=-9;
isset($_POST['lab_code'])?$lab_code=$_POST['lab_code']:$lab_code="";

$path_array = array();
$result = pg_query ($conn,'select pathologist_code, last_name,first_name from pathologist order by last_name;' ) ;
$num_cols = pg_num_fields ($result ) ;
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $curr_col = 0;
        while ( $curr_col < $num_cols ) { 
           $path_array[$curr_row][$curr_col] = $row[$curr_col];
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
    isset($lab_code)?$lab_code:$lab_code="";
    isset($lab_name)?$lab_name:$lab_name="";

}

$result = pg_query($conn,"select * from path_lab where path_lab_id = '" . $path_lab_id . "'");
while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($lab_code)?$lab_code:$lab_code="";
isset($lab_name)?$lab_name:$lab_name="";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Pathologists</title>
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
    function delPathologist(pathologist_code) {
        if ($("#lab_code").val() == '') {
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
                    document.getElementById("thePath").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","pathlab_pathologist.php?q="+pathologist_code+"&f="+$("#lab_code").val()+"&t=del",true);
            xmlhttp.send();
        }
    }
</script>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="path_lab_id" name="path_lab_id" value="<?php echo $path_lab_id; ?>"/>
<input type="hidden" id="lab_code" name="lab_code" value="<?php echo $lab_code; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Path Lab </h4>
<?php include("includes/header_pl.php"); ?>
    <div>
        <?php echo $lab_name; ?><br>
        ID:<?php echo $lab_code; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br>
    </div>
    <h4> Pathologists </h4>
    <div id="thePath"></div>
    <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Add</button>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pathologist</h4>
                 </div>
                <div class="modal-body">
                    <select name="pathologist_code" class="form-control" id = "pathologist_code">
                        <option value="">Make selection </option>
                            <?php
                                foreach ($path_array as $v) {
                            ?>
                                <option value="<?php echo $v[0]?>" 
                            <?php
                                if(trim($pathologist_code) == $v[0]){
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
                    <button type="button" class="btn btn-default" name="add_path" id="add_path">Add</button> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript" src="./js/PathLab_p.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>