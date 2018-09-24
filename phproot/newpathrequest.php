<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

$result = pg_query($conn, "select public.create_path_requests()");

if($result) {
        $rows = pg_fetch_assoc( $result );
        $submit_message = $rows['create_path_requests'];
        echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
}
if (isset($conn)) {
    pg_close($conn);
} 
?>