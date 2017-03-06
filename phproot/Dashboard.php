<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

?>
<!DOCTYPE html>
<html>
<head>
<title>All Subjects</title>
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
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2" id="tables">
            <p><a href="Batches.php">Batches</a></p>
            <p><a href="Colos.php">Colonoscopies</a></p>
            <p><a href="Endoscopists.php">Endoscopists</a></p>
            <p><a href="Events.php">Events</a></p>
            <p><a href="Facilities.php">Facilities</a></p>
            <p><a href="FormLogs.php">Form Log</a></p>
            <p><a href="Pathologists.php">Pathologists</a></p>
            <p><a href="PathLabs.php">Pathology Labs</a></p>
            <p><a href="Persons.php">Persons</a></p>
            <p><a href="Specimens.php">Specimens</a></p>
        </div>
        <div class="col-sm-8"> 
            <img src="./images/NHCR-logo-NH.jpg" class="center-block"  width="300px" >
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
<br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/dashboard.js"></script>
</body>
</html>
