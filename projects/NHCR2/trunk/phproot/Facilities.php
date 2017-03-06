<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();
$current_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html>
<head>
<title>Facilities</title>
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
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" name="facility_id" id="facility_id">

<div class="container-fluid">
    <h3> Facilities </h3>
    <table id="facilities" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Facility </th>
                <th scope="col"> Status </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = pg_query($conn,'select * from public.facility;');
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="Facility.php" data-id=<?php echo $row['facility_id'];?>>
                <td> <?php echo $row['facility_id']?></td>
                <td> <?php echo $row['facility_name']?></td>
                <td> <?php echo $row['status']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
         <tfoot>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Facility </th>
                <th scope="col"> Status </th>
            </tr>
        </tfoot>
    </table>
    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
        <a href="Facility.php" id="add_facility" role="button" class="btn btn-primary">Add Facility</a>
    </div>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="./js/buttons.print.min.js"></script>
<script type="text/javascript" src="./js/buttons.html5.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./js/facilities.js"></script>


</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>