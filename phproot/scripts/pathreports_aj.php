<?php
require_once("../includes/Project.php");
authenticate();

/* Check to see if person accessing this page is logged in.    */
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'vpathreport_p';
 
// Table's primary key
$primaryKey = 'path_report_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db' => 'path_report_id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),
    array( 'db' => 'path_report_id', 'dt' => 0 ),
    array( 'db' => 'inserted_on', 'dt' => 1 ),
    array( 'db' => 'person_id', 'dt' => 2 ),
    array( 'db' => 'event_id', 'dt' => 3 ),
    array( 'db' => 'case_no', 'dt' => 4 ),
    array(
            'db'        => 'pathology_date',
            'dt'        => 5,
            'formatter' => function( $d, $row ) {
                if (strtotime($d) != '') {
                    return date( 'm/d/Y', strtotime($d));
                } else {
                    return '';
                }
            }
        ),
    array( 'db' => 'path_report_complete', 'dt' => 6 )
);
 

// SQL server connection information
$sql_details = array(
    'user' => $_SESSION['user_id'],
    'pass' => $_SESSION['password'],
    'db'   => $_SESSION['db_name'],
    'host' => $_SESSION['db_host']
);
 
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require_once( 'ssp_pg.class.php' );


echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
?>