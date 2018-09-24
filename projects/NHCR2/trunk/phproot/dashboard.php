<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
	$_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
	header('Location: Login.php');
}

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
            <p><a href="batches_f.php">Batches</a></p>
            <p><a href="colos.php">Colonoscopies</a></p>
            <p><a href="endoscopists.php">Endoscopists</a></p>
            <?php 
                if(in_array('nhcr2_admin', $_SESSION['user_role_array'])) 
                    echo  '<p><a href="events_admin.php">Events</a></p>';
				else
					echo  '<p><a href="events.php">Events</a></p>';
            ?>
            <p><a href="facilities.php">Facilities</a></p>
            <p><a href="formlogs.php">Form Log</a></p>
            <p><a href="pathrequests_p.php">Path Requests</a></p>
            <p><a href="pathreports.php">Path Reports</a></p>
            <?php 
                if(in_array('nhcr2_admin', $_SESSION['user_role_array'])) 
                    echo  '<p><a href="pathreports_all.php">All Path Reports</a></p>';
            ?>
            <p><a href="pathologists.php">Pathologists</a></p>
            <p><a href="pathlabs.php">Pathology Labs</a></p>
            <p><a href="persons.php">Persons</a></p>
            <p><a href="specimens.php">Specimens</a></p>
            <?php 
                if(in_array('nhcr2_admin', $_SESSION['user_role_array'])) 
                    echo  '<p><a href="uploads.php">Uploads</a></p>';
            ?>
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
