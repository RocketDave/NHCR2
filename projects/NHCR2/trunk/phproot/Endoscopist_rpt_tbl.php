<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");

$session->check_session($_SERVER['REQUEST_URI']);

try {
    $session->db_reconnect();
    if(!in_array('nhcr2_rc', $_SESSION['user_role_array'])) {
        $_SESSION['ERRORS'] = 'You are not an authorized user of this site.';
        header('Location: Logout.php');
    }
}
catch (Exception $e) {
    $session->info['message'] = $e->getMessage();
}

$current_date = date("m/d/Y");

isset($_POST['endoscopist_id'])?$endoscopist_id=$_POST['endoscopist_id']:$endoscopist_id="";

$result = $session->db_query("select * from get_endo_feedback (1000,'2014-01-01','2014-07-01');");

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($lcl_your_exams)?$lcl_your_exams:$lcl_your_exams;
isset($lcl_your_cum_exams)?$lcl_your_cum_exams:$lcl_your_cum_exams;
isset($lcl_site_cum_exams)?$lcl_site_cum_exams:$lcl_site_cum_exams;
isset($lcl_your_exams_comp )?$lcl_your_exams_comp :$lcl_your_exams_comp ;
isset($lcl_your_cum_exams_comp )?$lcl_your_cum_exams_comp :$lcl_your_cum_exams_comp ;
isset($lcl_site_cum_exams_comp )?$lcl_site_cum_exams_comp :$lcl_site_cum_exams_comp ;
isset($lcl_your_minutes)?$lcl_your_minutes:$lcl_your_minutes;
isset($lcl_your_minutes_range_low)?$lcl_your_minutes_range_low:$lcl_your_minutes_range_low;
isset($lcl_your_minutes_range_high)?$lcl_your_minutes_range_high:$lcl_your_minutes_range_high;
isset($lcl_your_minutes_range )?$lcl_your_minutes_range :$lcl_your_minutes_range ;
isset($lcl_your_cum_minutes)?$lcl_your_cum_minutes:$lcl_your_cum_minutes;
isset($lcl_your_cum_minutes_range_low)?$lcl_your_cum_minutes_range_low:$lcl_your_cum_minutes_range_low;
isset($lcl_your_cum_minutes_range_high)?$lcl_your_cum_minutes_range_high:$lcl_your_cum_minutes_range_high;
isset($lcl_your_cum_minutes_range )?$lcl_your_cum_minutes_range :$lcl_your_cum_minutes_range ;
isset($lcl_site_cum_minutes)?$lcl_site_cum_minutes:$lcl_site_cum_minutes;
isset($lcl_site_cum_minutes_range_low)?$lcl_site_cum_minutes_range_low:$lcl_site_cum_minutes_range_low;
isset($lcl_site_cum_minutes_range_high)?$lcl_site_cum_minutes_range_high:$lcl_site_cum_minutes_range_high;
isset($lcl_site_cum_minutes_range )?$lcl_site_cum_minutes_range :$lcl_site_cum_minutes_range ;
isset($lcl_your_adr_male )?$lcl_your_adr_male :$lcl_your_adr_male ;
isset($lcl_your_adr_female )?$lcl_your_adr_female :$lcl_your_adr_female ;
isset($lcl_your_adr_all )?$lcl_your_adr_all :$lcl_your_adr_all ;
isset($lcl_your_cum_adr_male )?$lcl_your_cum_adr_male :$lcl_your_cum_adr_male ;
isset($lcl_your_cum_adr_female )?$lcl_your_cum_adr_female :$lcl_your_cum_adr_female ;
isset($lcl_your_cum_adr_all )?$lcl_your_cum_adr_all :$lcl_your_cum_adr_all ;
isset($lcl_site_cum_adr_male )?$lcl_site_cum_adr_male :$lcl_site_cum_adr_male ;
isset($lcl_site_cum_adr_female )?$lcl_site_cum_adr_female :$lcl_site_cum_adr_female ;
isset($lcl_site_cum_adr_all )?$lcl_site_cum_adr_all :$lcl_site_cum_adr_all ;
isset($lcl_your_eligible_male )?$lcl_your_eligible_male :$lcl_your_eligible_male ;
isset($lcl_your_eligible_female )?$lcl_your_eligible_female :$lcl_your_eligible_female ;
isset($lcl_your_eligible_all )?$lcl_your_eligible_all :$lcl_your_eligible_all ;
isset($lcl_your_cum_eligible_male )?$lcl_your_cum_eligible_male :$lcl_your_cum_eligible_male ;
isset($lcl_your_cum_eligible_female )?$lcl_your_cum_eligible_female :$lcl_your_cum_eligible_female ;
isset($lcl_your_cum_eligible_all )?$lcl_your_cum_eligible_all :$lcl_your_cum_eligible_all ;
isset($lcl_site_cum_eligible_male )?$lcl_site_cum_eligible_male :$lcl_site_cum_eligible_male ;
isset($lcl_site_cum_eligible_female )?$lcl_site_cum_eligible_female :$lcl_site_cum_eligible_female ;
isset($lcl_site_cum_eligible_all )?$lcl_site_cum_eligible_all :$lcl_site_cum_eligible_all ;
isset($lcl_your_adr_scr_male)?$lcl_your_adr_scr_male:$lcl_your_adr_scr_male;
isset($lcl_your_adr_scr_female)?$lcl_your_adr_scr_female:$lcl_your_adr_scr_female;
isset($lcl_your_adr_scr_all)?$lcl_your_adr_scr_all:$lcl_your_adr_scr_all;
isset($lcl_your_cum_adr_scr_male)?$lcl_your_cum_adr_scr_male:$lcl_your_cum_adr_scr_male;
isset($lcl_your_cum_adr_scr_female)?$lcl_your_cum_adr_scr_female:$lcl_your_cum_adr_scr_female;
isset($lcl_your_cum_adr_scr_all)?$lcl_your_cum_adr_scr_all:$lcl_your_cum_adr_scr_all;
isset($lcl_site_cum_adr_scr_male)?$lcl_site_cum_adr_scr_male:$lcl_site_cum_adr_scr_male;
isset($lcl_site_cum_adr_scr_female)?$lcl_site_cum_adr_scr_female:$lcl_site_cum_adr_scr_female;
isset($lcl_site_cum_adr_scr_all)?$lcl_site_cum_adr_scr_all:$lcl_site_cum_adr_scr_all;
isset($lcl_your_adr_sur_male)?$lcl_your_adr_sur_male:$lcl_your_adr_sur_male;
isset($lcl_your_adr_sur_female)?$lcl_your_adr_sur_female:$lcl_your_adr_sur_female;
isset($lcl_your_adr_sur_all)?$lcl_your_adr_sur_all:$lcl_your_adr_sur_all;
isset($lcl_your_cum_adr_sur_male)?$lcl_your_cum_adr_sur_male:$lcl_your_cum_adr_sur_male;
isset($lcl_your_cum_adr_sur_female)?$lcl_your_cum_adr_sur_female:$lcl_your_cum_adr_sur_female;
isset($lcl_your_cum_adr_sur_all)?$lcl_your_cum_adr_sur_all:$lcl_your_cum_adr_sur_all;
isset($lcl_site_cum_adr_sur_male)?$lcl_site_cum_adr_sur_male:$lcl_site_cum_adr_sur_male;
isset($lcl_site_cum_adr_sur_female)?$lcl_site_cum_adr_sur_female:$lcl_site_cum_adr_sur_female;
isset($lcl_site_cum_adr_sur_all)?$lcl_site_cum_adr_sur_all:$lcl_site_cum_adr_sur_all;
isset($lcl_your_sspolyp_male)?$lcl_your_sspolyp_male:$lcl_your_sspolyp_male;
isset($lcl_your_sspolyp_female)?$lcl_your_sspolyp_female:$lcl_your_sspolyp_female;
isset($lcl_your_sspolyp_all)?$lcl_your_sspolyp_all:$lcl_your_sspolyp_all;
isset($lcl_your_cum_sspolyp_male)?$lcl_your_cum_sspolyp_male:$lcl_your_cum_sspolyp_male;
isset($lcl_your_cum_sspolyp_female)?$lcl_your_cum_sspolyp_female:$lcl_your_cum_sspolyp_female;
isset($lcl_your_cum_sspolyp_all)?$lcl_your_cum_sspolyp_all:$lcl_your_cum_sspolyp_all;
isset($lcl_site_cum_sspolyp_male)?$lcl_site_cum_sspolyp_male:$lcl_site_cum_sspolyp_male;
isset($lcl_site_cum_sspolyp_female)?$lcl_site_cum_sspolyp_female:$lcl_site_cum_sspolyp_female;
isset($lcl_site_cum_sspolyp_all)?$lcl_site_cum_sspolyp_all:$lcl_site_cum_sspolyp_all;


?>
<!DOCTYPE html>
<head>
<title>Endoscopists</title>
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

<p><p>
<div class="container">
    <div class="jumbotron">
        <h2>NEW HAMPSHIRE COLONOSCOPY REGISTRY</h2>
        <h3>Endoscopist Feedback Report</h3>
    </div>
        <div clas="row">
            <div class="col-sm-3"> Your Exams </div>
            <div class="col-sm-3"> Your Cumulative Exams </div>
            <div class="col-sm-3"> Cumulative Exams at Your Site </div>
        </div>
        <div clas="row">
            <div class="colsm-3"> Total Colonoscopies in NHCR database </div>
            <div class="colsm-1"> <?php echo $lcl_your_exams?></div>
            <div class="colsm-1"> <?php echo $lcl_your_cum_exams?></div>
            <div class="colsm-1"> <?php echo $lcl_site_cum_exams?></div>
        </div>
        <div clas="row">
            <div class="col-sm-3"> Procedure Completion Rate </div>
            <div class="col-sm-1"> <?php echo round(($lcl_your_exams_comp / $lcl_your_exams),2)?></div>
            <div class="col-sm-1"> <?php echo round(($lcl_your_cum_exams_comp / $lcl_your_cum_exams),2)?></div>
            <div class="col-sm-1"> <?php echo round(($lcl_site_cum_exams_comp / $lcl_site_cum_exams),2)?></div>
        </div>
        <div clas="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-2"> Median (minutes) </div>
                <div class="col-sm-2"> Range </div>
                <div class="col-sm-2"> Median (minutes) </div>
                <div class="col-sm-2"> Range </div>
                <div class="col-sm-2"> Median (minutes) </div>
                <div class="col-sm-2"> Range </div>
        </div>
        <div clas="row">
            <div class="col-sm-3"> Withdrawal time* (normal exams) </div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes?></div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes_range_low . ' - ' . $lcl_your_minutes_range_high?></div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes?></div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes_range_low . ' - ' . $lcl_your_minutes_range_high?></div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes?></div>
                 <div class="col-sm-1"> <?php echo $lcl_your_minutes_range_low . ' - ' . $lcl_your_minutes_range_high?></div>
        </div>
</div>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist.js"></script>
</body>
</html>