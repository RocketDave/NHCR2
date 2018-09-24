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
isset($_POST['endo_code'])?$endo_code=$_POST['endo_code']:$endo_code="";
isset($_POST['facility_id'])?$facility_id=$_POST['facility_id']:$facility_id="";
isset($_POST['endo_start_date'])?$endo_start_date=$_POST['endo_start_date']:$endo_start_date="";
isset($_POST['endo_end_date'])?$endo_end_date=$_POST['endo_end_date']:$endo_end_date="";
isset($_POST['nhcr_end_date'])?$nhcr_end_date=$_POST['nhcr_end_date']:$nhcr_end_date="";

$pr_start_date = strtotime($endo_start_date);
$pr_start_date = date("m/d/Y",$pr_start_date);
$pr_end_date = strtotime($endo_end_date);
$pr_end_date = date("m/d/Y",$pr_end_date);
$pr_nhcr_date = strtotime($nhcr_end_date);
$pr_nhcr_date = date("m/d/Y",$pr_nhcr_date);


$result_endos = pg_query($conn,"select count(*) from facility where facility_pseudo_name = '".$facility_id."'");
$endo_count = pg_fetch_result($result_endos, 0, 0);

$result = pg_query($conn,"select * from get_endo_feedback ('".$endo_code."','".$facility_id."','".$endo_start_date."','".$endo_end_date."','".$nhcr_end_date."');");
while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

$lcl_your_first_colo = strtotime($lcl_your_first_colo);
$lcl_your_first_colo = date("m/d/Y",$lcl_your_first_colo);
$lcl_site_first_colo = strtotime($lcl_site_first_colo);
$lcl_site_first_colo = date("m/d/Y",$lcl_site_first_colo);
$lcl_nhcr_first_colo = '04/06/2009';

// Indication Your 
$result = pg_query($conn,"select * from get_indication_your ('".$endo_code."','".$facility_id."','".$endo_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'indication', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'total', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['indication'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['total'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData1.json";
$string = file_put_contents($filename,$jsonTable);
//Indication Site
$result = pg_query($conn,"select * from get_indication_site ('".$facility_id."','".$endo_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'indication', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'total', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['indication'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['total'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData2.json";
$string = file_put_contents($filename,$jsonTable);


//Indication NHCR
$result = pg_query($conn,"select * from get_indication_nhcr ('".$lcl_nhcr_first_colo."','".$nhcr_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'indication', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'total', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['indication'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['total'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData3.json";
$string = file_put_contents($filename,$jsonTable);


//Findings Screening
$result = pg_query($conn,"select * from get_findings_screening('".$endo_code."','".$facility_id."','".$lcl_nhcr_first_colo."','".$endo_end_date."','".$nhcr_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'finding', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'You', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'Your Site', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'All NHCR Sites', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['finding'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['you'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['site'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['nhcr'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData4.json";
$string = file_put_contents($filename,$jsonTable);

//Findings Surveillance
$result = pg_query($conn,"select * from get_findings_surveillance('".$endo_code."','".$facility_id."','".$lcl_nhcr_first_colo."','".$endo_end_date."','".$nhcr_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'finding', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'You', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'Your Site', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'All NHCR Sites', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['finding'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['you'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['site'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['nhcr'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData5.json";
$string = file_put_contents($filename,$jsonTable);

//Findings Diagnostic
$result = pg_query($conn,"select * from get_findings_diagnostic('".$endo_code."','".$facility_id."','".$lcl_nhcr_first_colo."','".$endo_end_date."','".$nhcr_end_date."');");

$table = array();
$table['cols'] = array(
    array('id' => "", 'label' => 'finding', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'You', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'Your Site', 'pattern' => "", 'type' => 'number'),
    array('id' => "", 'label' => 'All NHCR Sites', 'pattern' => "", 'type' => 'number')
);
$rows = array();
while ($nt = pg_fetch_assoc($result)){
    $temp = array();
    $temp[] = array('v' => $nt['finding'], 'f' =>NULL);
    $temp[] = array('v' => trim($nt['you'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['site'],'"'), 'f' =>NULL);
    $temp[] = array('v' => trim($nt['nhcr'],'"'), 'f' =>NULL);
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table,JSON_NUMERIC_CHECK);
$path =getcwd();
$filename = $path."/data/MyData6.json";
$string = file_put_contents($filename,$jsonTable);



?>
<!DOCTYPE html>
<head>
<style>
p.padding {
    padding-bottom: 7cm;
}
p.padding2 {
    padding-bottom: 1cm;
}

</style>
<title>Endoscopists</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart1);
      google.charts.setOnLoadCallback(drawChart2);
      google.charts.setOnLoadCallback(drawChart3);
      google.charts.setOnLoadCallback(drawChart4);
      google.charts.setOnLoadCallback(drawChart5);
      google.charts.setOnLoadCallback(drawChart6);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart1() {
        var jsonData = $.ajax({
            url: "getData.php",
            dataType: "JSON",
            async: false
        }).responseText;

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var title2 = "<?php echo 'Your Exams '.$lcl_your_first_colo.' to '.$pr_end_date ?>";
        var options = {'title':title2,
                       'width':475,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }
      function drawChart2() {
        var jsonData = $.ajax({
            url: "getData2.php",
            dataType: "JSON",
            async: false
        }).responseText;

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var title2 = "<?php echo 'Your Site '.$lcl_site_first_colo.' to '.$pr_end_date ?>";
        var options = {'title':title2,
                       'width':475,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
      function drawChart3() {
        var jsonData = $.ajax({
            url: "getData3.php",
            dataType: "JSON",
            async: false
        }).responseText;

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);
        // Set chart options
        var title2 = "<?php echo 'All NHCR Sites '.$lcl_nhcr_first_colo.' to '.$pr_nhcr_date ?>";
        var options = {'title':title2,
                       'width':475,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }

    function drawChart4() {
        var jsonData = $.ajax({
            url: "getData4.php",
            dataType: "JSON",
            async: false
        }).responseText;

        var options = {
            title : 'Screening',
            titleTextStyle: { 
                fontSize: 20},
            'width':475,
            'height':400,
            vAxis: {
                viewWindow: {
                    min: 0,
                    max: 100
                },
                ticks: [0, 25, 50, 75, 100] // display labels every 25
            },
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div4'));
   chart.draw(data, options);
    }

    function drawChart5() {
        var jsonData = $.ajax({
            url: "getData5.php",
            dataType: "JSON",
            async: false
        }).responseText;

        var options = {
            title : 'Surveillance',
            titleTextStyle: { 
                fontSize: 20},
            'width':475,
            'height':400,
            vAxis: {
                viewWindow: {
                    min: 0,
                    max: 100
                },
                ticks: [0, 25, 50, 75, 100] // display labels every 25
            },
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div5'));
        chart.draw(data, options);
    }

    function drawChart6() {
        var jsonData = $.ajax({
            url: "getData6.php",
            dataType: "JSON",
            async: false
        }).responseText;

        var options = {
            title : 'Diagnostic',
            titleTextStyle: { 
                fontSize: 20},
            seriesType: 'bars',
            vAxis: {
                viewWindow: {
                    min: 0,
                    max: 100
                },
                ticks: [0, 25, 50, 75, 100] // display labels every 25
            },
            'width':475,
            'height':400,
            series: {5: {type: 'line'}}
        };
      // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ComboChart(document.getElementById('chart_div6'));
        chart.draw(data, options);
    }

</script>
</head>
<body >
<p><p>
<div class="container-fluid ">
    <div class="page-header">
        <h1 class="text-center">NEW HAMPSHIRE COLONOSCOPY REGISTRY</h1>
        <h2 class="text-center">Endoscopist Feedback Report </h2>
    </div>
    <table class="table table-bordered small">
        <tbody>
            <tr class="active">
                <td colspan="1"></td>
                <td colspan="6">  <?php echo '<b>Your Recent Colonoscopies </b> <br>'.$pr_start_date.' - '.$pr_end_date?></td>
                <td colspan="6">  <?php echo '<b>Your Cumulative Colonoscopies</b><br>'.$lcl_your_first_colo.' - '.$pr_end_date?></td>
                <td colspan="6">  <?php echo '<b>Cumulative Colonoscopies at Your Site</b><br>'.$lcl_site_first_colo.' - '.$pr_end_date?></td>
                <td colspan="6">  <?php echo '<b>Cumulative Colonoscopies at all NHCR Sites</b><br>'.$lcl_nhcr_first_colo.' - '.$pr_nhcr_date.' *'?></td>
            </tr>
            <tr>
                <td colspan="1"> Total Colonoscopies</td>
                <td colspan="6"> <?php echo $lcl_your_exams?></td>
                <td colspan="6"> <?php echo $lcl_your_exams_cum?></td>
                <td colspan="6"> <?php echo $lcl_site_exams?></td>
                <td colspan="6"> <?php echo number_format($lcl_nhcr_exams)?></td>
            </tr>
            <tr>
                <td colspan="1"> Procedure Completion Rate </td>
                <td colspan="6"> <?php echo $lcl_your_exams_comp_denom==0?'':number_format(round(100 * $lcl_your_exams_comp/$lcl_your_exams_comp_denom,1),1)?>%</td> 
                <td colspan="6"> <?php echo $lcl_your_exams_comp_denom_cum==0?'':number_format(round(100 * $lcl_your_exams_comp_cum/$lcl_your_exams_comp_denom_cum,1),1)?>%</td>
                <td colspan="6"> <?php echo $lcl_site_exams_comp_denom==0?'':number_format(round(100 * $lcl_site_exams_comp/$lcl_site_exams_comp_denom,1),1)?>%</td>
                <td colspan="6"> <?php echo $lcl_nhcr_exams_comp_denom==0?'':number_format(round(100 * $lcl_nhcr_exams_comp/$lcl_nhcr_exams_comp_denom,1),1)?>%</td>
            </tr>
            <tr>
                <th colspan="1"> </th>
                <th colspan="3"> Median (min) </th>
                <th colspan="3"> Range (min)</th>
                <th colspan="3"> Median (min) </th>
                <th colspan="3"> Range (min) </th>
                <th colspan="3"> Median (min) </th>
                <th colspan="3"> Range (min) </th>
                <th colspan="3"> Median (min) </th>
                <th colspan="3"> Range (min) </th>
            </tr>
            <tr >
                <td colspan="1"> Withdrawal time** (normal exams) </td>
                <td colspan="3"><?php echo $lcl_your_minutes?></td>
                <td colspan="3"><?php echo $lcl_your_minutes_low . ' - ' . $lcl_your_minutes_high?></td>
                <td colspan="3"><?php echo $lcl_your_minutes_cum?></td>
                <td colspan="3"><?php echo $lcl_your_minutes_low_cum . ' - ' . $lcl_your_minutes_high_cum?></td>
                <td colspan="3"><?php echo $lcl_site_minutes?></td>
                <td colspan="3"><?php echo $lcl_site_minutes_low . ' - ' . $lcl_site_minutes_high?></td>
                <td colspan="3"><?php echo $lcl_nhcr_minutes?></td>
                <td colspan="3"><?php echo $lcl_nhcr_minutes_low . ' - ' . $lcl_nhcr_minutes_high?></td>
            </tr>
            <tr>
                <th colspan="1"> ADENOMA DETECTION RATE</th>
                <th colspan="2"> Male </th>
                <th colspan="2"> Female </th>
                <th colspan="2"> All </th>
                <th colspan="2"> Male </th>
                <th colspan="2"> Female </th>
                <th colspan="2"> All </th>
                <th colspan="2"> Male </th>
                <th colspan="2"> Female </th>
                <th colspan="2"> All </th>
                <th colspan="2"> Male </th>
                <th colspan="2"> Female </th>
                <th colspan="2"> All </th>
            </tr>
            <tr >
                <td colspan="1"> N (# of eligible exams)***</td>
                <td colspan="2"><?php echo number_format($lcl_your_eligible_male)?></td>  <! your eligible male!>
                <td colspan="2"><?php echo number_format($lcl_your_eligible_female)?></td> <! your eligible female !>
                <td colspan="2"><?php echo number_format($lcl_your_eligible_all)?></td> <
                <td colspan="2"><?php echo number_format($lcl_your_eligible_male_cum)?></td>
                <td colspan="2"><?php echo number_format($lcl_your_eligible_female_cum)?></td>
                <td colspan="2"><?php echo number_format($lcl_your_eligible_all_cum)?></td>
                <td colspan="2"><?php echo number_format($lcl_site_eligible_male)?></td>
                <td colspan="2"><?php echo number_format($lcl_site_eligible_female)?></td>
                <td colspan="2"><?php echo number_format($lcl_site_eligible_all)?></td>
                <td colspan="2"><?php echo number_format($lcl_nhcr_eligible_male)?></td>
                <td colspan="2"><?php echo number_format($lcl_nhcr_eligible_female)?></td>
                <td colspan="2"><?php echo number_format($lcl_nhcr_eligible_all)?></td>
            </tr>
            <tr >
                <td colspan="1"> ADR (<i>screening only</i>)</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_scr==0?'': number_format(round(100* $lcl_your_adr_scr_male/$lcl_your_eligible_male_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_scr==0?'': number_format(round(100* $lcl_your_adr_scr_female/$lcl_your_eligible_female_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_scr==0?'': number_format(round(100* $lcl_your_adr_scr_all/$lcl_your_eligible_all_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_scr_cum==0?'': number_format(round(100* $lcl_your_adr_scr_male_cum/$lcl_your_eligible_male_scr_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_scr_cum==0?'': number_format(round(100* $lcl_your_adr_scr_female_cum/$lcl_your_eligible_female_scr_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_scr_cum==0?'': number_format(round(100* $lcl_your_adr_scr_all_cum/$lcl_your_eligible_all_scr_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_male_scr==0?'': number_format(round(100* $lcl_site_adr_scr_male/$lcl_site_eligible_male_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_female_scr==0?'': number_format(round(100* $lcl_site_adr_scr_female/$lcl_site_eligible_female_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_all_scr==0?'': number_format(round(100* $lcl_site_adr_scr_all/$lcl_site_eligible_all_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_male_scr==0?'': number_format(round(100* $lcl_nhcr_adr_scr_male/$lcl_nhcr_eligible_male_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_female_scr==0?'': number_format(round(100* $lcl_nhcr_adr_scr_female/$lcl_nhcr_eligible_female_scr,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_all_scr==0?'': number_format(round(100* $lcl_nhcr_adr_scr_all/$lcl_nhcr_eligible_all_scr,1),1)?>%</td>
            </tr>
            <tr >
                <td colspan="1"> ADR (<i>surveillance only</i>)</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_sur==0?'': number_format(round(100* $lcl_your_adr_sur_male/$lcl_your_eligible_male_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_sur==0?'': number_format(round(100* $lcl_your_adr_sur_female/$lcl_your_eligible_female_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_sur==0?'': number_format(round(100* $lcl_your_adr_sur_all/$lcl_your_eligible_all_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_sur_cum==0?'': number_format(round(100* $lcl_your_adr_sur_male_cum/$lcl_your_eligible_male_sur_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_sur_cum==0?'': number_format(round(100* $lcl_your_adr_sur_female_cum/$lcl_your_eligible_female_sur_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_sur_cum==0?'': number_format(round(100* $lcl_your_adr_sur_all_cum/$lcl_your_eligible_all_sur_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_male_sur==0?'': number_format(round(100* $lcl_site_adr_sur_male/$lcl_site_eligible_male_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_female_sur==0?'': number_format(round(100* $lcl_site_adr_sur_female/$lcl_site_eligible_female_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_all_sur==0?'': number_format(round(100* $lcl_site_adr_sur_all/$lcl_site_eligible_all_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_male_sur==0?'': number_format(round(100* $lcl_nhcr_adr_sur_male/$lcl_nhcr_eligible_male_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_female_sur==0?'': number_format(round(100* $lcl_nhcr_adr_sur_female/$lcl_nhcr_eligible_female_sur,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_all_sur==0?'': number_format(round(100* $lcl_nhcr_adr_sur_all/$lcl_nhcr_eligible_all_sur,1),1)?>%</td>
            </tr>
            <tr >
                <td colspan="1"> ADR (<i>screening and surveillance</i>)</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male==0?'':number_format(round(100*$lcl_your_adr_male/$lcl_your_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female==0?'':number_format(round(100*$lcl_your_adr_female/$lcl_your_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all==0?'':number_format(round(100*$lcl_your_adr_all/$lcl_your_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_cum==0?'':number_format(round(100*$lcl_your_adr_male_cum/$lcl_your_eligible_male_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_cum==0?'':number_format(round(100*$lcl_your_adr_female_cum/$lcl_your_eligible_female_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_cum==0?'':number_format(round(100*$lcl_your_adr_all_cum/$lcl_your_eligible_all_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_male==0?'':number_format(round(100*$lcl_site_adr_male/$lcl_site_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_female==0?'':number_format(round(100*$lcl_site_adr_female/$lcl_site_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_all==0?'':number_format(round(100*$lcl_site_adr_all/$lcl_site_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_male==0?'':number_format(round(100*$lcl_nhcr_adr_male/$lcl_nhcr_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_female==0?'':number_format(round(100*$lcl_nhcr_adr_female/$lcl_nhcr_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_all==0?'':number_format(round(100*$lcl_nhcr_adr_all/$lcl_nhcr_eligible_all,1),1)?>%</td>
            </tr>
            <tr>
                <th colspan="1"> SERRATED POLYP DETECTION RATE</th>
            <tr >
                <td colspan="1"> Clinically Significant Serrated Polyps</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male==0?'': number_format(round(100* $lcl_your_cssp_male/$lcl_your_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female==0?'': number_format(round(100* $lcl_your_cssp_female/$lcl_your_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all==0?'': number_format(round(100* $lcl_your_cssp_all/$lcl_your_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_cum==0?'': number_format(round(100* $lcl_your_cssp_male_cum/$lcl_your_eligible_male_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_cum==0?'': number_format(round(100* $lcl_your_cssp_female_cum/$lcl_your_eligible_female_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_cum==0?'': number_format(round(100* $lcl_your_cssp_all_cum/$lcl_your_eligible_all_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_male==0?'': number_format(round(100* $lcl_site_cssp_male/$lcl_site_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_female==0?'': number_format(round(100* $lcl_site_cssp_female/$lcl_site_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_all==0?'': number_format(round(100* $lcl_site_cssp_all/$lcl_site_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_male==0?'': number_format(round(100* $lcl_nhcr_cssp_male/$lcl_nhcr_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_female==0?'': number_format(round(100* $lcl_nhcr_cssp_female/$lcl_nhcr_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_all==0?'': number_format(round(100* $lcl_nhcr_cssp_all/$lcl_nhcr_eligible_all,1),1)?>%</td>
            </tr>
            <tr >
                <td colspan="1"> Proximal Serrated Polyps </td>
                <td colspan="2"><?php echo $lcl_your_eligible_male==0?'': number_format(round(100* $lcl_your_psp_male/$lcl_your_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female==0?'': number_format(round(100* $lcl_your_psp_female/$lcl_your_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all==0?'': number_format(round(100* $lcl_your_psp_all/$lcl_your_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_male_cum==0?'': number_format(round(100* $lcl_your_psp_male_cum/$lcl_your_eligible_male_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_female_cum==0?'': number_format(round(100* $lcl_your_psp_female_cum/$lcl_your_eligible_female_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_your_eligible_all_cum==0?'': number_format(round(100* $lcl_your_psp_all_cum/$lcl_your_eligible_all_cum,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_male==0?'': number_format(round(100* $lcl_site_psp_male/$lcl_site_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_female==0?'': number_format(round(100* $lcl_site_psp_female/$lcl_site_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_site_eligible_all==0?'': number_format(round(100* $lcl_site_psp_all/$lcl_site_eligible_all,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_male==0?'': number_format(round(100* $lcl_nhcr_psp_male/$lcl_nhcr_eligible_male,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_female==0?'': number_format(round(100* $lcl_nhcr_psp_female/$lcl_nhcr_eligible_female,1),1)?>%</td>
                <td colspan="2"><?php echo $lcl_nhcr_eligible_all==0?'': number_format(round(100* $lcl_nhcr_psp_all/$lcl_nhcr_eligible_all,1),1)?>%</td>
            </tr>
			
            <!--<tr>
                <td colspan="1"><b>APPROPRIATE FOLLOW-UP</b>  - normal screening exams </td>
                <td colspan="6"> <?php echo $lcl_your_exams_rec_denom==0?'':number_format(round(100 * $lcl_your_exams_rec/$lcl_your_exams_rec_denom),1)?>%</td>
                <td colspan="6"> <?php echo $lcl_your_exams_rec_denom_cum==0?'':number_format(round(100 * $lcl_your_exams_rec_cum/$lcl_your_exams_rec_denom_cum),1)?>%</td>
                <td colspan="6"> <?php echo $lcl_site_exams_rec_denom==0?'':number_format(round(100 * $lcl_site_exams_rec/$lcl_site_exams_rec_denom),1)?>%</td>
                <td colspan="6"> <?php echo $lcl_nhcr_exams_rec_denom==0?'':number_format(round(100 * $lcl_nhcr_exams_rec/$lcl_nhcr_exams_rec_denom),1)?>%</td>
            </tr> -->
        </tbody>
    </table>
    <footer>
        <p class="small">*Data for all NHCR sites is provided from 4/2009, when the NHCR moved from a pilot study to a state-wide registry, through the date for which pathology has been abstracted for all participating sites.
        <p class="small">** Withdrawal times are based on NHCR data collection categories, with less than 2 minutes coded as 1 and greater than 10 minutes coded as 11</P>
        <p class="small">*** Incomplete exams, those with an indication of Diagnostic, Surveillance Familial Polyposis/HNPCC or Surveillance IBD, those for which indication was not noted and those with poor prep were excluded.</P>
        <P class="small padding"> <?php echo 'Endo code '.$endo_code.'&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Site code '.$facility_id.' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Created on '. date("m/d/Y")."<br>";?>
    </footer>

</div>

<div class="container-fluid ">
    <div class="page-header">
    <h1 class="text-center">NEW HAMPSHIRE COLONOSCOPY REGISTRY</h1>
    <h3 class="text-center">INDICATION FOR EXAM </h3>
    <table class="columns">
      <tr>
        <td><div id="chart_div1" style="border: 1px solid #ccc"></div></td>
        <td><div id="chart_div2" style="border: 1px solid #ccc"></div></td>
        <td><div id="chart_div3" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
    <h3 class="text-center">EXAM FINDINGS BY INDICATION</h3>
    <p class="small text-center">(categories not mutually exclusive)</p>
    <table class="columns">
      <tr>
        <td><div id="chart_div4" style="border: 1px solid #ccc"></div></td>
        <td><div id="chart_div5" style="border: 1px solid #ccc"></div></td>
        <td><div id="chart_div6" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist.js"></script>

</body>
</html>