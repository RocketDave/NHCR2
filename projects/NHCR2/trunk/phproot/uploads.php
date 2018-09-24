<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_admin', $_SESSION['user_role_array'])) {
	$_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
	header('Location: Logout.php');
}

$current_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html>
<head>
<title>Uploads</title>
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
<input type="hidden" name="upload_id" id="upload_id">

<div class="container-fluid">
    <h3> Uploads </h3>
    <table id="uploads" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> Date loaded </th>
                <th scope="col"> File Name </th>
                <th scope="col"> Records Loaded </th>
                <th scope="col"> Duplicates </th>
                <th scope="col"> Colo Records </th>
                <th scope="col"> Polyp2 Records </th>
                <th scope="col"> Survey Records </th>
                <th scope="col"> Barcode Problem</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = pg_query($conn,'select * from public.vuploads order by cast(inserted_on as date);');
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links">
                <td> <?php echo $row['inserted_on']?></td>
                <td> <?php echo $row['file_name']?></td>
                <td> <?php echo $row['records_loaded']?></td>
                <td> <?php echo $row['duplicates']?></td>
                <td> <?php echo $row['colo_records']?></td>
                <td> <?php echo $row['polyp2_records']?></td>
                <td> <?php echo $row['survey_records']?></td>
                <td> <?php echo $row['no_barcode']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
         <tfoot>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> File Name </th>
                <th scope="col"> Records Loaded </th>
                <th scope="col"> Duplicates </th>
                <th scope="col"> Colo Records </th>
                <th scope="col"> Polyp2 Records </th>
                <th scope="col"> Survey Records </th>
                <th scope="col"> Barcode Problem</th>
            </tr>
        </tfoot>
    </table>
    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
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
<script type="text/javascript" src="./js/buttons.flash.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./js/uploads.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>