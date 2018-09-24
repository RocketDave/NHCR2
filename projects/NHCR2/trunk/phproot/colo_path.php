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
isset($_GET['event_id'])?$event_id=$_GET['event_id']:$event_id=null;

$result = pg_query("select * from vColo_path where event_id = ".$event_id);

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($colo_id)?$colo_id :$colo_id ="";
isset($event_id)?$event_id :$event_id ="";
isset($p_loc_a )?$p_loc_a  :$p_loc_a  ="";
isset($p_loc_b )?$p_loc_b  :$p_loc_b  ="";
isset($p_loc_c )?$p_loc_c  :$p_loc_c  ="";
isset($p_loc_d )?$p_loc_d  :$p_loc_d  ="";
isset($p_loc_e )?$p_loc_e  :$p_loc_e  ="";
isset($p_loc_f )?$p_loc_f  :$p_loc_f  ="";
isset($p_loc_g )?$p_loc_g  :$p_loc_g  ="";
isset($ps_a )?$ps_a  :$ps_a  ="";
isset($ps_b )?$ps_b  :$ps_b  ="";
isset($ps_c )?$ps_c  :$ps_c  ="";
isset($ps_d )?$ps_d  :$ps_d  ="";
isset($ps_e )?$ps_e  :$ps_e  ="";
isset($ps_f )?$ps_f  :$ps_f  ="";
isset($ps_g )?$ps_g  :$ps_g  ="";
isset($pt_a )?$pt_a  :$pt_a  ="";
isset($pt_b )?$pt_b  :$pt_b  ="";
isset($pt_c )?$pt_c  :$pt_c  ="";
isset($pt_d )?$pt_d  :$pt_d  ="";
isset($pt_e )?$pt_e  :$pt_e  ="";
isset($pt_f )?$pt_f  :$pt_f  ="";
isset($pt_g )?$pt_g  :$pt_g  ="";
isset($addl_polyp )?$addl_polyp  :$addl_polyp  ="";
isset($all_plps_rem )?$all_plps_rem  :$all_plps_rem  ="";
isset($susp_ca)?$susp_ca :$susp_ca ="";
isset($susp_ca_loc )?$susp_ca_loc  :$susp_ca_loc  ="";
isset($susp_ca_siz )?$susp_ca_siz  :$susp_ca_siz  ="";
isset($susp_ca_tx )?$susp_ca_tx  :$susp_ca_tx  ="";
isset($p_flat_a)?$p_flat_a :$p_flat_a ="";
isset($p_flat_b)?$p_flat_b :$p_flat_b ="";
isset($p_flat_c)?$p_flat_c :$p_flat_c ="";
isset($p_flat_d)?$p_flat_d :$p_flat_d ="";
isset($p_flat_e)?$p_flat_e :$p_flat_e ="";
isset($p_flat_f)?$p_flat_f :$p_flat_f ="";
isset($p_flat_g)?$p_flat_g :$p_flat_g ="";
isset($find_other)?$find_other :$find_other ="";
isset($find_oth_bmc)?$find_oth_bmc :$find_oth_bmc ="";
isset($find_oth_ibd)?$find_oth_ibd :$find_oth_ibd ="";
isset($find_oth_biop)?$find_oth_biop :$find_oth_biop ="";
isset($find_oth_other)?$find_oth_other :$find_oth_other ="";

?>
<!DOCTYPE html>
<head>
<title>Colonoscopy</title>
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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="colo_id" name="colo_id" value="<?php echo $colo_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<div class="container">
    <div>
        <b>Event ID:</b><?php echo $event_id; ?><br>
    </div>
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th></th>
				<th>Loc</th>
				<th>Flat</th>
				<th>Size</th>
				<th>Tx</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>A</td>
				<td><input type="text" name="p_loc_a" value="<?php echo $p_loc_a; ?>"></td>
				<td><input type="checkbox" name="p_flat_a" value="1" <?php echo $p_flat_a=="1"?"checked":""; ?>></td>
				<td><input type="text" name="ps_a" value="<?php echo $ps_a; ?>"></td>
				<td><input type="text" name="pt_a" value="<?php echo $pt_a; ?>"></td>
			</tr>
			<tr>
                <td>B</td>
                <td><input type="text" name="p_loc_b" value="<?php echo $p_loc_b; ?>"></td>
                <td><input type="checkbox" name="p_flat_b" value="1" <?php echo $p_flat_b=="1"?"checked":""; ?>></td>
                <td><input type="text" name="ps_b" value = "<?php echo $ps_b; ?>"></td>
				<td><input type="text" name="pt_b" value="<?php echo $pt_b; ?>"></td>
			</tr>
			<tr>
				<td>C</td>
				<td><input type="text" name="p_loc_c" value = "<?php echo $p_loc_c; ?>"></td>
				<td><input type="checkbox" name="p_flat_c" value="1" <?php echo $p_flat_c=="1"?"checked":""; ?>></td>
				<td><input type="text" name="ps_c" value="<?php echo $ps_c; ?>"></td>
				<td><input type="text" name="pt_c" value="<?php echo $pt_c; ?>"></td>
			</tr>
			<tr>
				<td>D</td>
                <td><input type="text" name="p_loc_d" value = "<?php echo $p_loc_d; ?>"></td>
                <td><input type="checkbox" name="p_flat_d" value="1" <?php echo $p_flat_d=="1"?"checked":""; ?>></td>
                <td><input type="text" name="ps_d" value="<?php echo $ps_d; ?>"></td>
                <td><input type="text" name="pt_d" value="<?php echo $pt_d; ?>"></td>
			</tr>
			<tr>
                <td>E</td>
                <td><input type="text" name="p_loc_e" value = "<?php echo $p_loc_e; ?>"></td>
                <td><input type="checkbox" name="p_flat_e" value="1" <?php echo $p_flat_e=="1"?"checked":""; ?>></td>
                <td><input type="text" name="ps_e" value="<?php echo $ps_e; ?>"></td>
                <td><input type="text" name="pt_e" value="<?php echo $pt_e; ?>"></td>
			</tr>
			<tr>
                <td>F</td>
                <td><input type="text" name="p_loc_f" value = "<?php echo $p_loc_f; ?>"></td>
                <td><input type="checkbox" name="p_flat_f" value="1" <?php echo $p_flat_f=="1"?"checked":""; ?>></td>
                <td><input type="text" name="ps_f" value="<?php echo $ps_f; ?>"></td>
                <td><input type="text" name="pt_f" value="<?php echo $pt_f; ?>"></td>
			</tr>
			<tr>
                <td>G</td>
                <td><input type="text" name="p_loc_g" value = "<?php echo $p_loc_g; ?>"></td>
                <td><input type="checkbox" name="p_flat_g" value="1" <?php echo $p_flat_g=="1"?"checked":""; ?>></td>
                <td><input type="text" name="ps_g" value="<?php echo $ps_g; ?>"></td>
                <td><input type="text" name="pt_g" value="<?php echo $pt_g; ?>"></td>
			</tr>
		</tbody>
	</table>
	<div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="addl_polyp" value="1" <?php echo $addl_polyp=="1"?"checked":""; ?>>ADDITIONAL POLYP(S)</label> 
        </div>
	</div>
	<div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="all_plps_rem" value="1" <?php echo $all_plps_rem=="1"?"checked":""; ?>>ALL POLYPS REMOVED</label> 
        </div>
	</div>
	<div class="form-group row">
		<div class="checkbox col-md-2">
			<label><input type="checkbox" name="susp_ca" value="1" <?php echo $susp_ca=="1"?"checked":""; ?>>SUSPECTED CANCER</label> 
		</div>
	</div>

	<div>
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>Loc</th>
					<th>Size</th>
					<th>Tx</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="text" name="susp_ca_loc" value="<?php echo $susp_ca_loc; ?>"></td>
					<td><input type="text" name="susp_ca_siz" value="<?php echo $susp_ca_siz; ?>"></td>
					<td><input type="text" name="susp_ca_tx"  value="<?php echo $susp_ca_tx;  ?>"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="find_oth_bmc" value="1" <?php echo $find_oth_bmc=="1"?"checked":""; ?>>Biopsy for microscopic colitis</label> 
        </div>
	</div>
	<div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="find_oth_biop" value="1" <?php echo $find_oth_biop=="1"?"checked":""; ?>>Biopsy  (for a finding other than polyp)</label> 
        </div>
	</div>
	<div class="form-group row col-md-2">
		<div class="checkbox">
			<label><input type="checkbox" name="find_oth_ibd" value="1" <?php echo $find_oth_ibd=="1"?"checked":""; ?>>Random biopsies for IBD surveillance</label> 
		</div>
	</div>
	<div class="form-group row col-md-2">
		<div class="checkbox">
			<label><input type="checkbox" name="find_oth_other" value="1" <?php echo $find_oth_other=="1"?"checked":""; ?>>Other</label> 
		</div>
	</div>

</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>