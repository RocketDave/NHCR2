<?php
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();


isset($_GET['q'])?$endo_id=$_GET['q']:$endo_id="";
isset($_GET['f'])?$facility_id=$_GET['f']:$facility_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";

if ($type_r=='del') {
    $result = pg_query($conn,"delete from endo_fac where facility_id = '" . $facility_id . "' and endo_code = '" . $endo_id . "'");
};
if ($type_r=='add') {
    pg_query($conn,"select * from insert_endo_fac ('". $facility_id . "','".$endo_id."');");
};

$result = pg_query($conn,"select * from vEndoFac where facility_id = '" . $facility_id . "'");

?>
<table id="facilities" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> Code </th>
<th scope="col"> Initials </th>
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
                <td> <button type="button" class="btn btn-info btn-sm" name="del_endo" onclick="delEndo(<?php echo $row['endoscopist_id']?>)" >Delete</button> </td>
                <td> <?php echo $row['endoscopist_id']?></td>
                <td> <?php echo $row['endo_initials']?></td>
                <td> <?php echo $row['mail_name']?></td>
                <td> <?php echo $row['endo_status']?></td>
            </tr>
<?php
            } /* end of while loop */
        } /* end of else     */
?>
</tbody>
