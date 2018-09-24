<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

$conn = connect();
if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
    $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
    header('Location: Login.php');
}
$current_date = date("m/d/Y");
$submit_message = "";
$errors = 0;
isset($_POST['specimen_id'])?$specimen_id=$_POST['specimen_id']:$specimen_id="";
isset($_POST['path_report_id'])?$path_report_id=$_POST['path_report_id']:$path_report_id="";
isset($_POST['person_id'])?$person_id=$_POST['person_id']:$person_id="";
isset($_POST['event_id'])?$event_id=$_POST['event_id']:$event_id="";

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }
    isset($action_on)?$action_on:$action_on= "";
    isset($action_by)?$action_by:$action_by= "";
    isset($specimen_id)?$specimen_id:$specimen_id= "";
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
    isset($fragment)?$fragment:$fragment= "";
    isset($other_dx_specify)?$other_dx_specify:$other_dx_specify= "";
    isset($site_location_cm)?$site_location_cm:$site_location_cm= "";
    isset($site_desc)?$site_desc:$site_desc= "";
    isset($size_mm)?$size_mm:$size_mm= "";
    isset($flg_no_path_spec)?$flg_no_path_spec:$flg_no_path_spec = 0;
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
    isset($flg_dx)?$flg_dx:$flg_dx= 0;
    isset($flg_no_discrep)?$flg_no_discrep:$flg_no_discrep= 0;
    isset($flg_no_q_spec)?$flg_no_q_spec:$flg_no_q_spec= 0;
    isset($flg_num_polyps)?$flg_num_polyps:$flg_num_polyps= 0;
    isset($flg_site_discrep)?$flg_site_discrep:$flg_site_discrep= 0;
    isset($flg_site_uncert)?$flg_site_uncert:$flg_site_uncert= 0;
    isset($flg_path_sites)?$flg_path_sites:$flg_path_sites= 0;
    isset($flg_review)?$flg_review:$flg_review= 0;
    isset($hgd)?$hgd:$hgd= 0;
    isset($ibd_ibd)?$ibd_ibd:$ibd_ibd= 0;
    isset($ibd_actcol)?$ibd_actcol:$ibd_actcol= 0;
    isset($ibd_chroncol)?$ibd_chroncol:$ibd_chroncol= 0;
    isset($ibd_coloth)?$ibd_coloth:$ibd_coloth= 0;
    isset($ibd_inactcol)?$ibd_inactcol:$ibd_inactcol= 0;
    isset($ibd_lgdysp)?$ibd_lgdysp:$ibd_lgdysp= 0;
    isset($n_intra_ca)?$n_intra_ca:$n_intra_ca= 0;
    isset($n_inv_ca)?$n_inv_ca:$n_inv_ca= 0;
    isset($n_cancer)?$n_cancer:$n_cancer= 0;
    isset($ptype_fibroblast)?$ptype_fibroblast:$ptype_fibroblast= 0;
    isset($ptype_lymphoid)?$ptype_lymphoid:$ptype_lymphoid= 0;
    isset($flg_assump)?$flg_assump:$flg_assump= 0;
    isset($flg_multis)?$flg_multis:$flg_multis= 0;
    isset($flg_multisites)?$flg_multisites:$flg_multisites= 0;
    isset($flg_residual)?$flg_residual:$flg_residual= 0;
    isset($flg_assump_numpolyps)?$flg_assump_numpolyps:$flg_assump_numpolyps= 0;
    isset($flg_dx_size)?$flg_dx_size:$flg_dx_size= 0;
    isset($flg_dx_site)?$flg_dx_site:$flg_dx_site= 0;
    isset($flg_dx_multis)?$flg_dx_multis:$flg_dx_multis= 0;
    isset($specimen_type)?$specimen_type:$specimen_type= "";
    isset($notes)?$notes:$notes ="";
    isset($t_class)?$t_class:$t_class= "";
    isset($n_class)?$n_class:$n_class= "";
    isset($y_prefix)?$y_prefix:$y_prefix= 0;
    isset($record_complete)?$record_complete:$record_complete = 0;
    isset($flg_size_discrep)?$flg_size_discrep:$flg_size_discrep = 0;
    isset($aggregate_size)?$aggregate_size:$aggregate_size= 0;
    isset($unspec_no_fragments)?$unspec_no_fragments:$unspec_no_fragments= 0;

    $dxArray = array($ptype_carcinoid,$ptype_ganglio,$ptype_hamart,$ptype_hp,$ptype_inflam,$ptype_juvenile,$ptype_lelomyoma,
                        $ptype_lipoma,$ptype_mp,$ptype_norm_muc,$ptype_not_polyp,$ptype_other,$ptype_pautzjeg,$ptype_sa,$ptype_ssp,
                        $ptype_mixed,$ptype_ta,$ptype_tva,$ptype_va);
    $dxCount = count($dxArray);
    $dxChecked = 0;
    for ($x = 0; $x < $dxCount; $x++) {
        if ($dxArray[$x]=='1') {
            $dxChecked = $dxChecked+1;
        }
    }
    if ($dxChecked == 0) {
        $errors = 1;
    }

    if ($dxChecked > 0) {
        try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_specimen($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,
                                    $25,$26,$27,$28,$29,$30,$31,$32,$33,$34,$35,$36,$37,$38,$39,$40,$41,$42,$43,$44,$45,$46,
                                    $47,$48,$49,$50,$51,$52,$53,$54,$55,$56,$57,$58,$59,$60,$61,$62,$63,$64,$65,$66)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                    $specimen_id,
                    $path_report_id,
                    $path_polyp_loc,
                    $polyp_num,
                    $discrepnote,
                    $container,
                    $fragment,
                    $other_dx_specify,
                    $site_location_cm,
                    $site_desc,
                    $size_mm,
                    $flg_no_path_spec,
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
                    $flg_dx,
                    $flg_no_discrep,
                    $flg_no_q_spec,
                    $flg_num_polyps,
                    $flg_site_discrep,
                    $flg_site_uncert,
                    $flg_path_sites,
                    $flg_review,
                    $hgd,
                    $ibd_ibd,
                    $ibd_actcol,
                    $ibd_chroncol,
                    $ibd_coloth,
                    $ibd_inactcol,
                    $ibd_lgdysp,
                    $n_intra_ca,
                    $n_inv_ca,
                    $n_cancer,
                    $ptype_fibroblast,
                    $ptype_lymphoid,
                    $flg_assump,
                    $flg_multis,
                    $flg_multisites,
                    $flg_residual,
                    $flg_assump_numpolyps,
                    $flg_dx_size,
                    $flg_dx_site,
                    $flg_dx_multis,
                    $specimen_type,
                    $notes,
                    $t_class,
                    $n_class,
                    $y_prefix,
                    $record_complete,
                    $flg_size_discrep)
                );
                if($result) {
                        $rows = pg_fetch_assoc( $result );
                        $specimen_id = $rows['lcl_specimen_id'];
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
    else {
        $submit_message='No diagnosis checked';
    }

}

if ($errors == 0 and $specimen_id != '') {
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
    isset($specimen_id)?$specimen_id:$specimen_id= "";
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
    isset($fragment)?$fragment:$fragment= "";
    isset($other_dx_specify)?$other_dx_specify:$other_dx_specify= "";
    isset($site_location_cm)?$site_location_cm:$site_location_cm= "";
    isset($site_desc)?$site_desc:$site_desc= "";
    isset($size_mm)?$size_mm:$size_mm= "";
    isset($flg_no_path_spec)?$flg_no_path_spec:$flg_no_path_spec = 0;
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
    isset($flg_dx)?$flg_dx:$flg_dx= 0;
    isset($flg_no_discrep)?$flg_no_discrep:$flg_no_discrep= 0;
    isset($flg_no_q_spec)?$flg_no_q_spec:$flg_no_q_spec= 0;
    isset($flg_num_polyps)?$flg_num_polyps:$flg_num_polyps= 0;
    isset($flg_site_discrep)?$flg_site_discrep:$flg_site_discrep= 0;
    isset($flg_site_uncert)?$flg_site_uncert:$flg_site_uncert= 0;
    isset($flg_path_sites)?$flg_path_sites:$flg_path_sites= 0;
    isset($flg_review)?$flg_review:$flg_review= 0;
    isset($hgd)?$hgd:$hgd= 0;
    isset($ibd_ibd)?$ibd_ibd:$ibd_ibd= 0;
    isset($ibd_actcol)?$ibd_actcol:$ibd_actcol= 0;
    isset($ibd_chroncol)?$ibd_chroncol:$ibd_chroncol= 0;
    isset($ibd_coloth)?$ibd_coloth:$ibd_coloth= 0;
    isset($ibd_inactcol)?$ibd_inactcol:$ibd_inactcol= 0;
    isset($ibd_lgdysp)?$ibd_lgdysp:$ibd_lgdysp= 0;
    isset($n_intra_ca)?$n_intra_ca:$n_intra_ca= 0;
    isset($n_inv_ca)?$n_inv_ca:$n_inv_ca= 0;
    isset($n_cancer)?$n_cancer:$n_cancer= 0;
    isset($ptype_fibroblast)?$ptype_fibroblast:$ptype_fibroblast= 0;
    isset($ptype_lymphoid)?$ptype_lymphoid:$ptype_lymphoid= 0;
    isset($flg_assump)?$flg_assump:$flg_assump= 0;
    isset($flg_multis)?$flg_multis:$flg_multis= 0;
    isset($flg_multisites)?$flg_multisites:$flg_multisites= 0;
    isset($flg_residual)?$flg_residual:$flg_residual= 0;
    isset($flg_assump_numpolyps)?$flg_assump_numpolyps:$flg_assump_numpolyps= 0;
    isset($flg_dx_size)?$flg_dx_size:$flg_dx_size= 0;
    isset($flg_dx_site)?$flg_dx_site:$flg_dx_site= 0;
    isset($flg_dx_multis)?$flg_dx_multis:$flg_dx_multis= 0;
    isset($specimen_type)?$specimen_type:$specimen_type= "";
    isset($notes)?$notes:$notes ="";
    isset($t_class)?$t_class:$t_class= "";
    isset($n_class)?$n_class:$n_class= "";
    isset($y_prefix)?$y_prefix:$y_prefix= 0;
    isset($record_complete)?$record_complete:$record_complete = 0;
    isset($flg_size_discrep)?$flg_size_discrep:$flg_size_discrep = 0;
    isset($aggregate_size)?$aggregate_size:$aggregate_size= 0;
    isset($unspec_no_fragments)?$unspec_no_fragments:$unspec_no_fragments= 0;

?>
<!DOCTYPE html>
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
    <link rel="shortcut icon" href="">
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" OnKeyPress="return disableEnterKey(event)">
<input type="hidden" id="specimen_id" name="specimen_id" value="<?php echo $specimen_id; ?>"/>
<input type="hidden" id="event_id" name="event_id" value="<?php echo $event_id; ?>"/>
<input type="hidden" id="path_report_id" name="path_report_id" value="<?php echo $path_report_id; ?>"/>
<div class="container">
<?php   if(    isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
<?php if ($specimen_type == 'Polyp') {
        echo '<div class="text-info text-center h2"> POLYP </div>';
    }
    elseif ($specimen_type == 'Suspected Cancer') {
        echo '<div class="text-info text-center h2"> SUSPECTED CANCER </div>';
    }
    elseif ($specimen_type == 'Biopsy') {
        echo '<div class="text-info text-center h2"> BIOPSY </div>';
    }
?>
    <div>
        Specimen ID:<?php echo $specimen_id; ?><br>
        Path Report ID:<?php echo $path_report_id; ?><br>
        Last Update: <?php echo $action_on.' - ' .$action_by; ?><br><br></b>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-1">Person ID</label>
        <div class="col-md-2">
            <input type="text" name="person_id" class="form-control" id="person_id" value="<?php echo $person_id; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Exam</label>
        <div class="col-md-2">
            <input type="date" name="event_date" class="form-control" id="event_date" value="<?php echo $event_date; ?>" readonly>
        </div>
        <label class="control-label col-md-1">Case</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="case_no" id="case_no" value="<?php echo $case_no;?>" readonly>
        </div>
        <label class="control-label col-md-1">Lab</label>
        <div class="col-md-2">
            <input type="text" class="form-control" name="lab_code" id="lab_code" value="<?php echo $lab_code;?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-1">Polyp Num</label>
        <div class="col-md-1">
            <input type="text" name="polyp_num" class="form-control" id="polyp_num" value="<?php echo $polyp_num; ?>">
        </div>
        <label class="control-label col-md-1">Container</label>
        <div class="col-md-1">
            <input type="text" name="container" class="form-control" id="container" value="<?php echo $container; ?>">
        </div>
        <label class="control-label col-md-2" for ="no_q_form">No Procedure Form</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="no_q_form" value="1" <?php echo $no_q_form=="1"?"checked":""; ?> disabled> 
        </div>
        <label class="control-label col-md-4" for ="q_form_incomplete">Procedure form missing polyp level data</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="q_form_incomplete" value="1" <?php echo $q_form_incomplete=="1"?"checked":""; ?> disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-1">Location cm</label>
        <div class="col-md-1">
            <input type="text" name="site_location_cm" class="form-control" id="site_location_cm" value="<?php echo $site_location_cm; ?>">
        </div>

        <label class="control-label col-md-1" for ="path_polyp_loc"> Anatomical Loc</label> 
        <div class="col-md-2">
            <select class="form-control" id="path_polyp_loc" name="path_polyp_loc">
                <option value="" 
                <?php 
                    if($path_polyp_loc==''){
                        echo "selected=\"selected\""; 
                    }
                ?>>
                </option>
                <option value="TI" 
                <?php 
                    if($path_polyp_loc=='TI'){
                        echo "selected=\"selected\""; 
                    }
                ?>>TI
                </option>
                <option value="CE" 
                <?php 
                    if($path_polyp_loc=='CE'){
                        echo "selected=\"selected\""; 
                    }
                ?>>CE
                </option>
                <option value="AC" 
                <?php 
                    if($path_polyp_loc=='AC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>AC
                </option>
                <option value="HF" 
                <?php 
                    if($path_polyp_loc=='HF'){
                        echo "selected=\"selected\""; 
                    }
                ?>>HF 
                </option>
                <option value="TC" 
                <?php 
                    if($path_polyp_loc=='TC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>TC 
                </option>
                <option value="SF" 
                <?php 
                    if($path_polyp_loc=='SF'){
                        echo "selected=\"selected\""; 
                    }
                ?>>SF 
                </option>
                <option value="DC" 
                <?php 
                    if($path_polyp_loc=='DC'){
                        echo "selected=\"selected\""; 
                    }
                ?>>DC
                </option>
                <option value="SG" 
                <?php 
                    if($path_polyp_loc=='SG'){
                        echo "selected=\"selected\""; 
                    }
                ?>>SG 
                </option>
                <option value="RE" 
                <?php 
                    if($path_polyp_loc=='RE'){
                        echo "selected=\"selected\""; 
                    }
                ?>>RE
                </option>
                <option value="U" 
                <?php 
                    if($path_polyp_loc=='U'){
                        echo "selected=\"selected\""; 
                    }
                ?>>AU
                </option>
            </select>
        </div>



    </div>
    <div class="form-group row">
        <label class="control-label col-md-1" for ="specimen_type"> Specimen Type</label> 
        <div class="col-md-2">
            <select class="form-control" id="specimen_type" name="specimen_type">
                <option value="" 
                <?php 
                    if($specimen_type==''){
                        echo "selected=\"selected\""; 
                    }
                ?>>
                </option>
                <option value="Polyp" 
                <?php 
                    if($specimen_type=='Polyp'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Polyp
                </option>
                <option value="Suspected Cancer" 
                <?php 
                    if($specimen_type=='Suspected Cancer'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Suspected Cancer
                </option>
                <option value="Biopsy" 
                <?php 
                    if($specimen_type=='Biopsy'){
                        echo "selected=\"selected\""; 
                    }
                ?>>Biopsy
                </option>
            </select>
        </div>
        <label class="control-label col-md-1">Polyp size mm</label>
        <div class="col-md-1">
            <input type="text" name="size_mm" class="form-control" id="size_mm" value="<?php echo $size_mm; ?>" required>
        </div>
        <label class="control-label col-md-2" for ="aggregate_size">Aggregate size</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="aggregate_size" value="1" <?php echo $aggregate_size=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-2" for ="unspec_no_fragments">Unspecified # of fragments</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="unspec_no_fragments" value="1" <?php echo $unspec_no_fragments=="1"?"checked":""; ?>>
        </div>
    </div>
    <hr>
    <h4> DISCREPANCIES</h4>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_no_discrep">No Discrepancies</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_no_discrep" value="1" <?php echo $flg_no_discrep=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="flg_residual">Residual Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_residual" value="1" <?php echo $flg_residual=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_size_discrep">Size Discrepancy</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_size_discrep" value="1" <?php echo $flg_size_discrep=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="flg_no_q_spec">No Q Specimen</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_no_q_spec" value="1" <?php echo $flg_no_q_spec=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_site_discrep">Site Discrepancy</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_site_discrep" value="1" <?php echo $flg_site_discrep=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="flg_site_uncert">Not certain polyp location is accurate</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_site_uncert" value="1" <?php echo $flg_site_uncert=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_num_polyps">? Number of Polyps</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_num_polyps" value="1" <?php echo $flg_num_polyps=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="flg_multis">Multiple polyps in a container</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_multis" value="1" <?php echo $flg_multis=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_no_path_spec">No Path Specimen</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_no_path_spec" value="1" <?php echo $flg_no_path_spec=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="flg_multisites">Polyps from multiple locations in a container</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_multisites" value="1" <?php echo $flg_multisites=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-7" for ="flg_path_sites">Conflicting polyp location on path report</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_path_sites" value="1" <?php echo $flg_path_sites=="1"?"checked":""; ?>>
        </div>
    </div>
    <hr>
    <h4> DIAGNOSES</h4>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_norm_muc">Normal Mucosa</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_norm_muc" value="1" <?php echo $ptype_norm_muc=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_inflam">Inflammatory Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_inflam" value="1" <?php echo $ptype_inflam=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_ta">Tubular Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="$ptype_ta" value="1" <?php echo $ptype_ta=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_juvenile">Juvenile</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_juvenile" value="1" <?php echo $ptype_juvenile=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_tva">Tubulovillous Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_tva" value="1" <?php echo $ptype_tva=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lelomyoma">Leiomyoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lelomyoma" value="1" <?php echo $ptype_lelomyoma=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_va">Villous Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_va" value="1" <?php echo $ptype_va=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lymphoid">Lymphoid Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lymphoid" value="1" <?php echo $ptype_lymphoid=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="$hgd">? High Grade Dysplasia/Intramucosal Carcinoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="hgd" value="1" <?php echo $hgd=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_lipoma">Lipoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_lipoma" value="1" <?php echo $ptype_lipoma=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="n_cancer">Cancer</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="n_cancer" value="1" <?php echo $n_cancer=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_lgdysp">Mucosal Low Grade Dysplasia (IBD)</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_lgdysp" value="1" <?php echo $ibd_lgdysp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="n_inv_ca">Invasive Cancer</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="n_inv_ca" value="1" <?php echo $n_inv_ca=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_mp">Mucosal Prolapse Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_mp" value="1" <?php echo $ptype_mp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_hp">Hyperplastic</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_hp" value="1" <?php echo $ptype_hp=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_pautzjeg">Pautz Jeghers</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_pautzjeg" value="1" <?php echo $ptype_pautzjeg=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="$ptype_ssp">Sessile Serrated Adenoma/Polyp (SSA/P)</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="$ptype_ssp" value="1" <?php echo $ptype_ssp=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_not_polyp">Not a Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_not_polyp" value="1" <?php echo $ptype_not_polyp=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_mixed">SSA/P with dysplasia/Mixed Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="$ptype_mixed" value="1" <?php echo $ptype_mixed=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_actcol">Colitis - Active</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_actcol" value="1" <?php echo $ibd_actcol=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_sa">Traditional Serrated Adenoma</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_sa" value="1" <?php echo $ptype_sa=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_chroncol">Colitis - Chronic</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_chroncol" value="1" <?php echo $ibd_chroncol=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_carcinoid">Carcinoid</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_carcinoid" value="1" <?php echo $ptype_carcinoid=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_coloth">Colitis - Other</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_coloth" value="1" <?php echo $ibd_coloth=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_fibroblast">Fibroblastic Polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_fibroblast" value="1" <?php echo $ptype_fibroblast=="1"?"checked":""; ?>>
        </div>

        <label class="control-label col-md-3" for ="ibd_inactcol">Colititis - Inactive</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_inactcol" value="1" <?php echo $ibd_inactcol=="1"?"checked":""; ?>>
        </div>

    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_ganglio">Ganglionueromatous</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_ganglio" value="1" <?php echo $ptype_ganglio=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ibd_ibd">Inflammatory Bowel Disease</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ibd_ibd" value="1" <?php echo $ibd_ibd=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="ptype_hamart">Hamartomatous</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_hamart" value="1" <?php echo $ptype_hamart=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-3" for ="ptype_other">Other Diagnosis</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="ptype_other" value="1" <?php echo $ptype_other=="1"?"checked":""; ?>>
        </div>
        <label class="control-label col-md-1" for ="other_dx_specify">Specify</label> 
        <div class="checkbox col-md-2">
            <input type="text" name="other_dx_specify" value="<?php echo $other_dx_specify;?>">
        </div>
    </div>
    <hr>
    <h4> ASSUMPTIONS</h4>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_dx_multis">Diagnosis(es) assigned to all polyps in container</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_dx_multis" value="1" <?php echo $flg_dx_multis=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_dx_size">Diagnosis assigned by size</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_dx_size" value="1" <?php echo $flg_dx_size=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_dx_site">Diagnosis assigned by location</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_dx_site" value="1" <?php echo $flg_dx_site=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_dx">Cannot by certain that diagnosis applies to this polyp</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_dx" value="1" <?php echo $flg_dx=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_assump_numpolyps">Assumption of 1 polyp in container</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_assump_numpolyps" value="1" <?php echo $flg_assump_numpolyps=="1"?"checked":""; ?>>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_review">Slide review necessary</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="flg_review" value="1" <?php echo $flg_review=="1"?"checked":""; ?>>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-3" for ="flg_assump"> Assumptions made on assigning diagnosis</label> 
        <div class="col-md-1">
            <label class="radio">
            <input type="radio" name="flg_assump" value="0" <?php echo $flg_assump=="0"?"checked":""; ?> >No
            </label>
        </div>
        <div class="col-md-1">
            <label class="radio">
            <input type="radio" name="flg_assump" value="1" <?php echo $flg_assump=="1"?"checked":""; ?> >Yes
            </label>
        </div>
    </div>

    <hr>
    <div class="form-group row">
        <label class="control-label col-md-1"> NOTES</label> 
        <div class="col-md-8">
        <textarea rows="5" class="form-control" name="discrepnote"><?php echo $discrepnote;?> </textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label col-md-3"> Specimen Record Complete</label> 
        <div class="checkbox col-md-1">
            <input type="checkbox" name="record_complete" value="1" <?php echo $record_complete=="1"?"checked":""; ?> disabled>
        </div>
    </div>

    <div class="text-center">
        <a href="specimens.php">Return to Specimens</a>
    </div>
    <div class="text-center">
        <button id="to_path" type="button" class="btn btn-link">Return to Path Report</button>
    </div>
    <div class="text-center">
        <input type="submit" id="idsub" class="btn-primary" name="confirm_submit" value="Save">
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/specimen.js"></script>
<script type="text/javascript" src="./js/corescript.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>