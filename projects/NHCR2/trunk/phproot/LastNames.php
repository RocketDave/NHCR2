<?php
require_once("includes/Project.php");
authenticate();

$conn = connect();

isset($_GET['q'])?$other_name_id=$_GET['q']:$other_name_id="";
isset($_GET['f'])?$person_id=$_GET['f']:$person_id="";
isset($_GET['t'])?$type_r=$_GET['t']:$type_r="";

if ($type_r=='del') {
    $result = pg_query("delete from other_name where other_name_id = '" . $other_name_id . "' and person_id = '" . $person_id . "'");
};

$result = pg_query("select * from other_name where person_id = '" . $person_id . "'");

?>

<table id="other_name" class="table table-striped display">
    <thead>
        <tr>
            <th> </th>
            <th> Last Name </th>
            <th> Maiden </th>
        </tr>
    </thead>
    <tbody>
<?php
        if($result){
            while($row = pg_fetch_array($result))    {
?> 
            <tr>
                <td> <button type="button" class="btn btn-info btn-sm" name="del_other" onclick="delOtherName('<?php echo $row['other_name_id']?>')" >Delete</button> </td>
                <td> <?php echo $row['last_name']?></td>
                <td>
                    <input type="checkbox" name="maiden_flag" disabled value="1" <?php echo $row['maiden_flag']=="1"?"checked":""; ?>>
                </td>
            </tr>
<?php
            } /* end of while loop */
        } /* end of else     */
?>
    </tbody>
</table>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>