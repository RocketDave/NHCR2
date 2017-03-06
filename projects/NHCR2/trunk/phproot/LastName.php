<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['other_name_id'])?$other_name_id=$_POST['other_name_id']:$other_name_id=null;
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($last_name)?$last_name:$last_name="";
    isset($maiden_flag)?$maiden_flag:$maiden_flag=0;

    try {
        $result = pg_query("insert into other_name (person_id,last_name,maiden_flag) values (".$person_id.",'".$last_name."',".$maiden_flag.")"); 
        if($result)
            $submit_message  = 'Record updated';
        else
            throw new exception ('Problem updating record.');
    }
    catch (Exception $e) {
        echo $e;;
    }
}

if ($other_name_id != '') {
    $result = pg_query("select * from other_name where other_name_id = '" . $other_name_id . "'");

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    };
}

isset($action_on)?$action_on:$action_on="";
isset($action_by)?$action_by:$action_by="";
isset($last_name)?$last_name:$last_name="";
isset($maiden_flag)?$maiden_flag:$maiden_flag=0;


?>
<!DOCTYPE html>
<head>
<title>Other Last Name</title>
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
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="other_name_id" name="other_name_id" value="<?php echo $other_name_id; ?>"/>
<input type="hidden" id="person_id" name="person_id" value="<?php echo $person_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Other Last Name</h4>
    <div>
        Person ID:<?php echo $person_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<p><p>

    <div class="form-group row">
      <label class="control-label col-md-2" for="last_name">Last Name</label>
      <div class="col-md-2">
            <input type="text" class="form-control" name="last_name" placeholder="Last" value="<?php echo $last_name;?>">
      </div>
      <label class="control-label col-md-1" for="maiden_flag">Maiden Name</label>
      <div class="col-md-1 checkbox">
            <input type="checkbox" name="maiden_flag" value="1" <?php echo $maiden_flag=="1"?"checked":""; ?>>
      </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2 col-md-offset-2">
            <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Submit">
        </div>
        <div class="col-md-2">
            <button id="to_person" type="button" class="btn btn-link">Return to Subject Page</button>
        </div>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/LastName.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>