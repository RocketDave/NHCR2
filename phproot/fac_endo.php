<?php
require_once("includes/Project.php");
authenticate();
/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

isset($_GET['q'])?$endoscopist_id=$_GET['q']:$endoscopist_id="";
isset($_GET['f'])?$facility_id=$_GET['f']:$facility_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";


if ($type_r=='del') {
    $result = pg_query("delete from endo_fac where facility_id = '" . $facility_id . "' and endo_code = '" . $endoscopist_id . "'");
};

if ($type_r=='add') {
    $result = pg_query("select * from insert_endo_fac ('". $facility_id . "','".$endoscopist_id."');");
};

$result = pg_query("select * from vendofac where endoscopist_id = '" . $endoscopist_id . "' order by facility_name");

?>

<table id="facilities" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> Facility ID </th>
<th scope="col"> Name </th>
</tr>
</thead>
<tbody>
<?php
        if($result){
            while($row = pg_fetch_array($result))    {
?> 
            <tr>
                <td > <button type="button" class="btn btn-info btn-sm" id="del_fac" name="del_fac" onclick="delFac('<?php echo trim($row['facility_id'])?>')" >Delete</button> </td>
                <td> <?php echo $row['facility_id']?></td>
                <td> <?php echo $row['facility_name']?></td>
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