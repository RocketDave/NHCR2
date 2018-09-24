<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

$current_date = date("Y-m-d");

?>
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/buttons.dataTables.min.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<p><p>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" name="endoscopist_id" id="endoscopist_id">

<div class="container-fluid">
    <h3> Endoscopists </h3>
    <table id="endoscopists" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Last Name</th>
                <th scope="col"> First Name</th>
                <th scope="col"> Status </th>
            </tr>
        </thead>
         <tfoot>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Last Name</th>
                <th scope="col"> First Name</th>
                <th scope="col"> Status </th>
            </tr>
        </tfoot>
        <tbody>
            <?php
                $result = pg_query($conn,'select * from public.endoscopist where endoscopist_id < 8888;');
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="endoscopist.php" data-id=<?php echo $row['endoscopist_id'];?>>
                <td> <?php echo $row['endoscopist_id']?></td>
                <td> <?php echo $row['endo_last_name']?></td>
                <td> <?php echo $row['endo_first_name']?></td>
                <td> <?php echo $row['endo_status']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
    </table>
    <div class="form-group row">
        <button id="clear_search" type="button" class="btn btn-primary">Clear Search</button>
        <a href="endoscopist.php" id="add_endo" role="button" class="btn btn-primary">Add Endoscopist</a>
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
<script type="text/javascript" src="./js/endoscopists_v2.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>