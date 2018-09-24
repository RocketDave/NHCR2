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
isset($_POST['pathologist_id'])?$pathologist_id=$_POST['pathologist_id']:$pathologist_id=-9;

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($pathologist_id)?$pathologist_id:$pathologist_id=-9;
    isset($pathologist_code)?$pathologist_code:$pathologist_code="";
    isset($first_name)?$first_name:$first_name="";
    isset($middle_name)?$middle_name:$middle_name="";
    isset($last_name)?$last_name:$last_name="";
    isset($name_suffix)?$name_suffix:$name_suffix="";
    isset($degree)?$degree:$degree="";
    isset($salutation)?$salutation:$salutation="";
    isset($comments)?$comments:$comments="";
    $full_name = $salutation.' '.$first_name.' '.$last_name;

    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.set_pathologist($1,$2,$3,$4,$5,$6,$7,$8,$9)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $pathologist_id,
                $pathologist_code,
                $first_name,
                $middle_name,
                $last_name,
                $name_suffix,
                $degree,
                $salutation,
                $comments)
                );
            if($result) {
                $rows = pg_fetch_assoc( $result );
                $pathologist_id = $rows['lcl_pathologist_id'];
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

$result = pg_query("select * from Pathologist where pathologist_id = '" . $pathologist_id . "'");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($pathologist_id)?$pathologist_id:$pathologist_id=-9;
    isset($pathologist_code)?$pathologist_code:$pathologist_code="";
    isset($first_name)?$first_name:$first_name="";
    isset($middle_name)?$middle_name:$middle_name="";
    isset($last_name)?$last_name:$last_name="";
    isset($name_suffix)?$name_suffix:$name_suffix="";
    isset($degree)?$degree:$degree="";
    isset($salutation)?$salutation:$salutation="";
    isset($comments)?$comments:$comments="";
    $full_name = $salutation.' '.$first_name.' '.$last_name;


?>
<!DOCTYPE html>
<head>
<title>Pathologist</title>
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
<input type="hidden" name="pathologist_id" id="pathologist_id" value="<?php echo $pathologist_id; ?>">
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Pathologist</h4>
    <div>
        <b><?php echo $full_name; ?><br>
        Code:<?php echo $pathologist_code; ?><br>
        ID:<?php echo $pathologist_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<p><p>
    <div class="form-group row">
      <label class="control-label col-md-2" for ="pathologist_code"> Code:</label> 
      <div class="col-md-1">
        <input type="text" name="pathologist_code" class="form-control" id="pathologist_code" value="<?php echo $pathologist_code; ?>" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2">Name:</label>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize" name="salutation" placeholder="Salutation" value="<?php echo $salutation;?>">
      </div>
      <div class="col-md-2">
            <input type="text" class="form-control text-capitalize" name="first_name" placeholder="First" value="<?php echo $first_name;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize" name="middle_name" placeholder="Middle" value="<?php echo $middle_name;?>">
      </div>
      <div class="col-md-2">
            <input type="text" class="form-control text-capitalize" name="last_name" placeholder="Last" value="<?php echo $last_name;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control text-capitalize" name="name_suffix" placeholder="suffix" value="<?php echo $name_suffix;?>">
      </div>
      <div class="col-md-1">
            <input type="text" class="form-control" name="degree text-uppercase" placeholder="degree" value="<?php echo $degree;?>">
      </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/pathologist.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>