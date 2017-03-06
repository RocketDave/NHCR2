<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";
$errors = 0;
$error_class="text-danger text-center";
$error_message="";

isset($_POST['specimen_id'])?$specimen_id=$_POST['specimen_id']:$specimen_id=-9;
isset($_POST['path_report_id'])?$path_report_id=$_POST['path_report_id']:$path_report_id="";
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id="";

$other_spec = array();
$result = pg_query ('select description as the_other from other_specimen order by the_other;' ) ;
if (!$result) {
    echo "Problem with the database connection.\n";
    exit;
}
$num_rows = pg_num_rows ($result ) ;
$curr_row = 0 ;
while ( ( $row = pg_fetch_row ( $result ) ) ) { 
    $curr_row ++;
    $other_spec[$curr_row] = $row[0];
}

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }
    isset($action_on)?$action_on:$action_on= "";
    isset($action_by)?$action_by:$action_by= "";
    isset($specimen_id)?$specimen_id:$specimen_id= -9;
    isset($path_report_id)?$path_report_id:$path_report_id= "";
    isset($event_id)?$event_id:$event_id= "";
    isset($person_id)?$person_id:$person_id= "";
    isset($event_date)?$event_date:$event_date= "";
    isset($lab_code)?$lab_code:$lab_code= "";
    isset($case_no)?$case_no:$case_no= "";
    isset($no_q_form)?$no_q_form:$no_q_form= "";
    isset($q_form_incomplete)?$q_form_incomplete:$q_form_incomplete= "";
    isset($path_polyp_loc)?$path_polyp_loc:$path_polyp_loc= "";
    isset($polyp_num)?$polyp_num:$polyp_num= "";
    isset($discrepnote)?$discrepnote:$discrepnote= "";
    isset($container)?$container:$container= "";
    isset($other_dx_specify)?$other_dx_specify:$other_dx_specify= "";
    isset($site_location_cm)?$site_location_cm:$site_location_cm= "";
    isset($size_mm)?$size_mm:$size_mm= "";
    isset($ptype_carcinoid)?$ptype_carcinoid:$ptype_carcinoid= 0;
    isset($ptype_ganglio)?$ptype_ganglio:$ptype_ganglio= 0;
    isset($ptype_hamart)?$ptype_hamart:$ptype_hamart= 0;
    isset($ptype_hp)?$ptype_hp:$ptype_hp= 0;
    isset($ptype_inflam)?$ptype_inflam:$ptype_inflam= 0;
    isset($ptype_juvenile)?$ptype_juvenile:$ptype_juvenile= 0;
    isset($ptype_lelomyoma)?$ptype_lelomyoma:$ptype_lelomyoma= 0;
    isset($ptype_lipoma)?$ptype_lipoma:$ptype_lipoma= 0;
    isset($ptype_mp)?$ptype_mp:$ptype_mp= 0;
    isset($ptype_norm_muc)?$ptype_norm_muc:$ptype_norm_muc= 0;
    isset($ptype_not_polyp)?$ptype_not_polyp:$ptype_not_polyp= 0;
    isset($ptype_other)?$ptype_other:$ptype_other= 0;
    isset($ptype_pautzjeg)?$ptype_pautzjeg:$ptype_pautzjeg= 0;
    isset($ptype_sa)?$ptype_sa:$ptype_sa= 0;
    isset($ptype_ssp)?$ptype_ssp:$ptype_ssp= 0;
    isset($ptype_mixed)?$ptype_mixed:$ptype_mixed= 0;
    isset($ptype_ta)?$ptype_ta:$ptype_ta= 0;
    isset($ptype_tva)?$ptype_tva:$ptype_tva= 0;
    isset($ptype_va)?$ptype_va:$ptype_va= 0;
    isset($hgd)?$hgd:$hgd= 0;
    isset($ibd_ibd)?$ibd_ibd:$ibd_ibd= 0;
    isset($ibd_actcol)?$ibd_actcol:$ibd_actcol= 0;
    isset($ibd_chroncol)?$ibd_chroncol:$ibd_chroncol= 0;
    isset($ibd_coloth)?$ibd_coloth:$ibd_coloth= 0;
    isset($ibd_inactcol)?$ibd_inactcol:$ibd_inactcol= 0;
    isset($ibd_lgdysp)?$ibd_lgdysp:$ibd_lgdysp= 0;
    isset($n_inv_ca)?$n_inv_ca:$n_inv_ca= 0;
    isset($n_cancer)?$n_cancer:$n_cancer= 0;
    isset($ptype_fibroblast)?$ptype_fibroblast:$ptype_fibroblast= 0;
    isset($ptype_lymphoid)?$ptype_lymphoid:$ptype_lymphoid= 0;
    isset($record_complete)?$record_complete:$record_complete = 0;
    isset($flg_size_discrep)?$flg_size_discrep:$flg_size_discrep = 0;
    isset($aggregate_size)?$aggregate_size:$aggregate_size= 0;
    isset($unspec_no_fragments)?$unspec_no_fragments:$unspec_no_fragments= 0;

    $dxArray = array($ptype_carcinoid,$ptype_ganglio,$ptype_hamart,$ptype_hp,$ptype_inflam,$ptype_juvenile,$ptype_lelomyoma,
        $ptype_lipoma,$ptype_mp,$ptype_norm_muc,$ptype_not_polyp,$ptype_other,$ptype_pautzjeg,$ptype_sa,
        $ptype_ssp,$ptype_mixed,$ptype_ta,$ptype_tva,$ptype_va,$hgd,$ibd_ibd,$ibd_actcol,$ibd_chroncol,
        $ibd_coloth,$ibd_inactcol,$ibd_lgdysp,$n_inv_ca,$n_cancer,$ptype_fibroblast,$ptype_lymphoid);
    $dxCount = count($dxArray);
    $dxChecked = 0;
    for ($x = 0; $x < $dxCount; $x++) {
        if ($dxArray[$x]=='1') {
            $dxChecked = $dxChecked+1;
        }
    }
    if ($dxChecked == 0) {
        $errors = 1;
        $error_message="No diagnosis selected";
    }

    if ($path_polyp_loc == "") {
        $errors = 1;
        $error_message="No location selected";
    }
    if ($size_mm == "") {
        $errors = 1;
        $error_message="No size entered";
    }

    if ($errors == 0) {
        $record_complete = 1;
        try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_specimen_bx($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,
                                    $25,$26,$27,$28,$29,$30,$31,$32,$33,$34,$35,$36,$37,$38,$39,$40,$41,$42,$43)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $specimen_id,
                    $path_report_id,
                    $path_polyp_loc,
                    $polyp_num,
                    $discrepnote,
                    $container,
                    $other_dx_specify,
                    $site_location_cm,
                    $size_mm,
                    $ptype_carcinoid,
                    $ptype_ganglio,
                    $ptype_hamart,
                    $ptype_hp,
                    $ptype_inflam,
                    $ptype_juvenile,
                    $ptype_lelomyoma,
                    $ptype_lipoma,
                    $ptype_mp,
                    $ptype_norm_muc,
                    $ptype_not_polyp,
                    $ptype_other,
                    $ptype_pautzjeg,
                    $ptype_sa,
                    $ptype_ssp,
                    $ptype_mixed,
                    $ptype_ta,
                    $ptype_tva,
                    $ptype_va,
                    $hgd,
                    $ibd_ibd,
                    $ibd_actcol,
                    $ibd_chroncol,
                    $ibd_coloth,
                    $ibd_inactcol,
                    $ibd_lgdysp,
                    $n_inv_ca,
                    $n_cancer,
                    $ptype_fibroblast,
                    $ptype_lymphoid,
                    $record_complete,
                    $flg_size_discrep,
                    $aggregate_size,
                    $unspec_no_fragments)
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $specimen_id = $rows['lcl_specimen_id'];
                        $submit_message = $rows['lcl_message'];
                        $error_class="text-info text-center";
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
    else {
        $submit_message=$error_message;
    }

}

if ($errors == 0 and $specimen_id != -9) {
    $result = pg_query("select * from vSpecimen where specimen_id = ".$specimen_id);

    while($row = pg_fetch_array($result)){
        foreach ($row as $key => $value) {
            /* assign to var (strip whitespace if 2t an array)    */
            ${$key} = is_array($value) ? $value : trim($value);
        }
    }
}
    isset($action_on)?$action_on:$action_on= "";
    isset($action_by)?$action_by:$action_by= "";
    isset($specimen_id)?$specimen_id:$specimen_id= -9;
    isset($path_report_id)?$path_report_id:$path_report_id= "";
    isset($event_id)?$event_id:$event_id= "";
    isset($person_id)?$person_id:$person_id= "";
    isset($event_date)?$event_date:$event_date= "";
    isset($lab_code)?$lab_code:$lab_code= "";
    isset($case_no)?$case_no:$case_no= "";
    isset($no_q_form)?$no_q_form:$no_q_form= "";
    isset($q_form_incomplete)?$q_form_incomplete:$q_form_incomplete= "";
    isset($path_polyp_loc)?$path_polyp_loc:$path_polyp_loc= "";
    isset($polyp_num)?$polyp_num:$polyp_num= "";
    isset($discrepnote)?$discrepnote:$discrepnote= "";
    isset($container)?$container:$container= "";
    isset($other_dx_specify)?$other_dx_specify:$other_dx_specify= "";
    isset($site_location_cm)?$site_location_cm:$site_location_cm= "";
    isset($size_mm)?$size_mm:$size_mm= "";
    isset($ptype_carcinoid)?$ptype_carcinoid:$ptype_carcinoid= 0;
    isset($ptype_ganglio)?$ptype_ganglio:$ptype_ganglio= 0;
    isset($ptype_hamart)?$ptype_hamart:$ptype_hamart= 0;
    isset($ptype_hp)?$ptype_hp:$ptype_hp= 0;
    isset($ptype_inflam)?$ptype_inflam:$ptype_inflam= 0;
    isset($ptype_juvenile)?$ptype_juvenile:$ptype_juvenile= 0;
    isset($ptype_lelomyoma)?$ptype_lelomyoma:$ptype_lelomyoma= 0;
    isset($ptype_lipoma)?$ptype_lipoma:$ptype_lipoma= 0;
    isset($ptype_mp)?$ptype_mp:$ptype_mp= 0;
    isset($ptype_norm_muc)?$ptype_norm_muc:$ptype_norm_muc= 0;
    isset($ptype_not_polyp)?$ptype_not_polyp:$ptype_not_polyp= 0;
    isset($ptype_other)?$ptype_other:$ptype_other= 0;
    isset($ptype_pautzjeg)?$ptype_pautzjeg:$ptype_pautzjeg= 0;
    isset($ptype_sa)?$ptype_sa:$ptype_sa= 0;
    isset($ptype_ssp)?$ptype_ssp:$ptype_ssp= 0;
    isset($ptype_mixed)?$ptype_mixed:$ptype_mixed= 0;
    isset($ptype_ta)?$ptype_ta:$ptype_ta= 0;
    isset($ptype_tva)?$ptype_tva:$ptype_tva= 0;
    isset($ptype_va)?$ptype_va:$ptype_va= 0;
    isset($hgd)?$hgd:$hgd= 0;
    isset($ibd_ibd)?$ibd_ibd:$ibd_ibd= 0;
    isset($ibd_actcol)?$ibd_actcol:$ibd_actcol= 0;
    isset($ibd_chroncol)?$ibd_chroncol:$ibd_chroncol= 0;
    isset($ibd_coloth)?$ibd_coloth:$ibd_coloth= 0;
    isset($ibd_inactcol)?$ibd_inactcol:$ibd_inactcol= 0;
    isset($ibd_lgdysp)?$ibd_lgdysp:$ibd_lgdysp= 0;
    isset($n_inv_ca)?$n_inv_ca:$n_inv_ca= 0;
    isset($n_cancer)?$n_cancer:$n_cancer= 0;
    isset($ptype_fibroblast)?$ptype_fibroblast:$ptype_fibroblast= 0;
    isset($ptype_lymphoid)?$ptype_lymphoid:$ptype_lymphoid= 0;
    isset($record_complete)?$record_complete:$record_complete = 0;
    isset($flg_size_discrep)?$flg_size_discrep:$flg_size_discrep = 0;
    isset($aggregate_size)?$aggregate_size:$aggregate_size= 0;
    isset($unspec_no_fragments)?$unspec_no_fragments:$unspec_no_fragments= 0;

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Specimens</title>
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
<input type="hidden" id="specimen_id" name="specimen_id" value="<?php echo $specimen_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="path_report_id" name="path_report_id" value="<?php echo $path_report_id; ?>"/>
<div class="container">
    <div class="text-info">
        <h2>BIOPSY </h2>
    </div>
    <div>
        Specimen ID:<?php echo $specimen_id; ?><br>
        Path Report ID:<?php echo $path_report_id; ?><br>
        Last Update: <?php echo $action_on.' - ' .$action_by; ?><br><br>
    </div>
<?php   if(    isset($submit_message))    {    
    echo '<div class="'.$error_class.'"><h2>'.$submit_message.'</h2></div>'; 
} ?>
    <div class="form-group row">
        <label class="control-label col-md-1" for="person_id">Person ID</label>
        <div class="col-md-2">
            <input type="text" name="person_id" class="form-control" id="person_id" value="<?php echo $person_id; ?>" readonly>
        </div>
        <label class="control-label col-md-1" for="event_date" >Exam</label>
        <div class="col-md-2">
            <input type="date" name="event_date" class="form-control" id="event_date" value="<?php echo $event_date; ?>" readonly>
        </div>
        <label class="control-label col-md-1" for="case_no">Case</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="case_no" id="case_no" value="<?php echo $case_no;?>" readonly>
        </div>
        <label class="control-label col-md-1" for="lab_code">Lab</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="lab_code" id="lab_code" value="<?php echo $lab_code;?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-1" for="polyp_num">Polyp Num</label>
        <div class="col-md-1">
            <input type="text" name="polyp_num" class="form-control" id="polyp_num" value="<?php echo $polyp_num; ?>">
        </div>
        <label class="control-label col-md-1" for="container">Container</label>
        <div class="col-md-1">
            <input type="text" name="container" class="form-control" id="container" value="<?php echo $container; ?>">
        </div>
        <label class="control-label col-md-2" for="no_q_form">No Procedure Form</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="no_q_form" id="no_q_form" value="1" <?php echo $no_q_form=="1"?"checked":""; ?> disabled> 
        </div>
        <label class="control-label col-md-2" for ="q_form_incomplete">Procedure form missing polyp level data</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="q_form_incomplete" id="q_form_incomplete" value="1" <?php echo $q_form_incomplete=="1"?"checked":""; ?> disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-1" for="site_location_cm">Location cm</label>
        <div class="col-md-1">
            <input type="text" name="site_location_cm" class="form-control" id="site_location_cm" value="<?php echo $site_location_cm; ?>">
        </div>

        <label class="control-label col-md-1" for ="path_polyp_loc"> Anatomical Loc</label> 
        <div class="col-md-2">
            <select class="form-control" id="path_polyp_loc" name="path_polyp_loc">
                <option value="">Make selection </option>
                <option value="99" 
                <?php 
                    if($path_polyp_loc=='99'){
                        echo "selected=\"selected\""; 
                    }
                ?>>99
                </option>
                <option value="AC" 
                <?php 
                    if($path_polyp_loc=='AC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>AC
                </option>
                <option value="CE" 
                <?php 
                    if($path_polyp_loc=='CE'){
                        echo "selected=\"selected\""; 
                    }
                ?>>CE
                </option>
                <option value="DC" 
                <?php 
                    if($path_polyp_loc=='DC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>DC
                </option>
                <option value="HF" 
                <?php 
                    if($path_polyp_loc=='HF'){
                        echo "selected=\"selected\""; 
                    }
                ?>>HF 
                </option>
                <option value="RE" 
                <?php 
                    if($path_polyp_loc=='RE'){
                        echo "selected=\"selected\""; 
                    }
                ?>>RE
                </option>
                <option value="SF" 
                <?php 
                    if($path_polyp_loc=='SF'){
                        echo "selected=\"selected\""; 
                    }
                ?>>SF 
                </option>
                <option value="SG" 
                <?php 
                    if($path_polyp_loc=='SG'){
                        echo "selected=\"selected\""; 
                    }
                ?>>SG 
                </option>
                <option value="TC" 
                <?php 
                    if($path_polyp_loc=='TC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>TC 
                </option>
                <option value="TI" 
                <?php 
                    if($path_polyp_loc=='TI'){
                        echo "selected=\"selected\""; 
                    }
                ?>>TI
                </option>
                <option value="U" 
                <?php 
                    if($path_polyp_loc=='U'){
                        echo "selected=\"selected\""; 
                    }
                ?>>AU
                </option>
                <option value="LE" 
                <?php 
                    if($path_polyp_loc=='LE'){
                        echo "selected=\"selected\""; 
                    }
                ?>>LE
                </option>
                <option value="RI" 
                <?php 
                    if($path_polyp_loc=='RI'){
                        echo "selected=\"selected\""; 
                    }
                ?>>RI
                </option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-1">Polyp size mm</label>
        <div class="col-md-1">
            <input type="text" name="size_mm" class="form-control" id="size_mm" value="<?php echo $size_mm; ?>">
        </div>
        <label class="control-label col-md-2" for="aggregate_size">Aggregate size</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="aggregate_size" id="aggregate_size" value="1" <?php echo $aggregate_size=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for="unspec_no_fragments">Unspecified # of fragments</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="unspec_no_fragments" id="unspec_no_fragments" value="1" <?php echo $unspec_no_fragments=="1"?"checked":""; ?>>
        </div>
    </div>
    <hr>
    <h4> DIAGNOSES</h4>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_norm_muc">Normal Mucosa</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_norm_muc" id="ptype_norm_muc" value="1" <?php echo $ptype_norm_muc=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_inflam">Inflammatory Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_inflam" id="ptype_inflam" value="1" <?php echo $ptype_inflam=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_ta">Tubular Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_ta" id="ptype_ta" value="1" <?php echo $ptype_ta=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_juvenile">Juvenile</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_juvenile" id="ptype_juvenile" value="1" <?php echo $ptype_juvenile=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_tva">Tubulovillous Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_tva" id="ptype_tva" value="1" <?php echo $ptype_tva=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lelomyoma">Leiomyoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lelomyoma" id="ptype_lelomyoma" value="1" <?php echo $ptype_lelomyoma=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_va">Villous Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_va" id="ptype_va" value="1" <?php echo $ptype_va=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lymphoid">Lymphoid Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lymphoid" id="ptype_lymphoid" value="1" <?php echo $ptype_lymphoid=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="hgd">? High Grade Dysplasia/Intramucosal Carcinoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="hgd" id="hgd" value="1" <?php echo $hgd=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lipoma">Lipoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lipoma" id="ptype_lipoma" value="1" <?php echo $ptype_lipoma=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="n_cancer">Cancer</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="n_cancer" id="n_cancer" value="1" <?php echo $n_cancer=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_lgdysp">Mucosal Low Grade Dysplasia (IBD)</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_lgdysp" id="ibd_lgdysp" value="1" <?php echo $ibd_lgdysp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="n_inv_ca">Invasive Cancer</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="n_inv_ca" id="n_inv_ca" value="1" <?php echo $n_inv_ca=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_mp">Mucosal Prolapse Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_mp" id="ptype_mp" value="1" <?php echo $ptype_mp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_hp">Hyperplastic</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_hp" id="ptype_hp" value="1" <?php echo $ptype_hp=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_pautzjeg">Pautz Jeghers</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_pautzjeg" id="ptype_pautzjeg" value="1" <?php echo $ptype_pautzjeg=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_ssp">Sessile Serrated Adenoma/Polyp (SSA/P)</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_ssp" id="ptype_ssp" value="1" <?php echo $ptype_ssp=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_not_polyp">Not a Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_not_polyp" id="ptype_not_polyp" value="1" <?php echo $ptype_not_polyp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_mixed">SSA/P with dysplasia/Mixed Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_mixed" id="ptype_mixed" value="1" <?php echo $ptype_mixed=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_actcol">Colitis - Active</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_actcol" id="ibd_actcol" value="1" <?php echo $ibd_actcol=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_sa">Traditional Serrated Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_sa" id="ptype_sa" value="1" <?php echo $ptype_sa=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_chroncol">Colitis - Chronic</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_chroncol" id="ibd_chroncol" value="1" <?php echo $ibd_chroncol=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_carcinoid">Carcinoid</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_carcinoid" id="ptype_carcinoid" value="1" <?php echo $ptype_carcinoid=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_coloth">Colitis - Other</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_coloth" id="ibd_coloth" value="1" <?php echo $ibd_coloth=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_fibroblast">Fibroblastic Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_fibroblast" id="ptype_fibroblast" value="1" <?php echo $ptype_fibroblast=="1"?"checked":""; ?>>
        </div>

        <label class="control-label col-md-3" for ="ibd_inactcol">Colititis - Inactive</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_inactcol" id="ibd_inactcol" value="1" <?php echo $ibd_inactcol=="1"?"checked":""; ?>>
        </div>

    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_ganglio">Ganglionueromatous</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_ganglio" id="ptype_ganglio" value="1" <?php echo $ptype_ganglio=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_ibd">Inflammatory Bowel Disease</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_ibd" id="ibd_ibd" value="1" <?php echo $ibd_ibd=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_hamart">Hamartomatous</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_hamart" id="ptype_hamart" value="1" <?php echo $ptype_hamart=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_other">Other Diagnosis</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_other" id="ptype_other" value="1" <?php echo $ptype_other=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-1" for ="other_dx_specify">Specify</label> 
        <div class="col-md-3">
            <select name="other_dx_specify" class="form-control" id = "other_dx_specify">
                <option value="">Make selection:</option>
                <?php
                    foreach ($other_spec as $v) {
                ?>
                    <option value="<?php echo $v?>" 
                <?php
                    if($other_dx_specify == $v){
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
    </div>

    <hr>
    <div class="form-group row">
        <label class="control-label col-md-1"> NOTES</label> 
        <div class="col-md-8">
        <textarea rows="5" class="form-control" name="discrepnote" id="discrepnote"><?php echo $discrepnote;?> </textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-3"> Specimen Record Complete</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="record_complete" value="1" <?php echo $record_complete=="1"?"checked":""; ?> disabled>
        </div>
    </div>

<?php   if(    isset($submit_message))    {    
    echo '<div class="'.$error_class.'"><h2>'.$submit_message.'</h2></div>'; 
} ?>

    <div class="form-group row">
        <div class="text-center">
            <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#myModal">Delete this record</button>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Record</h4>
                 </div>
                <div class="modal-body">
                    <p id="confirmMessage">Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" id="confirmFalse">Cancel</button>
                    <button class="btn btn-primary" id="confirmTrue">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="text-center">
            <button id="to_path" type="button" class="btn btn-link">Return to Path Report</button>
        </div>
    </div>

    <div class="form-group row">
        <div class="text-center">
            <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Submit">
        </div>
    </div>


</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/specimen.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>