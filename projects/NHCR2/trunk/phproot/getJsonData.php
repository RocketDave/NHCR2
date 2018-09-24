<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");

$session->check_session($_SERVER['REQUEST_URI']);

try {
    $session->db_reconnect();
    if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
        $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
        header('Location: Logout.php');
    }
}
catch (Exception $e) {
    $session->info['message'] = $e->getMessage();
}

    $result = $session->db_query("select * from get_indication_all (1000,'CW050','2013-04-22','2014-04-20');");

    $table = array();
    $table['cols'] = array(
        array('id' => "", 'label' => 'indication', 'pattern' => "", 'type' => 'string'),
        array('id' => "", 'label' => 'total', 'pattern' => "", 'type' => 'number')
    );
    $rows = array();
    while ($nt = pg_fetch_assoc($result)){
        $temp = array();
        $temp[] = array('v' => $nt['indication'], 'f' =>NULL);
        $temp[] = array('v' => trim($nt['total'],'"'), 'f' =>NULL);
        $rows[] = array('c' => $temp);
    }
    /*echo $rows[1]['c'][1]['v'];*/
    $table['rows'] = $rows;
    $jsonTable = json_encode($table,JSON_NUMERIC_CHECK);

    $path =getcwd();
    $filename = $path."\\data\\MyData.json";

    $string = file_put_contents($filename,$jsonTable);

?>
