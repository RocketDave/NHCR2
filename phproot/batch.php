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
$errors =  0;
$error_message = "";
$warning_message  = "";

isset($_POST['batch_id'])?$batch_id=$_POST['batch_id']:$batch_id=-9;
isset($_POST['batch_end'])?$batch_end=$_POST['batch_end']:$batch_end="";

if ($batch_end=="1") {
    unset($_SESSION['batch_id']);
}
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
    isset($batch_id)?$batch_id:$batch_id=-9;
    isset($facility_id)?$facility_id:$facility_id="";
    isset($arrival_date)?$arrival_date:$arrival_date="";
    isset($entry_completed)?$entry_completed:$entry_completed="";
    isset($entry_completed_on)?$entry_completed_on:$entry_completed_on="";
    isset($refusals_with_r)?$refusals_with_r:$refusals_with_r="";
    isset($refusals_without_r)?$refusals_without_r:$refusals_without_r="";
    isset($refusals_without_g)?$refusals_without_g:$refusals_without_g="";
    isset($unsigned_with_r)?$unsigned_with_r:$unsigned_with_r="";
    isset($unsigned_without_r)?$unsigned_without_r:$unsigned_without_r="";
    isset($orphans)?$orphans:$orphans="";
    isset($not_approached)?$not_approached:$not_approached="";
    isset($disabled)?$disabled:$disabled="";
    isset($language)?$language:$language="";
    isset($comments)?$comments:$comments="";

    if ($arrival_date == "") {
        $errors = 1;
        $error_message  = 'You must enter an arrival date.';
    }

    if ($facility_id == "") {
        $errors = 1;
        $error_message  = 'You must select a facility.';
    }

    if ($errors == 0) {
        try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_batch($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $batch_id,
                    $facility_id,
                    $arrival_date,
                    (int)$entry_completed,
                    $entry_completed_on,
                    (int)$refusals_with_r,
                    (int)$refusals_without_r,
                    (int)$refusals_without_g,
                    (int)$unsigned_with_r,
                    (int)$unsigned_without_r,
                    (int)$orphans,
                    (int)$not_approached,
                    (int)$disabled,
                    (int)$language,
                    $comments)
                );
                if($result) {
                    $rows = pg_fetch_assoc( $result );
                    $batch_id = $rows['lcl_batch_id'];
                    if ($batch_end=="1") {
                        unset($_SESSION['batch_id']);
                    } else {
                        $_SESSION['batch_id'] = $batch_id;
                    }
                    $submit_message = $rows['lcl_message'];
                }
                else 
                    throw new exception ('Problem updating record.');
            }
        }
        catch (Exception $e) {
            echo 'ERROR: '.$e;
        }
    }
}

if ($errors == 0) {
    $result = pg_query("select * from vBatches where batch_id = '" . $batch_id . "'");

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($batch_id)?$batch_id:$batch_id=-9;
    isset($facility_id)?$facility_id:$facility_id="";
    isset($arrival_date)?$arrival_date:$arrival_date="";
    isset($entry_completed)?$entry_completed:$entry_completed="";
    isset($entry_completed_on)?$entry_completed_on:$entry_completed_on="";
    isset($refusals_with_r)?$refusals_with_r:$refusals_with_r="";
    isset($refusals_without_r)?$refusals_without_r:$refusals_without_r="";
    isset($refusals_without_g)?$refusals_without_g:$refusals_without_g="";
    isset($unsigned_with_r)?$unsigned_with_r:$unsigned_with_r="";
    isset($unsigned_without_r)?$unsigned_without_r:$unsigned_without_r="";
    isset($orphans)?$orphans:$orphans="";
    isset($not_approached)?$not_approached:$not_approached="";
    isset($disabled)?$disabled:$disabled="";
    isset($language)?$language:$language="";
    isset($comments)?$comments:$comments="";
}

?>
<!DOCTYPE html>
<head>
<title>Batch</title>
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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="batch_id" name="batch_id" value="<?php echo $batch_id; ?>"/>
<input type="hidden" id="batch_end" name="batch_end" value="<?php echo $batch_end; ?>"/>
<div class="container-fluid">
    <h4> Batch</h4>
    <div>
        ID:<?php echo $batch_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<p><p>
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    echo '<div class="text-center bg-danger h3">'.$error_message.'</div>'; 
    } ?>
    <div class="form-group row">
      <label class="control-label col-md-2" for="main_site">Facility:</label>
        <div class="col-md-3">
        <select name="facility_id" class="form-control" id = "facility_id">
                <option value="" selected>
                <?php
                    foreach ($fac_array as $v) {
                ?>
                    <option value="<?php echo $v[0]?>" 
                <?php
                    if($facility_id == $v[0]){
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
      <label class="control-label col-md-1" for="arrival_date">Arrival Date:</label>
      <div class="col-md-2">
            <input type="date" class="form-control" name="arrival_date" value="<?php echo $arrival_date;?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="entry_completed">Entry Completed:</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="entry_completed" id="entry_completed" value="1" <?php echo $entry_completed=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-1" for="entry_completed_on" >Completed on:</label>
        <div class="col-md-2">
            <input type="date" class="form-control" name="entry_completed_on" id="entry_completed_on" value="<?php echo $entry_completed_on;?>">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="refusals_with_r" >G with R form (Refused):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="refusals_with_r" id="refusals_with_r" value="<?php echo $refusals_with_r;?>">
      </div>
      <label class="control-label col-md-2" for="refusals_without_r" >G without R form (Refused):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="refusals_without_r" id="refusals_without_r" value="<?php echo $refusals_without_r;?>">
      </div>
      <label class="control-label col-md-2" for="refusals_without_g" >R without G form (Refused):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="refusals_without_g" id="refusals_without_g" value="<?php echo $refusals_without_g;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="unsigned_with_r" >G with R form (Unsigned):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="unsigned_with_r" id="unsigned_with_r" value="<?php echo $unsigned_with_r;?>">
      </div>
      <label class="control-label col-md-2" for="unsigned_without_r" >G without R form (Unsigned):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="unsigned_without_r" id="unsigned_without_r" value="<?php echo $unsigned_without_r;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="orphans" >Orphans (R without G form):</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="orphans" id="orphans" value="<?php echo $orphans;?>">
      </div>
      <label class="control-label col-md-2" for="not_approached" >Not Approached:</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="not_approached" id="not_approached" value="<?php echo $not_approached;?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="disabled" >Disabled:</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="disabled" id="disabled" value="<?php echo $disabled;?>">
      </div>
      <label class="control-label col-md-2" for="language" >Language:</label>
      <div class="col-md-1">
            <input type="text" class="form-control" name="language" id="language" value="<?php echo $language;?>">
      </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
        </div>
    </div>

    <div class="text-center form-group row">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save" onclick="return confirm ('Are you Sure?');">
    </div>

    <div class="text-center form-group row">
        <a href="batchentry.php">Go to Batch Entry</a>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>