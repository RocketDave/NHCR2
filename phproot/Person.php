<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id=-9;
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id=null;
isset($_POST['batch_id'])?$batch_id=$_POST['batch_id']:$batch_id="";

$state_list = array();
$result = pg_query ($conn,'select fips_alpha_code from public.FIPS_STATE where display_order=1 order by get_order;' ) ;

while ($row = pg_fetch_row ($result)) { 
	$state_list[] = $row[0];
}

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }
    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($person_id)?$person_id:$person_id="";
    isset($ssn)?$ssn:$ssn="";
    isset($first_name)?$first_name:$first_name="";
    isset($middle_name)?$middle_name:$middle_name="";
    isset($last_name)?$last_name:$last_name="";
    isset($suffix)?$suffix:$suffix="";
    isset($address1)?$address1:$address1="";
    isset($address2)?$address2:$address2="";
    isset($city)?$city:$city="";
    isset($state)?$state:$state="";
    isset($zip)?$zip:$zip="";
    isset($dob)?$dob:$dob="";
    isset($deceased)?$deceased:$deceased=0;
    isset($deceased_date)?$deceased_date:$deceased_date="";
    isset($refused)?$refused:$refused=0;
    isset($refused_date)?$refused_date:$refused_date="";    
    isset($gender_calcd)?$gender_calcd:$gender_calcd="";    
    isset($source_gender_calcd)?$source_gender_calcd:$source_gender_calcd="";
    isset($bad_address)?$bad_address:$bad_address=0;
    isset($bad_address_date)?$bad_address_date:$bad_address_date="";
    isset($comments)?$comments:$comments="";
    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_person($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $person_id,
                    $ssn,
                    $first_name,
                    $middle_name,
                    $last_name,
                    $suffix,
                    $address1,
                    $address2,
                    $city,
                    $state,
                    $zip,
                    $dob,
                    $deceased,
                    $deceased_date,
                    $refused,
                    $refused_date,
                    $gender_calcd,
                    $source_gender_calcd,
                    $bad_address,
                    $bad_address_date,
                    $comments 
                    )
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $person_id = $rows['lcl_person_id'];
                        $submit_message = $rows['lcl_message'];
                    }
                else
                    throw new Exception(pg_last_error($conn));
            } else    {
                    throw new Exception(pg_last_error($conn));
                }
    }    catch(Exception $e)    {
        echo 'ERROR: '.$e;
    }
}

$result = pg_query("select * from vPerson where person_id = ".$person_id);

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($person_id)?$person_id:$person_id="";
    isset($ssn)?$ssn:$ssn="";
    isset($first_name)?$first_name:$first_name="";
    isset($middle_name)?$middle_name:$middle_name="";
    isset($last_name)?$last_name:$last_name="";
    isset($suffix)?$suffix:$suffix="";
    isset($address1)?$address1:$address1="";
    isset($address2)?$address2:$address2="";
    isset($city)?$city:$city="";
    isset($state)?$state:$state="";
    isset($zip)?$zip:$zip="";
    isset($dob)?$dob:$dob="";
    isset($deceased)?$deceased:$deceased=0;
    isset($deceased_date)?$deceased_date:$deceased_date="";
    isset($refused)?$refused:$refused=0;
    isset($refused_date)?$refused_date:$refused_date="";    
    isset($gender_calcd)?$gender_calcd:$gender_calcd="";    
    isset($source_gender_calcd)?$source_gender_calcd:$source_gender_calcd="";
    isset($bad_address)?$bad_address:$bad_address=0;
    isset($bad_address_date)?$bad_address_date:$bad_address_date="";
    isset($comments)?$comments:$comments="";

?>
<!DOCTYPE html>
<head>
<title>Person</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body >
<?php include("includes/header.php"); ?>
<script type="text/javascript" >
    function delOtherName(other_name_id) {
        if ($("#other_name_id").val() == '') {
            return;
        } else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("other_name").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","LastNames.php?q="+other_name_id+"&f="+$("#person_id").val()+"&t=del",true);
            xmlhttp.send();
        }
    }
</script>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="person_id" name="person_id" value="<?php echo $person_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="batch_id" name="batch_id" value="<?php echo $batch_id; ?>"/>
<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> Person </h4>
    <div>
        <b>ID:<?php echo $person_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2" for="ssn">SSN:</label>
        <div class="col-md-2">
            <input type="text" name="ssn" class="form-control" id="ssn" placeholder="social security #" value="<?php echo $ssn; ?>">
        </div>
        <label class="control-label col-md-1" for="dob">Birthdate:</label>
        <div class="col-md-2">
            <input type="date" name="dob" class="form-control" id="dob" value="<?php echo $dob; ?>">
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <button id="add_lastname" type="button" class="btn btn-primary">Add Former Last Name</button>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Name:</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="first_name" placeholder="First" value="<?php echo $first_name;?>">
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="middle_name" placeholder="Middle" value="<?php echo $middle_name;?>">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" name="last_name" placeholder="Last" value="<?php echo $last_name;?>">
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" name="suffix" placeholder="Suffix" value="<?php echo $suffix;?>">
        </div>
        <div id="theLastName" class="col-md-4"></div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-2" for="address1">Address:</label>
      <div class="col-md-6">
        <input type="text" name="address1" class="form-control address" id="address1" placeholder="Address line 1" value="<?php echo $address1; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="address2"></label>
      <div class="col-md-6">
        <input type="text" name="address2" class="form-control address" id="address2" placeholder="Address line 2" value="<?php echo $address2; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="city">City:</label>
      <div class="col-md-2">
        <input type="text" name="city" class="form-control address" id="city" placeholder="City" value="<?php echo $city; ?>">
      </div>
      <label class="control-label col-md-1" for="state">State:</label>
        <div class="col-md-1">
        <select name="state" class="address form-control address" id = "state">
                <option value="">Make selection </option>
                <?php
                    foreach ($state_list as $key=>$v) {
                ?>
                    <option value="<?php echo $v?>" 
                <?php
                    if(trim($state) == trim($v)){
                        echo "selected=\"selected\""; 
                    }
                ?>
                    >
                <?php echo $v?>
                </option>
                <?php
                    }
                    ?>
            </select>
        </div>
      <label class="control-label col-md-1" for="zip">Zip:</label>
      <div class="col-md-1">
        <input type="text" name="zip" class="form-control address" id="zip" placeholder="Zip" value="<?php echo $zip; ?>">
      </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
        </div>
        <div class="col-md-1">
        <label class="radio">
            <input type="checkbox" name="bad_address" value="1" <?php echo $bad_address=="1"?"checked":""; ?> >Bad Address</label>
        </div>
        <label class="control-label col-md-1" for ="bad_address_date"> Date:</label> 
        <div class="col-md-2">
            <input type="date" name="bad_address_date" class="form-control" id="bad_address_date" value="<?php echo $bad_address_date; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
        </div>
        <div class="col-md-1">
        <label class="radio">
            <input type="checkbox" name="refused" value="1" <?php echo $refused=="1"?"checked":""; ?> >Refused</label>
        </div>
        <label class="control-label col-md-1" for ="refused_date"> Date:</label> 
        <div class="col-md-2">
            <input type="date" name="refused_date" class="form-control" id="refused_date" value="<?php echo $refused_date; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Gender:</label> 
        <div class="col-md-1">
        <label class="radio">
            <input type="radio" name="gender_calcd" id="gender_m" value="M" <?php echo $gender_calcd=="M"?"checked":""; ?> >Male</label>
        </div>
        <div class="col-md-1">
        <label class="radio">
            <input type="radio" name="gender_calcd" id="gender_f" value="F" <?php echo $gender_calcd=="F"?"checked":""; ?> >Female</label>
        </div>
        <div class="col-md-1">
        <label class="radio">
            <input type="radio" name="gender_calcd" id="gender_u" value="U" <?php echo $gender_calcd=="U"?"checked":""; ?> >Unknown</label>
        </div>

        <label class="control-label col-md-1" for="source_gender_calcd"> Source:</label> 
        <div class="col-md-2">
            <select class="form-control" id="source_gender_calcd" name="source_gender_calcd">
                <option value="">Make selection </option>
                <option value="PatientSurvey" 
                <?php 
                    if($source_gender_calcd=='PatientSurvey'){
                        echo "selected=\"selected\""; 
                    }
                ?>>PatientSurvey
                </option>
                <option value="ValidationMaidenName" 
                <?php 
                    if($source_gender_calcd=='ValidationMaidenName'){
                        echo "selected=\"selected\""; 
                    }
                ?>>ValidationMaidenName
                </option>
                <option value="ValidationFirstName" 
                <?php 
                    if($source_gender_calcd=='ValidationFirstName'){
                        echo "selected=\"selected\""; 
                    }
                ?>>ValidationFirstName
                </option>
                <option value="PathReport" 
                <?php 
                    if($source_gender_calcd=='PathReport'){
                        echo "selected=\"selected\""; 
                    }
                ?>>PathReport
                </option>
                <option value="Unknown" 
                <?php 
                    if($source_gender_calcd=='Unknown'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Unknown
                </option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2"> Comments:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="comments"><?php echo $comments;?> </textarea>
        </div>
    </div>

<h4> Events </h4>
    <table id="events" class="table table-striped display">
        <thead>
            <tr>
                <th scope="col"> Event ID </th>
                <th scope="col"> Patient Barcode </th>
                <th scope="col"> Endo Barcode </th>
                <th scope="col"> Date </th>
                <th scope="col"> Facility </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = pg_query("select e.event_id,patient_barcode,endo_barcode,event_date,c.facility_id,f.facility_name 
                    from event e join colo c on e.event_id = c.event_id join facility f on c.facility_id = f.facility_id where person_id = '" . $person_id . "';");
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="Event.php" data-id=<?php echo $row['event_id'];?>>
                <td> <?php echo $row['event_id']?></td>
                <td> <?php echo $row['patient_barcode']?></td>
                <td> <?php echo $row['endo_barcode']?></td>
                <td> <?php echo $row['event_date']?></td>
                <td> <?php echo $row['facility_name']?></td>
            </tr>
            <?php
                    } /* end of while loop */
                } /* end of else     */
            ?>
        </tbody>
    </table>
    <div>
        <button id="add_event" type="button" class="btn btn-primary">New Event</button>
   </div>

    <div class="text-center form-group row">
        <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Submit">
    </div>

    <div class="text-center form-group row">
        <button id="return_entry" type="button" class="btn btn-link">Return to Data Entry</button>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/person.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>