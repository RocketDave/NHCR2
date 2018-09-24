<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}


$current_date = date("Y-m-d");
$current_date2 = getdate();
$current_year = $current_date2['year'];

$cuttoff = date("m/d/Y",strtotime("-2 days"));
$daylen=60*60*24;

$submit_message = "";
$errors =  0;
$error_message = "";
$warning_message  = "";

isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";
isset($_SESSION['batch_id'])?$batch_id=$_SESSION['batch_id']:$batch_id="";
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id=null;
isset($_POST['dob_srch'])?$dob=$_POST['dob_srch']:$dob="";
isset($_POST['ssn_srch'])?$ssn=$_POST['ssn_srch']:$ssn="";
isset($_POST['last_srch'])?$last_name=$_POST['last_srch']:$last_name="";
isset($_POST['first_srch'])?$first_name=$_POST['first_srch']:$first_name="";

if (isset($_POST['referrer'])) {
    $referrer=$_POST['referrer'];
} else {
    $referrer=$_SERVER['HTTP_REFERER']; 
}


if ($person_id == -9) {
    try{
        $stmt = pg_prepare($conn,"the_query","select * from public.get_new_person($1,$2,$3,$4)");
        if ($stmt) {
            $result = pg_execute($conn,"the_query", array(
                $dob,
                $ssn,
                $last_name,
                $first_name)
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
    isset($inserted_on)?$inserted_on:$inserted_on="";
    isset($inserted_by)?$inserted_by:$inserted_by="";
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
    isset($source_gender_calcd)?$source_gender_calcd:$source_gender_calcd="PatientSurvey";
    isset($bad_address)?$bad_address:$bad_address=0;
    isset($bad_address_date)?$bad_address_date:$bad_address_date="";
    isset($comments)?$comments:$comments="";

	$birth_check = explode('-',$dob,3);
	$the_birth_yr = $birth_check[0];

	if ($dob!="" and ($the_birth_yr > ($current_year - 18) or $the_birth_yr < 1920)) {
        $errors = 1;
        $error_message  = 'Please check birth year';
    }

    if ($gender_calcd == "") {
        $errors = 1;
        $error_message  = 'You must enter gender';
    }

    if ($gender_calcd == "F") {
        $warning_message  = 'Make sure you enter previous name if available.';
    }

    if ($source_gender_calcd == "") {
        $errors = 1;
        $error_message  = 'Please enter source for gender';
    }

    if ($first_name == "") {
        $errors = 1;
        $error_message  = 'You must enter first name.';
    }

    if ($last_name == "") {
        $errors = 1;
        $error_message  = 'You must enter last name.';
    }

    if ($dob == "") {
        $warning_message  = 'Make sure you enter DOB if available.';
        /*$errors = 1;
        $error_message  = 'You must enter date of birth.';*/
    }

    if ($errors == 0){
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
}

if ($errors == 0) {
    $result = pg_query("select * from vPerson where person_id = ".$person_id);

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($inserted_on)?$inserted_on:$inserted_on="";
    isset($inserted_by)?$inserted_by:$inserted_by="";
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
    isset($source_gender_calcd)?$source_gender_calcd:$source_gender_calcd="PatientSurvey";
    isset($bad_address)?$bad_address:$bad_address=0;
    isset($bad_address_date)?$bad_address_date:$bad_address_date="";
    isset($comments)?$comments:$comments="";

}
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
            xmlhttp.open("GET","lastnames.php?q="+other_name_id+"&f="+$("#person_id").val()+"&t=del",true);
            xmlhttp.send();
        }
    }
</script>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="person_id" name="person_id" value="<?php echo $person_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="referrer" name="referrer" value="<?php echo $referrer; ?>"/>
<input type="hidden" name="report_name" id="report_name" value="Possible Duplicate Subjects">

<div class="container-fluid">
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    echo '<div class="text-center bg-danger h3">'.$error_message.'</div>'; 
    echo '<div class="text-center bg-warning h3">'.$warning_message.'</div>'; 
    } ?>
    <h4> Person </h4>
<?php if(isset($_SESSION['batch_id']))  {
    echo '<h3 class="alert-info"> Working on Batch #'.$_SESSION['batch_id'].'</h3>';
    } 
?>
    <div>
        <b>ID:<?php echo $person_id; ?><br>
        Last Update: <?php echo $action_on;?><br>
        By: <?php echo $action_by; ?><br><br></b>
    </div>
<div>
	<div class="col-md-9">
		<div class="form-group row">
			<label class="control-label col-md-2" for="ssn">SSN:</label>
			<div class="col-md-2">
				<input type="text" name="ssn" class="form-control" id="ssn" title="Enter numbers only." pattern="[0-9]{4,}" value="<?php echo $ssn; ?>" maxlength="9" autofocus>
			</div>
			<label class="control-label col-md-1" for="dob">Birthdate:</label>
			<div class="col-md-3">
				<input type="date" name="dob" class="form-control required" id="dob" value="<?php echo $dob; ?>" max="<?php echo $current_date; ?>">
			</div>
			<div class="col-md-5"></div>
		</div>
		<div class="form-group row">
			<label class="control-label col-md-2">Name:</label>
			<div class="col-md-3">
				<input type="text" class="form-control text-capitalize required" name="last_name" placeholder="Last" value="<?php echo $last_name;?>">
			</div>
			<div class="col-md-3">
				<input type="text" class="form-control text-capitalize required" name="first_name" placeholder="First" value="<?php echo $first_name;?>">
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control text-capitalize" name="middle_name" placeholder="Middle" value="<?php echo $middle_name;?>">
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control text-capitalize" name="suffix" placeholder="Suffix" value="<?php echo $suffix;?>">
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

			<label class="control-label col-md-2" for="source_gender_calcd"> Source:</label> 
			<div class="col-md-3">
				<select class="form-control required" id="source_gender_calcd" name="source_gender_calcd">
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
		<label class="control-label col-md-2" for="address1">Address:</label>
			<div class="col-md-6">
			<input type="text" name="address1" class="form-control address text-capitalize" id="address1" placeholder="Address line 1" value="<?php echo $address1; ?>">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="address2"></label>
			<div class="col-md-6">
				<input type="text" name="address2" class="form-control address text-capitalize" id="address2" placeholder="Address line 2" value="<?php echo $address2; ?>">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="city">City:</label>
		<div class="col-md-2">
			<input type="text" name="city" class="form-control address text-capitalize" id="city" placeholder="City" value="<?php echo $city; ?>">
		</div>
		<label class="control-label col-md-1" for="state">State:</label>
        <div class="col-md-2">
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
			<div class="col-md-2">
				<input type="text" name="zip" class="form-control address" id="zip" placeholder="Zip" value="<?php echo $zip; ?>">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-2 col-md-offset-2 checkbox">
				<labeL><input type="checkbox" name="bad_address" id="bad_address" value="1" <?php echo $bad_address=="1"?"checked":""; ?> >Bad Address</label>
			</div>
			<div class="col-md-3">
				<input type="date" name="bad_address_date" id="bad_address_date" class="form-control" value="<?php echo $bad_address_date; ?>">
			</div>
			<div class="col-md-1 checkbox">
				<label id="refused_label"><input type="checkbox" name="refused" id="refused" value="1" <?php echo $refused=="1"?"checked":""; ?> >Refused</label>
			</div>
			<div class="col-md-3">
				<input type="date" name="refused_date" id="refused_date" class="form-control" value="<?php echo $refused_date; ?>">
			</div>
		</div>

		<div class="form-group row">
			<label class="control-label col-md-1 col-md-offset-1"> Comments:</label> 
			<div class="col-md-9">
				<textarea rows="2" class="form-control" name="comments"><?php echo $comments;?> </textarea>
			</div>
		</div>
  </div>
	<div class="col-md-3">
		<div class="form-group row">
			<div class="text-center">
				<button id="add_lastname" type="button" class="btn btn-primary">Add Former Last Name</button>
			</div>
		</div>
		<div id="theLastName"></div>
	</div>
</div>
    <table id="events" class="table table-striped display small">
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
                $result = pg_query("select e.event_id,patient_barcode,endo_barcode,event_date,e.facility_id,f.facility_name 
                    from vEvents_p e left outer join facility f on e.facility_id = f.facility_id where person_id = '" . $person_id . "';");
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link="event.php" data-id=<?php echo $row['event_id'];?>>
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

<?php if (isset($_SESSION['batch_id']) and $last_name!= "" and $first_name != "" and $gender_calcd!= "" and $errors==0 and $refused==0) {
		echo '<div><button id="add_event" type="button" class="btn btn-primary" name="add_event">New Event</button></div>';
	}

    if (((strtotime($cuttoff)-strtotime($inserted_on))/$daylen < 2) or (in_array('nhcr2_admin', $_SESSION['user_role_array']))) {
	echo '<div class="form-group row">';
		echo '<div class="text-center">';
			echo '<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">Delete this record</button></div></div>';
	echo '<div id="myModal" class="modal fade" role="dialog">';
		echo '<div class="modal-dialog modal-sm">';
			echo '<div class="modal-content">';
				echo '<div class="modal-header">';
					echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
					echo '<h4 class="modal-title">Delete Record</h4>';
				 echo '</div>';
				echo '<div class="modal-body">';
					echo '<p id="confirmMessage">Are you sure?</p>';
				echo '</div>';
				echo '<div class="modal-footer">';
					echo '<button class="btn" id="confirmFalse">Cancel</button>';
					echo '<button class="btn btn-primary" id="confirmTrue">OK</button>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	}
?>

    <div class="text-center form-group row">
        <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Save">
    </div>


<?php if (strripos($referrer,'persons.php') > 0) {
    echo
    '<div class="text-center form-group row">
        <a href="persons.php">Return to Persons</a>
    </div>'; } elseif (strripos($referrer,'error_reports.php') > 0){
        echo 
        '<div class="text-center form-group row">
			<button id="to_errors" type="button" class="btn btn-link">Return to Error Reports</button>
        </div>';
		} else {
        echo 
        '<div class="text-center form-group row">
            <a href="personsrch.php">Return to Data Entry</a>
        </div>';
		}
?>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/person_v5.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
<script>
    $("#to_errors").on('click', function () {
            $("#myform").attr("action","error_reports.php");
            $('#myform').submit();
    });
</script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>