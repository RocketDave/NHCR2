<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

isset($_GET['q'])?$path_id=$_GET['q']:$path_id="";
isset($_GET['f'])?$facility_id=$_GET['f']:$facility_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";

if ($type_r=='del') {
    $result = pg_query("delete from pathlab_facility where facility_id = '" . $facility_id . "' and pathlab_facility_id = '" . $path_id . "'");
};
if ($type_r=='add') {
    $result = pg_query("select * from insert_path_fac ('". $facility_id . "','".$path_id."')");
};

$result = pg_query("select * from vPathFac where facility_id = '" . $facility_id . "' order by lab_name");

?>
<table id="facilities" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> ID </th>
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
                <td> <button type="button" class="btn btn-info btn-sm" name="del_pathfac" onclick="delPathFac(<?php echo $row['pathlab_facility_id']?>)" >Delete</button> </td>
                <td> <?php echo $row['lab_code']?></td>
                <td> <?php echo $row['lab_name']?></td>
                <td> <?php echo $row['status']?></td>
            </tr>
<?php
            } /* end of while loop */
        } /* end of else     */
?>
</tbody>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>
