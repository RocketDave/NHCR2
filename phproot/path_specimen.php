<?php
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

isset($_GET['q'])?$path_report_id=$_GET['q']:$path_report_id="";
isset($_GET['f'])?$specimen_id=$_GET['f']:$specimen_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";

if ($type_r=='del') {
    $result = pg_query("delete from specimen where specimen_id = '" . $specimen_id . "'");
};
if ($type_r=='add') {
    $result = pg_query("insert into specimen (path_id) values ('". $path_report_id . "')");
};

$result = pg_query("select * from vSpecimen where path_report_id = '" . $path_report_id . "' order by specimen_id");

?>
<table id="specimens" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> ID </th>
<th scope="col"> Specimen Type </th>
<th scope="col"> Polyp Num </th>
<th scope="col"> Polyp Loc </th>
<th scope="col"> Complete </th>
</tr>
</thead>
<tbody>
<?php
        if($result){
            while($row = pg_fetch_array($result))    {
?> 
            <tr>
                <td> <button type="button" class="btn btn-info btn-sm" name="del_pathspec" onclick="delPathFac(<?php echo $row['pathlab_facility_id']?>)" >Delete</button> </td>
                <td> <?php echo $row['specimen_id']?></td>
                <td> <?php echo $row['specimen_type']?></td>
                <td> <?php echo $row['polyp_num']?></td>
                <td> <?php echo $row['path_polyp_loc']?></td>
                <td> <?php echo $row['record_complete']?></td>
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
