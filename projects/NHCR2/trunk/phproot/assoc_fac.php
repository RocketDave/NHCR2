<?php
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

isset($_GET['q'])?$assoc_id=$_GET['q']:$assoc_id="";
isset($_GET['f'])?$facility_id=$_GET['f']:$facility_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";


if ($type_r=='add'){
	$assoc_fac_name = substr($assoc_id,strpos($assoc_id,'-') + 2);
	$assoc_id = substr($assoc_id,0,strpos($assoc_id,'-'));
}

if ($type_r=='del') {
    $result = pg_query("delete from assoc_facility where parent_facility_id = '" . $facility_id . "' and assoc_fac_id = '" . $assoc_id . "'");
};

if ($type_r=='add') {
    $result = pg_query("select * from insert_assoc_fac('".$facility_id . "','".trim($assoc_id)."','".$assoc_fac_name."');");
};

$result = pg_query("select * from assoc_facility where parent_facility_id = '" . $facility_id . "' order by assoc_facility_name");

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
                <td > <button type="button" class="btn btn-info btn-sm" id="del_fac" name="del_fac" onclick="delFac('<?php echo trim($row['assoc_fac_id'])?>')" >Delete</button> </td>
                <td> <?php echo $row['assoc_fac_id']?></td>
                <td> <?php echo $row['assoc_facility_name']?></td>
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