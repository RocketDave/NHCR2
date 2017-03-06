`<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";

isset($_POST['path_report_id'])?$path_report_id=$_POST['path_report_id']:$path_report_id='-9';
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id='';

if ($path_report_id=='-9') {
        $result = pg_query("select * from public.create_path_report (".$event_id.")");
        if($result) {
            $rows = pg_fetch_assoc( $result );
            $path_report_id = $rows['lcl_path_report_id'];
            /*$submit_message = $rows['lcl_message'];*/
        };
}

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($path_report_complete)?$path_report_complete:$path_report_complete=null;
    isset($person_id)?$person_id:$person_id=null;
    isset($dob)?$dob:$dob=null;
    isset($case_no)?$case_no:$case_no="";
    isset($procedure_type)?$procedure_type:$procedure_type="";
    isset($consult)?$consult:$consult=null;
    isset($consult_date)?$consult_date:$consult_date=null;
    isset($endoscopist_id)?$endoscopist_id:$endoscopist_id="";
    isset($amended_path_report)?$amended_path_report:$amended_path_report=null;
    isset($pathologist_code_cprs)?$pathologist_code_cprs:$pathologist_code_cprs="";
    isset($pathology_date)?$pathology_date:$pathology_date=null;
    isset($lab_code)?$lab_code:$lab_code="";
    isset($no_Q_form)?$no_Q_form:$no_Q_form=null;
    isset($Q_form_incomplete)?$Q_form_incomplete:$Q_form_incomplete=null;
    isset($apc)?$apc:$apc=null;
    isset($sas_import_notes)?$sas_import_notes:$sas_import_notes="";
    isset($source)?$source:$source="";
    isset($study_site)?$study_site:$study_site="";
    isset($rec_type)?$rec_type:$rec_type="";
    isset($notes)?$notes:$notes="";
    isset($adenoma_detected)?$adenoma_detected:$adenoma_detected=null;
    isset($serrated_detected)?$serrated_detected:$serrated_detected=null;
    isset($gender_calcd)?$gender_calcd:$gender_calcd="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($crohns_only)?$crohns_only:$crohns_only=null;
    isset($u_colitis_only)?$u_colitis_only:$u_colitis_only=null;
    isset($date_discrepancy)?$date_discrepancy:$date_discrepancy=null;
    isset($endo_barcode)?$endo_barcode:$endo_barcode=null;

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_path_report($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $path_report_id,
                    $person_id,
                    $gender_calcd,
                    $dob,
                    $endoscopist_id,
                    $procedure_type,
                    $apc,
                    $pathologist_code_cprs,
                    $lab_code,
                    $pathology_date,
                    $case_no,
                    $amended_path_report,
                    $consult,
                    $consult_date,
                    $date_discrepancy,
                    $crohns_only,
                    $u_colitis_only,
                    $path_report_complete,
                    $notes
                    )
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $path_report_id = $rows['lcl_path_report_id'];
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


$result = pg_query("select * from vPathReport where path_report_id = ".$path_report_id);
while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

    isset($action_on)?$action_on:$action_on="";
    isset($action_by)?$action_by:$action_by="";
    isset($path_report_complete)?$path_report_complete:$path_report_complete=null;
    isset($person_id)?$person_id:$person_id=null;
    isset($dob)?$dob:$dob=null;
    isset($case_no)?$case_no:$case_no="";
    isset($procedure_type)?$procedure_type:$procedure_type="";
    isset($consult)?$consult:$consult=null;
    isset($consult_date)?$consult_date:$consult_date=null;
    isset($endoscopist_id)?$endoscopist_id:$endoscopist_id="";
    isset($amended_path_report)?$amended_path_report:$amended_path_report=null;
    isset($pathologist_code_cprs)?$pathologist_code_cprs:$pathologist_code_cprs="";
    isset($pathology_date)?$pathology_date:$pathology_date=null;
    isset($lab_code)?$lab_code:$lab_code="";
    isset($no_Q_form)?$no_Q_form:$no_Q_form=null;
    isset($Q_form_incomplete)?$Q_form_incomplete:$Q_form_incomplete=null;
    isset($apc)?$apc:$apc=null;
    isset($sas_import_notes)?$sas_import_notes:$sas_import_notes="";
    isset($source)?$source:$source="";
    isset($study_site)?$study_site:$study_site="";
    isset($rec_type)?$rec_type:$rec_type="";
    isset($notes)?$notes:$notes="";
    isset($adenoma_detected)?$adenoma_detected:$adenoma_detected=null;
    isset($serrated_detected)?$serrated_detected:$serrated_detected=null;
    isset($gender_calcd)?$gender_calcd:$gender_calcd="";
    isset($facility_id)?$facility_id:$facility_id="";
    isset($crohns_only)?$crohns_only:$crohns_only=null;
    isset($u_colitis_only)?$u_colitis_only:$u_colitis_only=null;
    isset($date_discrepancy)?$date_discrepancy:$date_discrepancy=null;
    isset($endo_barcode)?$endo_barcode:$endo_barcode=null;

?>
<!DOCTYPE html>
<head>
<title>Path Report</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
</head>
<body >
<?php include("includes/header.php"); ?>

<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="path_report_id" name="path_report_id" value="<?php echo $path_report_id; ?>"/>
<input type="hidden" id="endo_barcode" name="endo_barcode" value="<?php echo $endo_barcode; ?>"/>
<input type="hidden" id="specimen_id" name="specimen_id"/>

<div class="container">
<?php   if(    isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h4> PATH REPORT </h4>
    <div>
        <b>Path Report ID:<?php echo $path_report_id; ?><br>
        Last Update: <?php echo $action_on.' - ' .$action_by; ?></b><br><br>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Event ID</label>
        <div class="col-md-2">
            <input type="text" name="event_id" class="form-control" id="event_id" value="<?php echo $event_id; ?>" readonly>
        </div>
        <label class="control-label col-md-2">Gender (If you change this it will update the person table)</label> 
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
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Person ID</label>
        <div class="col-md-2">
            <input type="text" name="person_id" class="form-control" id="person_id" value="<?php echo $person_id; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Date of Birth</label>
        <div class="col-md-2">
            <input type="date" name="dob" class="form-control" id="dob" value="<?php echo $dob; ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2" for ="no_q_form">No Procedure Form</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="no_q_form" id="no_q_form" value="1" <?php echo $no_q_form=="1"?"checked":""; ?>> 
        </div>
        <label class="control-label col-md-4" for="q_form_incomplete">Procedure form missing polyp level data</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="q_form_incomplete" id="q_form_incomplete" value="1" <?php echo $q_form_incomplete=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2">Endoscopist</label>
        <div class="col-md-2">
            <input type="text" name="endoscopist_id" class="form-control" id="endoscopist_id" value="<?php echo $endoscopist_id; ?>">
        </div>
        <label class="control-label col-md-1">Facility</label>
        <div class="col-md-1">
            <input type="text" name="facility_id" class="form-control" id="facility_id" value="<?php echo $facility_id; ?>" readonly> 
        </div>
        <label class="control-label col-md-2" for ="procedure_type"> Procedure Type</label> 
        <div class="col-md-2">
            <select class="form-control" id="procedure_type" name="procedure_type">
                <option value="" 
                <?php 
                    if($procedure_type==''){
                        echo "selected=\"selected\""; 
                    }
                ?>>Select procedure
                </option>
                <option value="Colonoscopy" 
                <?php 
                    if($procedure_type=='Colonoscopy'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Colonoscopy
                </option>
                <option value="Resection" 
                <?php 
                    if($procedure_type=='Resection'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Resection
                </option>
            </select>
        </div>

        <label class="control-label col-md-1" for ="apc">APC</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="apc" id="apc" value="1" <?php echo $apc=="1"?"checked":""; ?>>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Pathologist</label>
        <div class="col-md-1">
            <input type="text" name="pathologist_code_cprs" class="form-control" id="pathologist_code_cprs" value="<?php echo $pathologist_code_cprs; ?>">
        </div>
        <label class="control-label col-md-1">Path Lab</label>
        <div class="col-md-1">
            <input type="text" name="lab_code" class="form-control" id="lab_code" value="<?php echo $lab_code; ?>">
        </div>
        <label class="control-label col-md-1">Date</label>
        <div class="col-md-2">
            <input type="date" name="pathology_date" class="form-control" id="pathology_date" min="2004-10-01" value="<?php echo $pathology_date; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2">Case</label>
        <div class="col-md-2">
            <input type="text" name="case_no" class="form-control" id="case_no" value="<?php echo $case_no; ?>">
        </div>
        <label class="control-label col-md-1" for ="amended_path_report">Amended</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="amended_path_report" id="amended_path_report" value="1" <?php echo $amended_path_report=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-1" for ="consult">Consult</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="consult" id="consult" value="1" <?php echo $consult=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-1">Date</label>
        <div class="col-md-2">
            <input type="date" name="consult_date" id="consult_date" class="form-control" value="<?php echo $consult_date; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="date_discrepancy">Date discrepancy</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="date_discrepancy" id="date_discrepancy" value="1"  <?php echo $date_discrepancy=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="crohns_only">Crohn's only</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="crohns_only" id="crohns_only" value="1"  <?php echo $crohns_only=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="u_colitis_only">Ulcerative Colitis only</label> 
        <div class="checkbox col-md-4">
            <input type="checkbox" name="u_colitis_only" id="u_colitis_only" value="1"  <?php echo $u_colitis_only=="1"?"checked":""; ?>>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="adenoma_detected">Adenoma detected</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="adenoma_detected" id="adenoma_detected" value="1" disabled <?php echo $adenoma_detected=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="serrated_detected">Serrated detected</label> 
        <div class="checkbox col-md-7">
            <input type="checkbox" name="serrated_detected" id="serrated_detected" value="1" disabled <?php echo $serrated_detected=="1"?"checked":""; ?>>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2"> Notes:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="notes" id="notes"><?php echo $notes;?> </textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-2"> SAS Import Notes:</label> 
        <div class="col-md-6">
        <textarea rows="5" class="form-control" name="sas_import_notes" id="sas_import_notes"><?php echo $sas_import_notes;?> </textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-2 text-danger"> Path Report Complete</label> 
        <div class="checkbox col-md-10">
            <input type="checkbox" name="path_report_complete" id="path_report_complete" value="1" <?php echo $path_report_complete=="1"?"checked":""; ?>>
        </div>
    </div>

<h4> Specimens </h4>
    <table id="specimens" class="table table-striped">
        <thead>
            <tr>
                <th scope="col"> ID </th>
                <th scope="col"> Spec Type </th>
                <th scope="col"> Polyp Num </th>
                <th scope="col"> Polyp Loc </th>
                <th scope="col"> Complete </th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                if ($path_report_id != '') {
                    $result = pg_query($conn,"select * from public.specimen where path_report_id = ".$path_report_id);
                if($result){
                    while($row = pg_fetch_array($result))    {
            ?> 
            <tr class="row-links" data-link=<?php if ($row['specimen_type']=='Polyp')
                                                    {echo '"Specimen_polyp.php"';} 
                                                  elseif ($row['specimen_type']=='Suspected Cancer')
                                                     {echo '"Specimen_ca.php"';}
                                                  elseif ($row['specimen_type']=='Biopsy')
                                                      {echo '"Specimen_bx.php"';};?>; data-id=<?php echo $row['specimen_id'];?>>
                <td> <?php echo $row['specimen_id']?></td>
                <td> <?php echo $row['specimen_type']?></td>
                <td> <?php echo $row['polyp_num']?></td>
                <td> <?php echo $row['path_polyp_loc']?></td>
                <td> <?php echo $row['record_complete']?></td>
            </tr>
            <?php
                  
                    } /* end of while loop */
                }
            }/* end of else     */
            ?>
        </tbody>
    </table>

    <div class="form-group row">
        <button id="add_specimen_polyp" type="button" class="btn btn-primary">Add Polyp</button>
        <button id="add_specimen_ca" type="button" class="btn btn-primary">Add Cancer</button>
        <button id="add_specimen_bx" type="button" class="btn btn-primary">Add Biopsy</button>
    </div>

    <div class="text-center form-group row">
        <a href="PathReports.php">Return to Path Reports</a>
    </div>
    <div class="text-center form-group row">
        <a href="PathReportSrch.php">Return to New Path Entry</a>
    </div>
    <div class="text-center form-group row">
        <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Submit">
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="./js/dataTables.colVis.js"></script>
<script type="text/javascript" src="./js/pathreport.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>