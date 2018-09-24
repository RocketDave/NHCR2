<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id="";
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";

if ($event_id != "") {
    $result = pg_query("select * from delete_event (".$event_id.')');
    if ($result) {
        $rows = pg_fetch_assoc( $result );
        $submit_message = $rows['lcl_message'];
    }
    else {
        $submit_message = 'There was a problem deleting the record';
    }
}

?>

<!DOCTYPE html>
<head>
<title>Event Delete</title>
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
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="person_id" name="person_id" value="<?php echo $person_id; ?>"/>

    <h4 class="text-danger"> <?php echo $submit_message; ?> </h4>

<?php

    if (in_array('nhcr2_admin', $_SESSION['user_role_array'])) {
    echo '<div class="form-group row">';
        echo '<div class="text-center">';
            echo '<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">Continue and delete all related records</button></div></div>';
    echo '<div id="myModal" class="modal fade" role="dialog">';
        echo '<div class="modal-dialog modal-sm">';
            echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                    echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                    echo '<h4 class="modal-title">Delete Record</h4>';
                 echo '</div>';
                echo '<div class="modal-body">';
                    echo '<p id="confirmMessage">Are you sure?</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                    echo '<button class="btn" id="confirmFalse">Cancel</button>';
                    echo '<button class="btn btn-primary" id="confirmTrue">OK</button>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
    }
?>
    <div class="text-center">
        <button id="to_events" type="button" class="btn btn-link">Return to Events</button>
    </div>

    <div class="text-center">
        <button id="to_person" type="button" class="btn btn-link">Return to Person</button>
    </div>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" >
    $("#to_person").on('click', function () {
            $("#myform").attr("action","person.php");
            $('#myform').submit();
    });
    $("#to_events").on('click', function () {
            $("#myform").attr("action","events.php");
            $('#myform').submit();
    });
    $("#confirmTrue").click( function () {
            $("#myform").attr("action","delete_event_related.php");
            $('#myform').submit();
    } );
</script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>