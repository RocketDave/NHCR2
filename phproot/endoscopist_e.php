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
$current_year = date("Y");

$submit_message = "";
isset($_POST['endoscopist_id'])?$endoscopist_id=$_POST['endoscopist_id']:$endoscopist_id="";


/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($mail_name)?$mail_name:$mail_name="";
    isset($endo_specialty)?$endo_specialty:$endo_specialty="";
    isset($endo_med_grad_year)?$endo_med_grad_year:$endo_med_grad_year="";
    isset($endo_fellowship)?$endo_fellowship:$endo_fellowship=null;
    isset($endo_fellow_grad_year)?$endo_fellow_grad_year:$endo_fellow_grad_year="";
    isset($endo_fellow_discipline)?$endo_fellow_discipline:$endo_fellow_discipline="";
    isset($year_first_colo)?$year_first_colo:$year_first_colo="";

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_endoscopist_e($1,$2,$3,$4,$5,$6,$7)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $endoscopist_id,
                $endo_specialty,
                $endo_med_grad_year,
                $endo_fellowship,
                $endo_fellow_grad_year,
                $endo_fellow_discipline,
                $year_first_colo)
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
isset($mail_name)?$mail_name:$mail_name="";
isset($endo_specialty)?$endo_specialty:$endo_specialty="";
isset($endo_med_grad_year)?$endo_med_grad_year:$endo_med_grad_year="";
isset($endo_fellowship)?$endo_fellowship:$endo_fellowship=null;
isset($endo_fellow_grad_year)?$endo_fellow_grad_year:$endo_fellow_grad_year="";
isset($endo_fellow_discipline)?$endo_fellow_discipline:$endo_fellow_discipline="";
isset($year_first_colo)?$year_first_colo:$year_first_colo="";

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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="endoscopist_id" name="endoscopist_id" value="<?php echo $endoscopist_id; ?>"/>
<div class="container-fluid">
<?php
    if(isset($submit_message))    {    
            echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
} ?>
    <h4> Endoscopist </h4>
<?php include("includes/header_e.php"); ?>
<p><p>
    <div>
        <b><?php echo $mail_name; ?><br>
        ID:<?php echo $endoscopist_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_specialty" >Speciality:</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="endo_specialty" id="endo_specialty" value="<?php echo $endo_specialty;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_med_grad_year">Medical School Graduation Year:</label>
      <div class="col-md-2">
            <input type="number" class="form-control" name="endo_med_grad_year" id="endo_med_grad_year" placeholder="YYYY" value="<?php echo $endo_med_grad_year;?>" min="1940" max="<?php echo $current_year;?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="endo_fellowship">Fellowship</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="endo_fellowship" id="endo_fellowship" value="1" <?php echo $endo_fellowship=="1"?"checked":""; ?>>
        </div>
      <label class="control-label col-md-1" for="endo_fellow_grad_year" >Year Completed:</label>
      <div class="col-md-1">
            <input type="number" class="form-control" name="endo_fellow_grad_year" id="endo_fellow_grad_year" placeholder="YYYY" value="<?php echo $endo_fellow_grad_year;?>" min="1940" max="<?php echo $current_year;?>">
      </div>
      <label class="control-label col-md-1" for="endo_fellow_discipline" >Discipline:</label>
      <div class="col-md-3">
            <input type="text" class="form-control" name="endo_fellow_discipline" id="endo_fellow_discipline" value="<?php echo $endo_fellow_discipline;?>">
      </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for="year_first_colo">Year of first Colonoscopy:</label>
        <div class="col-md-2">
            <input type="number" name="year_first_colo" class="form-control" id="year_first_colo" placeholder="YYYY" value="<?php echo $year_first_colo; ?>" min="1940" max="<?php echo $current_year;?>">
        </div>
    </div>
    <div class="text-center">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save">
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist_e.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>