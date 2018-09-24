<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

$current_date = date("m-d-Y");
isset($_POST['report_name'])?$report_name=$_POST['report_name']:$report_name="";
isset($_POST['report_form'])?$report_form=$_POST['report_form']:$report_form="";
$report_name=pg_escape_string($report_name);
$report_form=pg_escape_string($report_form);

$report_sql = "";
$report_form = "";
$report_form_key = "";

if ($report_name != "") {
	$result=pg_query($conn,"select * from error_report where report_name = '".$report_name."'");
	if ($result) {
		$row = pg_fetch_assoc( $result );
		$report_sql = $row['report_sql'];
		$report_form = $row['report_form'];
		$report_form_key = $row['report_form_key'];
	}
};



?>
<!DOCTYPE html>
<html>
<head>
<title>NHCR Error Reports</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<style>
.bottom {
  border-bottom: thin solid;
  border-color: black;
}
@media print
{	
	.no-print, .no-print *
	{
		display: none !important;
	}
}
</style>
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" name="report_sql" value= "<?php echo $report_sql;?>" id="report_sql">
<input type="hidden" name=<?php echo $report_form;?> id="<?php echo $report_form;?>" value= "<?php echo $report_form;?>">
<input type="hidden" name=<?php echo $report_form_key;?> class="report_key">
<div class="form-group row col-md-5 ">
		<input type="button" class="btn btn-primary no-print col-md-3" value="Print this page" onclick="window.print()">
</div>

<div class="container">
	<h3> NHCR Error Reports </h3>
	<h5> <?php echo $current_date?> </h5>

	<div class="form-group row">
	  <label class="control-label col-md-1" for="report_name">Report:</label>
		<div class="col-md-6">
			<select name="report_name" class="form-control" id = "report_name" onchange="this.form.submit();">
				<option value="">
					<?php
						$result = pg_query ($conn,"select report_name from error_report");
						if( ! $result)	{
							/* If the queried failed put the error message in the menu so we know the error was only in this menu.*/
							$error_msg = pg_error($conn);
					?>
				<option value="error"> Connect Failed! </option>
				<option value="erorrmsg"> <?php echo $error_msg ?> </option><?php
						}else {
							while($row = pg_fetch_array($result))	{
					?>
				<option value="<?php echo $row['report_name']; ?>"
					<?php
						if($row['report_name']==$report_name){
							echo "selected=\"selected\""; 
						}
					?>
				> <!-- end option tag -->
					<?php echo  $row['report_name']?>
				</option>
					<?php	
							} /* end of while loop */
						} /* end of else	 */
					?>
			</select>
		</div>
	</div>
	<table id="events" class="table table-striped display small">
		<tbody>
        <thead>
            <tr>
			<?php
				if ($report_sql!=""){
					$result = pg_query($conn,$report_sql);
					if($result){
						$cols = pg_num_fields($result);
						$cnt1 = 0;
						while ($cnt1<$cols) {
							echo '<th scope="col"> '.pg_field_name($result, $cnt1).'</th>';
							$cnt1=$cnt1+1;
						}
				echo '</tr>';
				echo '</thead>';
						while($row = pg_fetch_array($result))	{
			?> 
			<tr class="row-links" data-link=<?php echo $report_form;?> data-id=<?php echo $row[0];?>>
			<?php
				$cnt = 0;
						while ($cnt < $cols) {
			?>
					<td> <?php echo $row[$cnt]?></td>
			<?php
						$cnt=$cnt+1;
						}
			?>
			</tr>
			<?php
						} /* end of while loop */
					} /* end of else	 */
				}
			?>
		</tbody>
	</table>

</div>
</form>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/error_reports.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
		pg_close($conn);
} 
?>