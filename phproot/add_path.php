<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
	$_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
	header('Location: Login.php');
}

$endo_id = $_GET['q'];
$facility_id = $_GET['f'];
$lab_code = $_GET['t'];

$result = $session->db_query("insert into pathlab_facility (facility_id, lab_code) values ('". $facility_id . "','".$lab_code.")");
$result = $session->db_query("select * from vPathFac where facility_id = '" . $facility_id . "'");
?>
<table id="facilities" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> Code </th>
<th scope="col"> Name </th>
<th scope="col"> Status </th>
</tr>
</thead>
<tbody>
<?php
        if($result){
            while($row = pg_fetch_array($result))    {
?> 
            <tr>
                <td value=<?php echo $row['pathfac_id']?>> <button type="button" class="btn btn-info btn-sm" name="delete_pathfac" id="delete_pathfac" >Delete</button> </td>
                <td> <?php echo $row['pathfac_id']?></td>
                <td> <?php echo $row['lab_name']?></td>
                <td> <?php echo $row['status']?></td>
            </tr>
<?php
            } /* end of while loop */
        } /* end of else     */
?>
</tbody>