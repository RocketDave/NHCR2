<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();
$conn = connect();
$current_date = date("Y-m-d");

$endo_id = $_GET['q'];
$facility_id = $_GET['f'];

$result = $session->db_query("delete from endo_fac where facility_id = '" . $facility_id . "' and endo_code = '" . $endo_id . "'");
$result = $session->db_query("select * from vEndoFac where facility_id = '" . $facility_id . "'");
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