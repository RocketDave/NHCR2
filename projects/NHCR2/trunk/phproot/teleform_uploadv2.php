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
$submit_message = "";
$submit_message2 = "";

/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }


    if($confirm_submit == 'Upload Survey Data')  {
    #       SURVEY UPLOAD SECTION                           #
        # All code is written knowing that each file has record headers as the first line and records of data on each following line.
        # The headers and values are separated by tabs. So it is known that the file must be parsed by end of line characters and then
        # parsed by tab.


        # check for errors with the upload
        try{
            if ($_FILES["surveyfile"]["error"] > 0)      {
               # throw new Exception("Return Code: " . $_FILES["surveyfile"]["error"] . "<br>");
                 $submit_message = '<font color="red">Error uploading the file '. basename( $_FILES["surveyfile"]["name"]). ' - File does not exist or is invalid.<br/>';
            }      else      {
                # no errors, get information about the file
                $fileName = $_FILES['surveyfile']['name'];        # get the file name
                $tmpName  = $_FILES['surveyfile']['tmp_name'];    # get the temperary file name created by the server
                $fileSize = $_FILES['surveyfile']['size'];        # get the size of the file
                $fileType = $_FILES['surveyfile']['type'];        # get the type of the file i.e. text/image/etc
                $fileExt  = pathinfo($_FILES["surveyfile"]["name"],PATHINFO_EXTENSION); # get the file extension i.e. txt, png, ect.
                $target_dir = "/var/www/html/nhcr2/data/";                            # directory where file will be saved;

                # create the new name of the file in the format of survey<datetime>(<origianlName).txt
                $newFileName = "survey".date("mdYHis")."(".basename( $_FILES["surveyfile"]["name"],".".$fileExt).").". $fileExt;

                # Open uploaded file
                $fp = fopen($tmpName, 'rb');

                # Create variables for converting contents into an array
                $content = array();
                $contentLine = array();
                $contentStr = '';

                # Read the contents of the file into a string.
                # When working on a Windows server running PHP this is the best way to get the file read from the temperary location.
                if (!feof($fp)) {
                  $contentStr = fread($fp, filesize($tmpName));
                }

                # Parse the records (each new line is a new record) into an array, the PHP_EOL is a keyword that looks for the End Of Line (EOL)
                $contentLine = explode(PHP_EOL,$contentStr);

                # Parse each record so the values are in the second dimension of the array i.e. $content[0][0] is the first value of the first record
                $counter = 0;
                foreach ( $contentLine as $line)    {
                    $content[$counter] = explode("\t", $line);
                    $counter +=1;
                }

                fclose($fp);

                # Check to make sure the data is survey data by checking to make sure each record contains 117 data points 
                # i.e. $content[0][117] should not exist.
                if(!isset($content[0][116]) || isset($content[0][117])) {
                    #throw new Exception("Input data does not match expected input data. Please verify this is survey data.", 1);
                     $submit_message = '<font color="red">Error uploading the file '. basename( $_FILES["surveyfile"]["name"]). ' - Input data does not match expected input data.<br/>'.
                     'Please verify this is survey data.</font>';
                }   else    {

                    # Save the original file in case something goes wrong and the user is not alerted:
                    $target_file = $target_dir . $newFileName;

                    if (move_uploaded_file($_FILES["surveyfile"]["tmp_name"], $target_file)) {
                        $submit_message = "The file ". basename( $_FILES["surveyfile"]["name"]). " has been uploaded.<br/><br/>";
                    } else {
                        $submit_message = '<font color="red">Sorry, there was an error uploading your file.</font><br/><br/>';
                    }

                    # Create query string variable
                    $queryStr = "";
                    $records_dups= 0;

                    #start first loop, start at 1 to skip the headers
                    for($k=1;$k < (count($content)-1);$k++)  {
                    # each record contains 117 records

                    # Postgres does not handle functions with more than 100 arguments, building insert/update here:
                        # Check to see if the barcode already exists, index $content[x][7]
                        $result = pg_query("select count(*) from survey where barcode = '".$content[$k][7]."';");
                        if($result) {
                            $rows = pg_fetch_array( $result );
                            #if record exists, set flag chekRec;
                            $chekRec = $rows['count'];
                            error_log ('Duplicate ID - '.$content[$k][7]);
                        }   else    {
                            # record does not exist, explicitly lower flag chekRec
                            $chekRec = 0;
                        }

                        # If there is not a record with this barcode then create it
                        if($chekRec < 1)    {
                            # Loop through the second dimension of the arrray to  get the values and build the query string.
                            for($j=0;$j < 94;++$j) {
                                    $content[$k][$j] = str_replace("'","",$content[$k][$j]);
                                    if ($j!=35) {//don't load maiden name
                                        $queryStr .= "'".$content[$k][$j]."',";
                                    }
                            }
                            //echo str_replace ("''","NULL","'','TEST'");
                            $queryStr = str_replace("''","NULL",$queryStr);
                            $queryStr = rtrim($queryStr,',');
                            # Insert raw data into the import_sanned_surv_data table
                             if(!pg_query("INSERT INTO import_scanned_surv_data(time_stamp,verify_ws,form_id,batch_num,batch_dir,bat_pg_no,".
                                "bat_pg_cnt, barcode,ex_rtn_scrn,ex_phx_plp, ex_phx_cca, ex_fhx_plp, ex_phc_crohn, ex_fhx_cca, ex_sympt,".
                                "ex_phx_uc,ex_oth, uc_age_dx,crohn_age_dx, prep_typ, prev_colo,pcr_allneg, pcr_polyp,pcr_cca,pcr_roids,".
                                "pcr_dvt,pcr_oth,pcr_rectalca, ps_allneg,ps_polyp, ps_cca, ps_roids, ps_dvt, ps_oth, ps_rectalca,".
                                "ca_mom, ca_dad, ca_sis, ca_bro, ca_kid, rb450_bro,rb450_mom,rb450_dk, rb450_sis,rb450_dad,".
                                "rb450_kid,rgt50_bro,rgt50_mom,rgt50_dk, rgt50_sis,rgt50_dad,rgt50_child,colon_plp,fam_colon_plp,".
                                "fap,lynch_synd, ibs,oth_ca, oth_ca_fam, aspirin,asp_duration, coumadin, vitamins, otc_anti_infl, ".
                                "otc_ai_duration,health, smokev, smokyrs,smoknum,alconum,exercise, height_ft,height_in,weight_now,".
                                "weight_20,ins_mcare,ins_mcaid,ins_priv, ins_hmo,ins_unsure, ins_none, ins_oth,hispanic, race_white,".
                                "race_black, race_asain, race_pac_isl, race_amind, race_oth, education,marital_status, birth_state,foriegn_born".
                                ")VALUES (".$queryStr.")"))   {
                                 error_log ('queryStr - '.$queryStr);
                                throw new Exception(pg_last_error($conn));
                            }
                            # reset the query string
                            $queryStr = '';

                            # Insert modified data into the survey table. Modifications based on the 4D code file \\biodev5.dartmouth.edu\wwwroot\biodev5\nhcr2\4DProcs\add_scanned_surv_data.txt
                            if(!pg_query("select insert_scanned_survey('".$content[$k][7]."');"))    {
                                throw new Exception(pg_last_error($conn));
                            }
                            $records_num = $k;
                    } else {
                            # The record already exists
                            $records_dups = $records_dups + 1;
                    }
                }
                    if (!pg_query("select import_scanned_surv_data('".$current_date."','".$fileName."',".$records_dups.");")) {
                                throw new Exception(pg_last_error($conn));
                    }
                    $records_num = isset($records_num)?$records_num:0;
                    $submit_message .= "Survey Import Successful! ".$records_num." records imported! <br/><br/>";
                }
            }
        } catch(Exception $e)    {
             $submit_message = '<font color="red">DATABASE EXCEPTION ERROR: '.$e->getMessage().' on line:'.$e->getLine().'<br/> Please report this error to the administrator.</font>';
        }
    }  else    if($confirm_submit == 'Upload Procedure Data')  {
    #       PROCEDURE UPLOAD SECTION                           #
        # All code is written knowing that each file has record headers as the first line and records of data on each following line.
        # The headers and values are separated by tabs. So it is known that the file must be parsed by end of line characters and then
        # parsed by tab.


        # check for errors with the upload
        try{
            if ($_FILES["procedurefile"]["error"] > 0)      {
                #throw new Exception("Return Code: " . $_FILES["procedurefile"]["error"] . "<br>");
                $submit_message = '<font color="red">Error uploading the file '. basename( $_FILES["surveyfile"]["name"]). ' - File does not exist or is invalid.<br/>';
            }      else      {
                # no errors, get information about the file
                $fileName = $_FILES['procedurefile']['name'];        # get the file name
                $tmpName  = $_FILES['procedurefile']['tmp_name'];    # get the temperary file name created by the server
                $fileSize = $_FILES['procedurefile']['size'];        # get the size of the file
                $fileType = $_FILES['procedurefile']['type'];        # get the type of the file i.e. txt
                $fileExt  = pathinfo($_FILES["procedurefile"]["name"],PATHINFO_EXTENSION); # get the file extension i.e. txt, png, ect.
                $target_dir = "/var/www/html/nhcr2/data/";                            # directory where file will be saved;

                # create the new name of the file in the format of survey<datetime>(<origianlName).txt
                $newFileName = "procedure".date("mdYHis")."(".basename( $_FILES["procedurefile"]["name"],".".$fileExt).").". $fileExt;

                # Open uploaded file
                $fp = fopen($tmpName, 'rb');

                # Create variables for converting contents into an array
                $content = array();
                $contentLine = array();
                $contentStr = '';

                # Read the contents of the file into a string.
                # When working on a Windows server running PHP this is the best way to get the file read from the temperary location.
                if (!feof($fp)) {
                  $contentStr = fread($fp, filesize($tmpName));
                }

                # Parse the records (each new line is a new record) into an array, the PHP_EOL is a keyword that looks for the End Of Line (EOL)
                $contentLine = explode(PHP_EOL,$contentStr);

                # Parse each record so the values are in the second dimension of the array i.e. $content[0][0] is the first value of the first record
                $counter = 0;
                foreach ( $contentLine as $line)    {
                    $content[$counter] = explode("\t", $line);
                    $counter +=1;
                }

                fclose($fp);

                 if(!isset($content[0][227]) || isset($content[0][228])) {
                    #throw new Exception("Input data does not match expected input data. Please verify this is survey data.", 1);
                     $submit_message = '<font color="red">Error uploading the file '. basename( $_FILES["procedurefile"]["name"]). ' - Input data does not match expected input data.<br/>'.
                     'Please verify this is procedure data.</font>';
                }   else    {

                    # Save the original file in case something goes wrong and the user is not alerted:
                    $target_file = $target_dir . $newFileName;

                    if (move_uploaded_file($_FILES["procedurefile"]["tmp_name"], $target_file)) {
                       $submit_message = "The file ". basename( $_FILES["procedurefile"]["name"]). " has been uploaded. <br/><br/>";
                    } else {
                        $submit_message =  '<font color="red">Sorry, there was an error uploading your file.</font><br/><br/>';
                    }
                    #Create query string vriable
                    $queryStr = "";
                    $records_num = 0;
                    $records_dups= 0;
                    #start first loop, start at 1 to skip the headers
                    for($k=1;$k < (count($content)-1);$k++)  {
                    # each record contains 228 records

                    # Postgres does not handle functions with more than 100 arguments, building insert/update here:
                        # Check to see if the barcode already exists, index $content[x][7]
                        $result = pg_query("select count(*) from colo where barcode = '".$content[$k][204]."';");
                        if($result) {
                            $rows = pg_fetch_array( $result );
                            #if record exists, set flag chekRec;
                            $chekRec = $rows['count'];
                            error_log ('Duplicate ID - '.$content[$k][204]);
                        }   else    {
                            # record does not exist, explicitly lower flag chekRec
                            $chekRec = 0;
                        }

                        # Create variables for values that are going to be modified based on the 4D code file \\biodev5.dartmouth.edu\wwwroot\biodev5\nhcr2\4DProcs\add_scanned_surv_data.txt
                        # These modifications will take place regardless of whether the data is being inserted or updated.

                        $indscrnosym = $content[$k][7];
                        $inddiag = $content[$k][18];
                        $find_norm = $content[$k][32];
                        $find_polyp = $content[$k][33];
                        $polyp_loc_a = $content[$k][34];
                        $polyp_loc_b = $content[$k][35];
                        $polyp_loc_c = $content[$k][36];
                        $polyp_loc_d = $content[$k][37];
                        $polyp_loc_e = $content[$k][38];
                        $polyp_loc_f = $content[$k][39];
                        $polyp_loc_g = $content[$k][40];
                        $polyp_size_a = $content[$k][41];
                        $polyp_size_b = $content[$k][42];
                        $polyp_size_c = $content[$k][43];
                        $polyp_size_d = $content[$k][44];
                        $polyp_size_e = $content[$k][45];
                        $polyp_size_f = $content[$k][46];
                        $polyp_size_g = $content[$k][47];
                        $cal_ce = $content[$k][137];
                        $cal_ac = $content[$k][138];
                        $cal_hf = $content[$k][139];
                        $cal_tc = $content[$k][140];
                        $cal_sf = $content[$k][141];
                        $cal_dc = $content[$k][142];
                        $cal_sg = $content[$k][143];
                        $cal_re = $content[$k][144];
                        $cal_u = $content[$k][145];
                        $cal_ti = $content[$k][136];
                        $cas_lt5mm = $content[$k][146];
                        $cas_5t9mm = $content[$k][147];
                        $cas_1t2cm = $content[$k][148];
                        $cas_gt2cm = $content[$k][149];

                        # Make all modifications based on the 4D code file.
                        if($indscrnosym == 9) { $ind_scr_nosym = 0; } else { $ind_scr_nosym = $indscrnosym; }
                        if($inddiag == 9) { $inddiag = 0; } else { $inddiag = $inddiag; }
                        if($find_norm == 1) { $find_norm = 1; } else { $find_norm = 0; }
                        if($find_polyp == 1) { $find_polyp = 1; } else { $find_polyp = 0; }

                        if($polyp_loc_a == "pl_ti_a") { $polyp_loc_a = "TI"; } else  if($polyp_loc_a == "pl_ce_a") { $polyp_loc_a = "CE"; } else if($polyp_loc_a == "pl_ac_a") { $polyp_loc_a = "AC"; } else if($polyp_loc_a == "pl_hf_a") { $polyp_loc_a = "HF"; } else if($polyp_loc_a == "pl_tc_a") { $polyp_loc_a = "TC"; } else if($polyp_loc_a == "pl_sf_a") { $polyp_loc_a = "SF"; } else if($polyp_loc_a == "pl_dc_a") { $polyp_loc_a = "DC"; } else if($polyp_loc_a == "pl_sg_a") { $polyp_loc_a = "SG"; } else if($polyp_loc_a == "pl_re_a") { $polyp_loc_a = "RE"; } else if($polyp_loc_a == "pl_u_a") { $polyp_loc_a = "U"; } else { $polyp_loc_a = "99"; }
                        if($polyp_loc_b == "pl_ti_b") { $polyp_loc_b = "TI"; } else  if($polyp_loc_b == "pl_ce_b") { $polyp_loc_b = "CE"; } else if($polyp_loc_b == "pl_ac_b") { $polyp_loc_b = "AC"; } else if($polyp_loc_b == "pl_hf_b") { $polyp_loc_b = "HF"; } else if($polyp_loc_b == "pl_tc_b") { $polyp_loc_b = "TC"; } else if($polyp_loc_b == "pl_sf_b") { $polyp_loc_b = "SF"; } else if($polyp_loc_b == "pl_dc_b") { $polyp_loc_b = "DC"; } else if($polyp_loc_b == "pl_sg_b") { $polyp_loc_b = "SG"; } else if($polyp_loc_b == "pl_re_b") { $polyp_loc_b = "RE"; } else if($polyp_loc_b == "pl_u_b") { $polyp_loc_b = "U"; } else { $polyp_loc_b = "99"; }
                        if($polyp_loc_c == "pl_ti_c") { $polyp_loc_c = "TI"; } else  if($polyp_loc_c == "pl_ce_c") { $polyp_loc_c = "CE"; } else if($polyp_loc_c == "pl_ac_c") { $polyp_loc_c = "AC"; } else if($polyp_loc_c == "pl_hf_c") { $polyp_loc_c = "HF"; } else if($polyp_loc_c == "pl_tc_c") { $polyp_loc_c = "TC"; } else if($polyp_loc_c == "pl_sf_c") { $polyp_loc_c = "SF"; } else if($polyp_loc_c == "pl_dc_c") { $polyp_loc_c = "DC"; } else if($polyp_loc_c == "pl_sg_c") { $polyp_loc_c = "SG"; } else if($polyp_loc_c == "pl_re_c") { $polyp_loc_c = "RE"; } else if($polyp_loc_c == "pl_u_c") { $polyp_loc_c = "U"; } else { $polyp_loc_c = "99"; }
                        if($polyp_loc_d == "pl_ti_d") { $polyp_loc_d = "TI"; } else  if($polyp_loc_d == "pl_ce_d") { $polyp_loc_d = "CE"; } else if($polyp_loc_d == "pl_ac_d") { $polyp_loc_d = "AC"; } else if($polyp_loc_d == "pl_hf_d") { $polyp_loc_d = "HF"; } else if($polyp_loc_d == "pl_tc_d") { $polyp_loc_d = "TC"; } else if($polyp_loc_d == "pl_sf_d") { $polyp_loc_d = "SF"; } else if($polyp_loc_d == "pl_dc_d") { $polyp_loc_d = "DC"; } else if($polyp_loc_d == "pl_sg_d") { $polyp_loc_d = "SG"; } else if($polyp_loc_d == "pl_re_d") { $polyp_loc_d = "RE"; } else if($polyp_loc_d == "pl_u_d") { $polyp_loc_d = "U"; } else { $polyp_loc_d = "99"; }
                        if($polyp_loc_e == "pl_ti_e") { $polyp_loc_e = "TI"; } else  if($polyp_loc_e == "pl_ce_e") { $polyp_loc_e = "CE"; } else if($polyp_loc_e == "pl_ac_e") { $polyp_loc_e = "AC"; } else if($polyp_loc_e == "pl_hf_e") { $polyp_loc_e = "HF"; } else if($polyp_loc_e == "pl_tc_e") { $polyp_loc_e = "TC"; } else if($polyp_loc_e == "pl_sf_e") { $polyp_loc_e = "SF"; } else if($polyp_loc_e == "pl_dc_e") { $polyp_loc_e = "DC"; } else if($polyp_loc_e == "pl_sg_e") { $polyp_loc_e = "SG"; } else if($polyp_loc_e == "pl_re_e") { $polyp_loc_e = "RE"; } else if($polyp_loc_e == "pl_u_e") { $polyp_loc_e = "U"; } else { $polyp_loc_e = "99"; }
                        if($polyp_loc_f == "pl_ti_f") { $polyp_loc_f = "TI"; } else  if($polyp_loc_f == "pl_ce_f") { $polyp_loc_f = "CE"; } else if($polyp_loc_f == "pl_ac_f") { $polyp_loc_f = "AC"; } else if($polyp_loc_f == "pl_hf_f") { $polyp_loc_f = "HF"; } else if($polyp_loc_f == "pl_tc_f") { $polyp_loc_f = "TC"; } else if($polyp_loc_f == "pl_sf_f") { $polyp_loc_f = "SF"; } else if($polyp_loc_f == "pl_dc_f") { $polyp_loc_f = "DC"; } else if($polyp_loc_f == "pl_sg_f") { $polyp_loc_f = "SG"; } else if($polyp_loc_f == "pl_re_f") { $polyp_loc_f = "RE"; } else if($polyp_loc_f == "pl_u_f") { $polyp_loc_f = "U"; } else { $polyp_loc_f = "99"; }
                        if($polyp_loc_g == "pl_ti_g") { $polyp_loc_g = "TI"; } else  if($polyp_loc_g == "pl_ce_g") { $polyp_loc_g = "CE"; } else if($polyp_loc_g == "pl_ac_g") { $polyp_loc_g = "AC"; } else if($polyp_loc_g == "pl_hf_g") { $polyp_loc_g = "HF"; } else if($polyp_loc_g == "pl_tc_g") { $polyp_loc_g = "TC"; } else if($polyp_loc_g == "pl_sf_g") { $polyp_loc_g = "SF"; } else if($polyp_loc_g == "pl_dc_g") { $polyp_loc_g = "DC"; } else if($polyp_loc_g == "pl_sg_g") { $polyp_loc_g = "SG"; } else if($polyp_loc_g == "pl_re_g") { $polyp_loc_g = "RE"; } else if($polyp_loc_g == "pl_u_g") { $polyp_loc_g = "U"; } else { $polyp_loc_g = "99"; }

                        $p_flat_a = "0";
                        $p_flat_b = "0";
                        $p_flat_c = "0";
                        $p_flat_d = "0";
                        $p_flat_e = "0";
                        $p_flat_f = "0";
                        $p_flat_g = "0";

                        if($polyp_size_a == "ps_fp_a") { $polyp_size_a = "01"; $p_flat_a = "1"; } else  if($polyp_size_a == "ps_lt5mm_a") { $polyp_size_a = "02"; } else if($polyp_size_a == "ps_5t9mm_a") { $polyp_size_a = "03"; } else if($polyp_size_a == "ps_1t2cm_a") { $polyp_size_a = "04"; } else if($polyp_size_a == "ps_gt2cm_a") { $polyp_size_a = "05"; } else { $polyp_size_a = "99"; }
                        if($polyp_size_b == "ps_fp_b") { $polyp_size_b = "01"; $p_flat_b = "1"; } else  if($polyp_size_b == "ps_lt5mm_b") { $polyp_size_b = "02"; } else if($polyp_size_b == "ps_5t9mm_b") { $polyp_size_b = "03"; } else if($polyp_size_b == "ps_1t2cm_b") { $polyp_size_b = "04"; } else if($polyp_size_b == "ps_gt2cm_b") { $polyp_size_b = "05"; } else { $polyp_size_b = "99"; }
                        if($polyp_size_c == "ps_fp_c") { $polyp_size_c = "01"; $p_flat_c = "1"; } else  if($polyp_size_c == "ps_lt5mm_c") { $polyp_size_c = "02"; } else if($polyp_size_c == "ps_5t9mm_c") { $polyp_size_c = "03"; } else if($polyp_size_c == "ps_1t2cm_c") { $polyp_size_c = "04"; } else if($polyp_size_c == "ps_gt2cm_c") { $polyp_size_c = "05"; } else { $polyp_size_c = "99"; }
                        if($polyp_size_d == "ps_fp_d") { $polyp_size_d = "01"; $p_flat_d = "1"; } else  if($polyp_size_d == "ps_lt5mm_d") { $polyp_size_d = "02"; } else if($polyp_size_d == "ps_5t9mm_d") { $polyp_size_d = "03"; } else if($polyp_size_d == "ps_1t2cm_d") { $polyp_size_d = "04"; } else if($polyp_size_d == "ps_gt2cm_d") { $polyp_size_d = "05"; } else { $polyp_size_d = "99"; }
                        if($polyp_size_e == "ps_fp_e") { $polyp_size_e = "01"; $p_flat_e = "1"; } else  if($polyp_size_e == "ps_lt5mm_e") { $polyp_size_e = "02"; } else if($polyp_size_e == "ps_5t9mm_e") { $polyp_size_e = "03"; } else if($polyp_size_e == "ps_1t2cm_e") { $polyp_size_e = "04"; } else if($polyp_size_e == "ps_gt2cm_e") { $polyp_size_e = "05"; } else { $polyp_size_e = "99"; }
                        if($polyp_size_f == "ps_fp_f") { $polyp_size_f = "01"; $p_flat_f = "1"; } else  if($polyp_size_f == "ps_lt5mm_f") { $polyp_size_f = "02"; } else if($polyp_size_f == "ps_5t9mm_f") { $polyp_size_f = "03"; } else if($polyp_size_f == "ps_1t2cm_f") { $polyp_size_f = "04"; } else if($polyp_size_f == "ps_gt2cm_f") { $polyp_size_f = "05"; } else { $polyp_size_f = "99"; }
                        if($polyp_size_g == "ps_fp_g") { $polyp_size_g = "01"; $p_flat_g = "1"; } else  if($polyp_size_g == "ps_lt5mm_g") { $polyp_size_g = "02"; } else if($polyp_size_g == "ps_5t9mm_g") { $polyp_size_g = "03"; } else if($polyp_size_g == "ps_1t2cm_g") { $polyp_size_g = "04"; } else if($polyp_size_g == "ps_gt2cm_g") { $polyp_size_g = "05"; } else { $polyp_size_g = "99"; }

                        if($cal_ce == "1") { $susp_ca_loc = "1"; } else  if($cal_ac == "1") { $susp_ca_loc = "2"; } else if($cal_hf == "1") { $susp_ca_loc = "3"; } else if($cal_tc == "1") { $susp_ca_loc = "4"; } else if($cal_sf == "1") { $susp_ca_loc = "5"; } else if($cal_dc == "1") { $susp_ca_loc = "6"; } else if($cal_sg == "1") { $susp_ca_loc = "7"; } else if($cal_re == "1") { $susp_ca_loc = "8"; } else if($cal_u == "1") { $susp_ca_loc = "9"; } else  if($cal_ti == "1") { $susp_ca_loc = "10"; } else { $susp_ca_loc = "99"; }

                        if($cas_1t2cm == "1") { $susp_ca_siz="3"; } else if($cas_5t9mm == "1") { $susp_ca_siz = "2"; } else if($cas_gt2cm == "1") { $susp_ca_siz = "4"; } else if($cas_lt5mm == "1") { $susp_ca_siz="1"; } else { $susp_ca_siz="99"; }

                        #check output....
                        # echo $ind_scr_nosym." - ".$inddiag." - ".$find_norm." - ".$find_polyp." - ".$polyp_loc_a." - ". $polyp_loc_b." - ". $polyp_loc_c." - ". $polyp_loc_d." - ". $polyp_loc_e." - ". $polyp_loc_f." - ". $polyp_loc_g." - ".$polyp_size_a." - ".$polyp_size_b." - ".$polyp_size_c." - ".$polyp_size_d." - ".$polyp_size_e." - ".$polyp_size_f." - ".$polyp_size_g." - ".$susp_ca_loc." - ".$susp_ca_siz;

                        # If there is not a record with this barcode then create it
                        if($chekRec < 1)    {
                            # Loop through the second dimension of the arrray to  get the values and build the query string.
                            for($j=0;$j < (count($content[$k]));++$j) {
                                $queryStr .= "'".$content[$k][$j]."',";
                            }
                            $queryStr=substr($queryStr,0,strlen($queryStr)-1); #remove the final comma
                            $queryStr = str_replace("''","NULL",$queryStr);
                            # The record does not exist, insert the raw data into the import_scanned_proc_data table.
                            if(!pg_query("INSERT INTO import_scanned_proc_data(time_stamp,verify_wks,form_id,bat_no,bat_dir,batchpgno,batchpgcnt,".
                            "ind_scr_nosym,fhxcc,fhxplp,phxcc,phxplp,fhnpcc,ibd,isfhcc,ibdt_uc,ibdt_crohn,ibdt_ind,inddiag,bleed,cbh_diar,cbh_cons,".
                            "elim_ibd,biop_sus_ca,pos_fobt,abn_tst,plpt_plp,ida,oth,dea_ctc,dea_bar_en,dea_oth,find_norm,find_polyp,polyp_loc_a,".
                            "polyp_loc_b,polyp_loc_c,polyp_loc_d,polyp_loc_e,polyp_loc_f,polyp_loc_g,polyp_siz_a,polyp_siz_b,polyp_siz_c,polyp_siz_d,".
                            "polyp_siz_e,polyp_siz_f,polyp_siz_g,pt_cb_a,pt_hb_a,pt_hs_a,pt_cs_a,pt_pme_a,pt_pe_a,pt_nr_a,pt_lo_a,pt_o_a,pt_cb_b,".
                            "pt_hb_b,pt_hs_b,pt_cs_b,pt_pme_b,pt_pe_b,pt_nr_b,pt_lo_b,pt_o_b,pt_cb_c,pt_hb_c,pt_hs_c,pt_cs_c,pt_pme_c,pt_pe_c,pt_nr_c,".
                            "pt_lo_c,pt_o_c,pt_cb_d,pt_hb_d,pt_hs_d,pt_cs_d,pt_pme_d,pt_pe_d,pt_nr_d,pt_lo_d,pt_o_d,pt_cb_e,pt_hb_e,pt_hs_e,pt_cs_e,".
                            "pt_pme_e,pt_pe_e,pt_nr_e,pt_lo_e,pt_o_e,pt_cb_f,pt_hb_f,pt_hs_f,pt_cs_f,pt_pme_f,pt_pe_f,pt_nr_f,pt_lo_f,pt_o_f,pt_cb_g,".
                            "pt_hb_g,pt_hs_g,pt_cs_g,pt_pme_g,pt_pe_g,pt_nr_g,pt_lo_g,pt_o_g,addl_plp,allpolprem,find_ca,find_crohns,cr_ti,cr_ce,cr_ac,".
                            "cr_hf,cr_tc,cr_sf,cr_dc,cr_sg,cr_re,cr_u,find_uc,uc_ti,uc_ce,uc_ac,uc_hf,uc_tc,uc_sf,uc_dc,uc_sg,uc_re,uc_u,cal_ti,cal_ce,".
                            "cal_ac,cal_hf,cal_tc,cal_sf,cal_dc,cal_sg,cal_re,cal_u,cas_lt5mm,cas_5t9mm,cas_1t2cm,cas_gt2cm,cat_cb,cat_hb,cat_hs,cat_cs,".
                            "cat_pme,cat_pe,cat_nr,cat_lo,cat_o,find_oth,o_oth,o_bmc,o_bop,o_br,preparation,prep_typ,meds_used_versed,meds_used_demerol,".
                            "meds_used_fentanyl,meds_used_propofol,meds_used_other,meds_used_none,end_proc_stat,pa_pp,pa_sed_prob,pa_obs,pa_oth,pa_tc,".
                            "wthdrwl_time,cpml_none,cpml_bleed,cpml_perf,cpml_cardio,cpml_other,cpml_resp_arr,fr_lt1,fr_2t3,fr_bar_en,fr_oth,fr_surg,".
                            "fr_pnd_pth,fr_4t5,fr_6t9,fr_10,fr_gt10,fr_nfsi,fr_fup_pcp,fr_ctc,fr_rp,f_reas_cur_ex,f_reas_fam_hist,f_reas_ibd,f_reas_oth,".
                            "f_reas_pershx,barcode,person_id,not_used13,not_used14,not_used15,not_used16,not_used17,not_used18,not_used19,not_used20,event_date,".
                            "cprs_batch_id,not_used1, not_used2,not_used3,not_used4,not_used5,not_used6,not_used7,not_used8,not_used9,not_used10,not_used11,".
                            "not_used12)VALUES (".$queryStr.")"))    {
                                throw new Exception(pg_last_error($conn));
                            }
                            #reset query string
                            $queryStr = '';
                            
                            # Insert data into the colo table based on modifications from the 4D code file \\biodev5.dartmouth.edu\wwwroot\biodev5\nhcr2\4DProcs\add_scanned_surv_data.txt
                            if(!pg_query("INSERT INTO colo(abort_reas_obs,abort_reas_oth,abort_reas_pp,abort_reas_sedprob,abort_reas_tc,addl_polyp,".
                            "all_plps_rem,barcode,comp_bleed,comp_cardio,comp_none,comp_oth,comp_perf,comp_resparr,dex_abn_test,".
                            "dex_abn_tst_bar_en,dex_abn_tst_ctc,dex_abn_tst_oth,dex_biop,dex_bleed,dex_cbh_diar,dex_cbh_cons,dex_elim_ibd,dex_fobt,dex_ida,dex_oth,dex_plpect_plp,".
                            "end_proc_stat_rr,find_other,find_oth_biop,find_oth_bmc,find_oth_ibd,find_oth_other,fnd_norm_ex,fnd_plp,fup_10,fup_1t3,fup_2t3,fup_4t5,fup_6t10,fup_6t9,".
                            "fup_baren,fup_ctc,fup_gt10,fup_lt1,fup_nfsi,fup_othproc,fup_pcp,fup_pp,fup_rwp,fup_surgcons,f_reas_curex,f_reas_famhx,f_reas_ibd,".
                            "f_reas_oth,f_reas_perhx,ibdtyp_ind,ibdtyp_uc,ibdtyp_crohn,ind_diag_exam,ind_scr_fhxcc,ind_scr_fhxcc_fdr,ind_scr_fhxplp,ind_scr_nosym,".
                            "ind_sur_fhnpcc,ind_sur_ibd,ind_sur_phxcc,ind_sur_phxplp,meds_used_demerol,meds_used_fentanyl,meds_used_none,meds_used_other,".
                            "meds_used_propofol,meds_used_versed,prep,prep_type,pt_cb_a,pt_hb_a,pt_hs_a,pt_cs_a,pt_pme_a,pt_pe_a,pt_nr_a,pt_lo_a,".
                            "pt_o_a,pt_cb_b,pt_hb_b,pt_hs_b,pt_cs_b,pt_pme_b,pt_pe_b,pt_nr_b,pt_lo_b,pt_o_b,pt_cb_c,pt_hb_c,pt_hs_c,pt_cs_c,pt_pme_c,pt_pe_c,".
                            "pt_nr_c,pt_lo_c,pt_o_c,pt_cb_d,pt_hb_d,pt_hs_d,pt_cs_d,pt_pme_d,pt_pe_d,pt_nr_d,pt_lo_d,pt_o_d,pt_cb_e,pt_hb_e,pt_hs_e,pt_cs_e,".
                            "pt_pme_e,pt_pe_e,pt_nr_e,pt_lo_e,pt_o_e,pt_cb_f,pt_hb_f,pt_hs_f,pt_cs_f,pt_pme_f,pt_pe_f,pt_nr_f,pt_lo_f,pt_o_f,pt_cb_g,pt_hb_g,".
                            "pt_hs_g,pt_cs_g,pt_pme_g,pt_pe_g,pt_nr_g,pt_lo_g,pt_o_g,p_loc_a,p_loc_b,p_loc_c,p_loc_d,p_loc_e,p_loc_f,p_loc_g,p_loc_h,p_loc_i,".
                            "p_loc_j,p_siz_a,p_siz_b,p_siz_c,p_siz_d,p_siz_e,p_siz_f,p_siz_g,p_siz_h,p_siz_i,p_siz_j,scan_batch,susp_ca,susp_ca_loc,susp_ca_siz,".
                            "susp_ca_trt_cb,susp_ca_trt_cs,susp_ca_trt_hb,susp_ca_trt_hs,susp_crohns,su_cr_loc_ti,su_cr_loc_ce,su_cr_loc_ac,su_cr_loc_hf,su_cr_loc_tc,su_cr_loc_sf,".
                            "su_cr_loc_dc,su_cr_loc_sg,su_cr_loc_re,su_cr_loc_u,su_uc_loc_ti,su_uc_loc_ce,su_uc_loc_ac,su_uc_loc_hf,su_uc_loc_tc,su_uc_loc_sf,".
                            "su_uc_loc_dc,su_uc_loc_sg,su_uc_loc_re,su_uc_loc_u,susp_UC,teleform_formid,wthdrwl_time, p_flat_a, p_flat_b, p_flat_c,".
                            "p_flat_d, p_flat_e, p_flat_f, p_flat_g, susp_ca_trt_lo,susp_ca_trt_nr,susp_ca_trt_o,susp_ca_trt_pe,susp_ca_trt_pme) VALUES ('".$content[$k][175]."',".
                            "'".$content[$k][176]."','".$content[$k][173]."','".$content[$k][174]."','".$content[$k][177]."','".$content[$k][111]."',".
                            "'".$content[$k][112]."','".$content[$k][204]."','".$content[$k][180]."','".$content[$k][182]."','".$content[$k][179]."',".
                            "'".$content[$k][183]."','".$content[$k][181]."','".$content[$k][184]."',".
                            "'".$content[$k][25]."','".$content[$k][30]."','".$content[$k][29]."','".$content[$k][31]."','".$content[$k][23]."',".
                            "'".$content[$k][19]."','".$content[$k][20]."','".$content[$k][21]."','".$content[$k][22]."','".$content[$k][24]."','".$content[$k][27]."','".$content[$k][28]."',".
                            "'".$content[$k][26]."','".$content[$k][172]."','".$content[$k][159]."','".$content[$k][162]."',".
                            "'".$content[$k][161]."','".$content[$k][163]."','".$content[$k][160]."','".$find_norm."','".$find_polyp."',".
                            "'".$content[$k][193]."','0','".$content[$k][186]."','".$content[$k][191]."','0','".$content[$k][192]."',".
                            "'".$content[$k][187]."','".$content[$k][197]."','".$content[$k][194]."','".$content[$k][185]."','".$content[$k][195]."',".
                            "'".$content[$k][188]."','".$content[$k][196]."','".$content[$k][190]."','".$content[$k][198]."','".$content[$k][189]."',".
                            "'".$content[$k][199]."','".$content[$k][200]."','".$content[$k][201]."','".$content[$k][202]."','".$content[$k][203]."',".
                            "'".$content[$k][17]."','".$content[$k][15]."','".$content[$k][16]."','".$inddiag."','".$content[$k][8]."',".
                            "'".$content[$k][14]."','".$content[$k][9]."','".$ind_scr_nosym."','".$content[$k][12]."','".$content[$k][13]."',".
                            "'".$content[$k][10]."','".$content[$k][11]."','".$content[$k][167]."','".$content[$k][168]."','".$content[$k][171]."',".
                            "'".$content[$k][170]."','".$content[$k][169]."','".$content[$k][166]."','".$content[$k][164]."',".
                            "'".$content[$k][165]."','".$content[$k][48]."','".$content[$k][49]."','".$content[$k][50]."','".$content[$k][51]."',".
                            "'".$content[$k][52]."','".$content[$k][53]."','".$content[$k][54]."','".$content[$k][55]."','".$content[$k][56]."',".
                            "'".$content[$k][57]."','".$content[$k][58]."','".$content[$k][59]."','".$content[$k][60]."','".$content[$k][61]."',".
                            "'".$content[$k][62]."','".$content[$k][63]."','".$content[$k][64]."','".$content[$k][65]."','".$content[$k][66]."',".
                            "'".$content[$k][67]."','".$content[$k][68]."','".$content[$k][69]."','".$content[$k][70]."','".$content[$k][71]."',".
                            "'".$content[$k][72]."','".$content[$k][73]."','".$content[$k][74]."','".$content[$k][75]."','".$content[$k][76]."',".
                            "'".$content[$k][77]."','".$content[$k][78]."','".$content[$k][79]."','".$content[$k][80]."','".$content[$k][81]."',".
                            "'".$content[$k][82]."','".$content[$k][83]."','".$content[$k][84]."','".$content[$k][85]."','".$content[$k][86]."',".
                            "'".$content[$k][87]."','".$content[$k][88]."','".$content[$k][89]."','".$content[$k][90]."','".$content[$k][91]."',".
                            "'".$content[$k][92]."','".$content[$k][93]."','".$content[$k][94]."','".$content[$k][95]."','".$content[$k][96]."',".
                            "'".$content[$k][97]."','".$content[$k][98]."','".$content[$k][99]."','".$content[$k][100]."','".$content[$k][101]."',".
                            "'".$content[$k][102]."','".$content[$k][103]."','".$content[$k][104]."','".$content[$k][105]."','".$content[$k][106]."',".
                            "'".$content[$k][107]."','".$content[$k][108]."','".$content[$k][109]."','".$content[$k][110]."','".$polyp_loc_a."',".
                            "'".$polyp_loc_b."','".$polyp_loc_c."','".$polyp_loc_d."','".$polyp_loc_e."','".$polyp_loc_f."','".$polyp_loc_g."',".
                            "'99','99','99','".$polyp_size_a."','".$polyp_size_b."','".$polyp_size_c."','".$polyp_size_d."','".$polyp_size_e."',".
                            "'".$polyp_size_f."','".$polyp_size_g."','99','99','99','".$content[$k][3]."','".$content[$k][113]."','".$susp_ca_loc."',".
                            "'".$susp_ca_siz."','".$content[$k][150]."','".$content[$k][153]."','".$content[$k][151]."','".$content[$k][152]."','".$content[$k][114]."',".
                            "'".$content[$k][115]."','".$content[$k][123]."','".$content[$k][117]."','".$content[$k][118]."','".$content[$k][119]."',".
                            "'".$content[$k][120]."','".$content[$k][121]."','".$content[$k][122]."','".$content[$k][123]."','".$content[$k][124]."',".
                            "'".$content[$k][126]."','".$content[$k][127]."','".$content[$k][128]."','".$content[$k][129]."','".$content[$k][130]."',".
                            "'".$content[$k][131]."','".$content[$k][132]."','".$content[$k][133]."','".$content[$k][134]."','".$content[$k][135]."',".
                            "'".$content[$k][125]."','".$content[$k][2]."','".$content[$k][178]."','".$p_flat_a."','".$p_flat_b."','".$p_flat_c."',".
                            "'".$p_flat_d."','".$p_flat_e."','".$p_flat_f."','".$p_flat_g."','".$content[$k][157]."','".$content[$k][156]."','".$content[$k][158]."',".
                            "'".$content[$k][155]."','".$content[$k][154]."')"))    {
                                throw new Exception(pg_last_error($conn));
                            }
                            $records_num = $records_num + 1;
                        }   else    {
                            # The record already exists
                            $records_dups = $records_dups + 1;
                        }
                    }
                    if (!pg_query("select import_scanned_proc_data('".$current_date."','".$fileName."',".$records_dups.");")) {
                                throw new Exception(pg_last_error($conn));
                    }
                    $result = pg_query("select * from update_findings();");
                    if (!$result) {
                                throw new Exception(pg_last_error($conn));
                    } else {
                        $rows = pg_fetch_assoc( $result );
                        $submit_message2 = $rows['lcl_message'];
                    }
                    $records_num = isset($records_num)?$records_num:0;
                    $submit_message .= "Procedure Import - ".$records_num." records imported - ".$records_dups." duplicates <br/><br/>";
                }
            }
        } catch(Exception $e)    {
             $submit_message = '<font color="red">DATABASE EXCEPTION ERROR: '.$e->getMessage().' on line:'.$e->getLine().'<br/> Please report this error to the administrator.</font>';
        }
    }
}


?>
<!DOCTYPE html>
<head>
<title>Teleform Upload</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="shortcut icon" href="">
</head>
<body >
<?php include("includes/header.php"); ?>
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off" enctype="multipart/form-data">
<div class="container-fluid">
    <h3>Scanned File Upload</h3><br/><br/>
<?php   if(isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    echo '<div class="text-info text-center bg-info h3">'.$submit_message2.'</div>'; 
    } ?>
    <table width="90%" style=" border: 0px;" align="center">
        <tr>
            <td bgcolor="#efefef">
                <div align="center"><h4>Survey Data</h4>
                    <br/>
                    <br/>                
                    <b><input type="file" class="btn btn-lg btn-primary" name="surveyfile" id="surveyfile">
                    <br><br></b>
                </div>                    
                <div class="text-center">
                    <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Upload Survey Data">
                </div>
                <br/>
                <br/>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td bgcolor="#efefef">
                <div align="center"><h4>Procedure/Colo Data</h4>
                    <br/>
                    <br/>
                    <b><input type="file" class="btn btn-lg btn-primary" name="procedurefile" id="procedurefile">
                    <br><br></b>
                </div>
                    
                <div class="text-center">
                    <input type="submit" id="idsub" class="btn btn-primary" name="confirm_submit" value="Upload Procedure Data">
                </div>
                <br/>
                <br/>
            </td>
        </tr>
    </table>



</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/endoscopist.js"></script>
</body>
</html>
<?php
if (isset($conn)) {
        pg_close($conn);
} 
?>