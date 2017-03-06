<?php
/* Check to see if person accessing this page is logged in.    */
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
<title>Batches</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" name="batch_id" id="batch_id">

<div class="container-fluid">
    <h3> Batches </h3>
    <table id="batches" class="table table-striped display">
        <thead>
            <tr>
                <th scope="col"> Batch ID </th>
                <th scope="col"> Facility ID </th>
                <th scope="col"> Facility Name </th>
                <th scope="col"> Arrval Date </th>
            </tr>
        </thead>
         <tfoot>
            <tr>
                <th scope="col"> Batch ID </th>
                <th scope="col"> Facility ID </th>
                <th scope="col"> Facility Name </th>
                <th scope="col"> Arrval Date </th>
            </tr>
        </tfoot>
        <tbody>
            <?php
                $result = pg_query($conn,'select * from public.vbatches;');
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="Batch.php" data-id=<?php echo $row['batch_id'];?>>
                <td> <?php echo $row['batch_id']?></td>
                <td> <?php echo $row['facility_id']?></td>
                <td> <?php echo $row['facility_name']?></td>
                <td> <?php echo $row['arrival_date']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
    </table>
    <a href="Batch.php">
        <button id="new_batch" type="button" class="btn btn-primary">Login New Batch</button>
    </a>
</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/dataTables.js"></script>
<script type="text/javascript" src="./js/batches.js"></script>


</body>
</html>
