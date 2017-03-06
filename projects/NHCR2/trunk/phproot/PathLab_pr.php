<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['path_lab_id'])?$path_lab_id=$_POST['path_lab_id']:$path_lab_id=-9;

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }
    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($status)?$status:$status="";
    isset($path_lab_id)?$path_lab_id:$path_lab_id=-9;
    isset($lab_code)?$lab_code:$lab_code="";
    isset($lab_name)?$lab_name:$lab_name="";
    isset($path_report_trigger)?$path_report_trigger:$path_report_trigger="";
    isset($request_procedure)?$request_procedure:$request_procedure="";

    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.set_pathlab_pr($1,$2,$3)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $path_lab_id,
                $path_report_trigger,
                $request_procedure)
                );
            if($result)
                $submit_message  = 'Record updated';
            else
                throw new exception ('Problem updating record.');
        }
    }
    catch (Exception $e) {
        echo 'ERROR: '.$e;
    }
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
    isset($status)?$status:$status="";
    isset($path_lab_id)?$path_lab_id:$path_lab_id=-9;
    isset($lab_code)?$lab_code:$lab_code="";
    isset($lab_name)?$lab_name:$lab_name="";
    isset($path_report_trigger)?$path_report_trigger:$path_report_trigger="";
    isset($request_procedure)?$request_procedure:$request_procedure="";


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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="path_lab_id" name="path_lab_id" value="<?php echo $path_lab_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Path Lab </h4>
<?php include("includes/header_pl.php"); ?>
    <div>
        <b><?php echo $lab_name; ?><br>
        ID:<?php echo $lab_code; ?><br>
        Status:<?php echo $status; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<p><p>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="path_report_trigger"> Path report trigger</label> 
        <div class="col-md-2">
            <select class="form-control" id="path_report_trigger" name="path_report_trigger">
                <option value="" 
                <?php 
                    if($path_report_trigger==''){
                        echo "selected=\"selected\""; 
                    }
                ?>> Select
                </option>
                <option value="Auto all" 
                <?php 
                    if($path_report_trigger=='Auto all'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Auto all
                </option>
                <option value="Special request" 
                <?php 
                    if($path_report_trigger=='Special request'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Special request
                </option>
                <option value="Study participant" 
                <?php 
                    if($path_report_trigger=='Study participant'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Study participant
                </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Procedure</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="request_procedure"><?php echo $request_procedure;?> </textarea>
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
<script type="text/javascript" src="./js/PathLab_pr.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>