<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

$lab_code = $_GET["Value1"];

$pathologist_array = array();
$result = pg_query ("select lab_code, pathologist_code,pathologist_name from vpathlabpathologist where lab_code = '".$lab_code."' order by pathologist_name;" ) ;
$rows = pg_fetch_all( $result );
echo json_encode($rows);
pg_close($conn);
?>