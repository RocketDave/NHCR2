<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

try {
    $conn = connect();
    if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
        $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
        header('Location: Logout.php');
    }
}

catch (Exception $e) {
    $session->info['message'] = $e->getMessage();
}

?>
<!DOCTYPE html>
<head>

<title>Endoscopist Report</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>

<div class="container">
<form class="form-horizontal" name="myform" id="myform" method="post" action="endoscopist_rpt.php" target="_blank" autocomplete="off">
    <h3>Endoscopist Report</h2>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_code">Endo code:</label>
      <div class="col-md-3">
            <input type="text" class="form-control" name="endo_code">
      </div>
      <label class="control-label col-md-2" for="facility_id">Facility id:</label>
      <div class="col-md-3">
            <input type="text" class="form-control" name="facility_id">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="endo_start_date">Endo start date:</label>
      <div class="col-md-3">
            <input type="date" class="form-control" name="endo_start_date">
      </div>
      <label class="control-label col-md-2" for="endo_end_date">Endo end date:</label>
      <div class="col-md-3">
            <input type="date" class="form-control" name="endo_end_date">
      </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-7" for="endo_end_date">NHCR end date:</label>
      <div class="col-md-3">
            <input type="date" class="form-control" name="nhcr_end_date">
      </div>
    </div>
    <div class="text-center">
        <button class="btn btn-lg btn-primary" type="submit">Submit</button>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endo_report_search.js"></script>

</body>
</html>
