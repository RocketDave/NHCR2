<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

isset($_POST['path_report_id'])?$path_report_id=$_POST['path_report_id']:$path_report_id="";
$submit_message="";

if ($path_report_id != "") {
    $result = pg_query("select * from delete_path_specimens (".$path_report_id.')');
    if ($result) {
        $rows = pg_fetch_assoc( $result );
        $submit_message = $rows['lcl_message'];
    }
    else {
        $submit_message = 'There was a problem deleting the record';
    }
}

?>

<!DOCTYPE html>
<head>
<title>Path Report Delete</title>
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
<input type="hidden" id="path_report_id" name="path_report_id" value="<?php echo $path_report_id; ?>"/>
<input type="hidden" name="report_name" id="report_name" value="Path Report Duplicates">
    <h4> <?php echo $submit_message; ?> </h4>
    <h4> <?php echo $path_report_id; ?> </h4>

	<div class="text-center">
		<button id="to_pathreports" type="button" class="btn btn-link">Return to Error Reports</button>
	</div>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script>
    $("#to_pathreports").on('click', function () {
            $("#myform").attr("action","error_reports.php");
            $('#myform').submit();
    });
</script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>