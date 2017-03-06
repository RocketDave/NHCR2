<?php
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

isset($_POST['specimen_id'])?$specimen_id=$_POST['specimen_id']:$specimen_id="";
isset($_POST['path_report_id'])?$path_report_id=$_POST['path_report_id']:$path_report_id="";
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id="";
if ($specimen_id!="") {
    $result = pg_query("delete from specimen where specimen_id = ".$specimen_id);
    if ($result) {
        $message = 'Record has been deleted';
    }
    else {
        $message = 'There was a problem deleting the record';
    }
}

?>

<!DOCTYPE html>
<head>
<title>Specimen Delete</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="specimen_id" name="specimen_id" value="<?php echo $specimen_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="path_report_id" name="path_report_id" value="<?php echo $path_report_id; ?>"/>
    <h4> <?php echo $message; ?> </h4>

    <div class="text-center">
        <button id="to_path" type="button" class="btn btn-link">Return to Path Report</button>
 
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/delete_specimen.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>