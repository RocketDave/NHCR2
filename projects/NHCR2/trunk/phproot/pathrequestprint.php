<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}
isset($_POST['facility_name'])?$facility_name=$_POST['facility_name']:$facility_name='';
$facility_name=pg_escape_string($facility_name);

$result=pg_query($conn,"select * from facility where facility_name = '".$facility_name."'");
if ($result) {
    $row = pg_fetch_assoc( $result );
    $sort=$row['pth_req_sort_col'];
};

if ($sort == 'Exam Date') {
    $result = pg_query($conn,"select * from vPathRequestPrint where facility_name = '".$facility_name."' and to_date(print_date,'mm/dd/yyyy') = (select max(to_date(print_date,'mm/dd/yyyy')) from vPathRequestPrint where facility_name = '".$facility_name."') order by exam_date");
} else {
    $result = pg_query($conn,"select * from vPathRequestPrint where facility_name = '".$facility_name."' and to_date(print_date ,'mm/dd/yyyy')= (select max(to_date(print_date,'mm/dd/yyyy')) from vPathRequestPrint where facility_name = '".$facility_name."') order by last_name, first_name");
};


$arr_all = array();
$count = 0;

if ($result) {
    $arr_all = pg_fetch_all($result);
    $num_rows = pg_num_rows ($result);
}

$current_date = date("m-d-Y");

?>
<!DOCTYPE html>
<html>
<head>
<title>Path Requests</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
<style>
.bottom {
  border-bottom: thin solid;
  border-color: black;
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">

<div class="form-group row col-md-5 ">
        <input type="button" class="btn btn-primary no-print col-md-3" value="Print this page" onclick="window.print()">
</div>

<div class="container">

    <h3> NH Colonoscopy Pathology Request </h3>
    <h5> <?php echo $current_date?> </h5>

    <div class="form-group row">
      <label class="control-label col-md-1" for="facility_name">Facility:</label>
        <div class="col-md-6">
            <select name="facility_name" class="form-control" id = "facility_name" onchange="this.form.submit();">
                <option value="" selected>
    <?php
            $result = pg_query ("select facility_name,max(to_date(print_date,'mm/dd/yyyy')) as print_dt from vPathRequestPrint  group by facility_name order by facility_name;" ) ;

                                            if( ! $result)    {
                                           /* If the queried failed put the error message in the menu so we know the error was only in this menu.*/
                                           $error_msg = sasql_error($conn);
                                        ?>
                                           <option value="error"> Connect Failed! </option>
                                           <option value="erorrmsg"> <?php echo $error_msg ?> </option><?php
                                        }else{
                                           while($row = pg_fetch_array($result))    {
                                           ?>
                                               <option value="<?php echo $row['facility_name']; ?>"
                                               <?php
                                               if(pg_escape_string($row['facility_name'])==$facility_name){
                                                   echo "selected=\"selected\""; 
                                               }
                                               ?>
                                               > <!-- end option tag -->
                                                   <?php echo  $row['facility_name'], ' - Last Request Date - ', $row['print_dt'] ?>
                                               </option>
                                               <?php    
                                           } /* end of while loop */
                                        } /* end of else     */
                                        ?>
            </select>
        </div>
    </div>
    <table class="table table-condensed small" id="requests">
        <thead>
            <tr>
                <th> MRN </th>
                <th>
                <th>
                <th>
                <th>
                <th>
            </tr>
            <tr>
                <th> Exam Date </th>
                <th> Last </th>
                <th> First</th>
                <th> Middle</th>
                <th> DOB</th>
                <th> Batch</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($result){
                    while($count < $num_rows)    {
            ?> 
            <tr>
                <td> <?php echo $arr_all[$count]['med_rec_num']?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="bottom"> <?php echo $arr_all[$count]['exam_date']?></td>
                <td class="bottom"> <?php echo $arr_all[$count]['last_name']?></td>
                <td class="bottom"> <?php echo $arr_all[$count]['first_name']?></td>
                <td class="bottom"> <?php echo $arr_all[$count]['middle_name']?></td>
                <td class="bottom"> <?php echo $arr_all[$count]['dob']?></td>
                <td class="bottom"> <?php echo $arr_all[$count]['batch_id']?></td>
            </tr>

            <?php
                    $count=$count+1;
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
    </table>
</div>
</form>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.js"></script>
<script type="text/javascript" src="./js/pathrequestprint.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>

</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>