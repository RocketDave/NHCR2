<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}

isset($_GET['q'])?$pathologist_code=$_GET['q']:$pathologist_code="";
isset($_GET['f'])?$lab_code=$_GET['f']:$lab_code="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";

if ($type_r=='del') {
    $result = pg_query("delete from pathlab_pathologist where pathlab_code = '" . $lab_code . "' and pathologist_code = '" . $pathologist_code . "'");
};
if ($type_r=='add') {
    $result = pg_query("select * from insert_pathlab_pathologist('". $lab_code . "','".$pathologist_code."');");
};

$result = pg_query("select * from vPathLabPathologist where lab_code = '" . $lab_code . "'");

?>
<table id="pathologists" class="table table-striped display">
<thead>
<tr>
<th scope="col"> </th>
<th scope="col"> Code </th>
<th scope="col"> Pathologist </th>

</tr>
</thead>
<tbody>
<?php
        if($result){
            while($row = pg_fetch_array($result))    {
?> 
            <tr>
                <td> <button type="button" class="btn btn-info btn-sm" name="del_path" onclick="delPathologist('<?php echo $row['pathologist_code']?>')" >Delete</button> </td>
                <td> <?php echo $row['pathologist_code']?></td>
                <td> <?php echo $row['pathologist_name']?></td>
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