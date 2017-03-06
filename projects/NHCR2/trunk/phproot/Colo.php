<?php
/* Check to see if person accessing this page is logged in.    */
require_once("includes/Project.php");
authenticate();

/* Making the database connection here becuase it is going to be used to load the dropdown menus    */
$conn = connect();

$current_date = date("m/d/Y");
$submit_message = "";
isset($_POST['colo_id'])?$colo_id=$_POST['colo_id']:$colo_id="";


/* see if the page was submitted    */
if (array_key_exists('confirm_submit', $_POST))   {
    foreach ($_POST as $key => $value)    {
          /* assign to var (strip whitespace if 2t an array)    */
          ${$key} = is_array($value) ? $value : trim($value);
    }
    isset($colo_id)?$colo_id :$colo_id ="";
    isset($action_on)?$action_on :$action_on ="";
    isset($action_by )?$action_by  :$action_by  ="";
    isset($record_comment )?$record_comment  :$record_comment  ="";
    isset($inserted_on)?$inserted_on :$inserted_on ="";
    isset($inserted_by )?$inserted_by  :$inserted_by  ="";
    isset($event_id)?$event_id :$event_id ="";
    isset($facility_id )?$facility_id  :$facility_id  ="";
    isset($facility_type )?$facility_type  :$facility_type  ="";
    isset($exam_date)?$exam_date :$exam_date ="";
    isset($teleform_formid )?$teleform_formid  :$teleform_formid  ="";
    isset($crs_batch)?$crs_batch :$crs_batch ="";
    isset($scan_batch)?$scan_batch :$scan_batch ="";
    isset($barcode )?$barcode  :$barcode  ="";
    isset($ind_scr_nosym )?$ind_scr_nosym  :$ind_scr_nosym  ="";
    isset($ind_scr_fhxcc )?$ind_scr_fhxcc  :$ind_scr_fhxcc  ="";
    isset($ind_scr_fhxplp )?$ind_scr_fhxplp  :$ind_scr_fhxplp  ="";
    isset($ind_sur_phxcc )?$ind_sur_phxcc  :$ind_sur_phxcc  ="";
    isset($ind_sur_phxplp )?$ind_sur_phxplp  :$ind_sur_phxplp  ="";
    isset($ind_sur_fhnpcc )?$ind_sur_fhnpcc  :$ind_sur_fhnpcc  ="";
    isset($ind_sur_ibd )?$ind_sur_ibd  :$ind_sur_ibd  ="";
    isset($ibdtyp_uc )?$ibdtyp_uc  :$ibdtyp_uc  ="";
    isset($ibdtyp_crohn )?$ibdtyp_crohn  :$ibdtyp_crohn  ="";
    isset($ibdtyp_ind )?$ibdtyp_ind  :$ibdtyp_ind  ="";
    isset($ind_diag_exam )?$ind_diag_exam  :$ind_diag_exam  ="";
    isset($dex_bleed )?$dex_bleed  :$dex_bleed  ="";
    isset($dex_cbh_diar )?$dex_cbh_diar  :$dex_cbh_diar  ="";
    isset($dex_cbh_cons )?$dex_cbh_cons  :$dex_cbh_cons  ="";
    isset($dex_elim_ibd )?$dex_elim_ibd  :$dex_elim_ibd  ="";
    isset($dex_biop )?$dex_biop  :$dex_biop  ="";
    isset($dex_fobt )?$dex_fobt  :$dex_fobt  ="";
    isset($dex_abn_test )?$dex_abn_test  :$dex_abn_test  ="";
    isset($dex_abn_tst_ctc )?$dex_abn_tst_ctc  :$dex_abn_tst_ctc  ="";
    isset($dex_abn_tst_bar_en )?$dex_abn_tst_bar_en  :$dex_abn_tst_bar_en  ="";
    isset($dex_abn_tst_oth )?$dex_abn_tst_oth  :$dex_abn_tst_oth  ="";
    isset($dex_plpect_plp )?$dex_plpect_plp  :$dex_plpect_plp  ="";
    isset($dex_ida )?$dex_ida  :$dex_ida  ="";
    isset($fnd_norm_ex)?$fnd_norm_ex :$fnd_norm_ex ="";
    isset($fnd_plp)?$fnd_plp :$fnd_plp ="";
    isset($p_loc_a )?$p_loc_a  :$p_loc_a  ="";
    isset($p_loc_b )?$p_loc_b  :$p_loc_b  ="";
    isset($p_loc_c )?$p_loc_c  :$p_loc_c  ="";
    isset($p_loc_d )?$p_loc_d  :$p_loc_d  ="";
    isset($p_loc_e )?$p_loc_e  :$p_loc_e  ="";
    isset($p_loc_f )?$p_loc_f  :$p_loc_f  ="";
    isset($p_loc_g )?$p_loc_g  :$p_loc_g  ="";
    isset($p_loc_h )?$p_loc_h  :$p_loc_h  ="";
    isset($p_loc_i )?$p_loc_i  :$p_loc_i  ="";
    isset($p_loc_j )?$p_loc_j  :$p_loc_j  ="";
    isset($p_siz_a )?$p_siz_a  :$p_siz_a  ="";
    isset($p_siz_b )?$p_siz_b  :$p_siz_b  ="";
    isset($p_siz_c )?$p_siz_c  :$p_siz_c  ="";
    isset($p_siz_d )?$p_siz_d  :$p_siz_d  ="";
    isset($p_siz_e )?$p_siz_e  :$p_siz_e  ="";
    isset($p_siz_f )?$p_siz_f  :$p_siz_f  ="";
    isset($p_siz_g )?$p_siz_g  :$p_siz_g  ="";
    isset($p_siz_h )?$p_siz_h  :$p_siz_h  ="";
    isset($p_siz_i )?$p_siz_i  :$p_siz_i  ="";
    isset($p_siz_j )?$p_siz_j  :$p_siz_j  ="";
    isset($pt_cb_a)?$pt_cb_a :$pt_cb_a ="";
    isset($pt_hb_a)?$pt_hb_a :$pt_hb_a ="";
    isset($pt_hs_a)?$pt_hs_a :$pt_hs_a ="";
    isset($pt_cs_a)?$pt_cs_a :$pt_cs_a ="";
    isset($pt_pme_a)?$pt_pme_a :$pt_pme_a ="";
    isset($pt_pe_a)?$pt_pe_a :$pt_pe_a ="";
    isset($pt_nr_a)?$pt_nr_a :$pt_nr_a ="";
    isset($pt_lo_a)?$pt_lo_a :$pt_lo_a ="";
    isset($pt_o_a)?$pt_o_a :$pt_o_a ="";
    isset($pt_sn_a)?$pt_sn_a :$pt_sn_a ="";
    isset($pt_te_a)?$pt_te_a :$pt_te_a ="";
    isset($pt_cb_b)?$pt_cb_b :$pt_cb_b ="";
    isset($pt_hb_b)?$pt_hb_b :$pt_hb_b ="";
    isset($pt_hs_b)?$pt_hs_b :$pt_hs_b ="";
    isset($pt_cs_b)?$pt_cs_b :$pt_cs_b ="";
    isset($pt_pme_b)?$pt_pme_b :$pt_pme_b ="";
    isset($pt_pe_b)?$pt_pe_b :$pt_pe_b ="";
    isset($pt_nr_b)?$pt_nr_b :$pt_nr_b ="";
    isset($pt_lo_b)?$pt_lo_b :$pt_lo_b ="";
    isset($pt_o_b)?$pt_o_b :$pt_o_b ="";
    isset($pt_sn_b)?$pt_sn_b :$pt_sn_b ="";
    isset($pt_te_b)?$pt_te_b :$pt_te_b ="";
    isset($pt_cb_c)?$pt_cb_c :$pt_cb_c ="";
    isset($pt_hb_c)?$pt_hb_c :$pt_hb_c ="";
    isset($pt_hs_c)?$pt_hs_c :$pt_hs_c ="";
    isset($pt_cs_c)?$pt_cs_c :$pt_cs_c ="";
    isset($pt_pme_c)?$pt_pme_c :$pt_pme_c ="";
    isset($pt_pe_c)?$pt_pe_c :$pt_pe_c ="";
    isset($pt_nr_c)?$pt_nr_c :$pt_nr_c ="";
    isset($pt_lo_c)?$pt_lo_c :$pt_lo_c ="";
    isset($pt_o_c)?$pt_o_c :$pt_o_c ="";
    isset($pt_sn_c)?$pt_sn_c :$pt_sn_c ="";
    isset($pt_te_c)?$pt_te_c :$pt_te_c ="";
    isset($pt_cb_d)?$pt_cb_d :$pt_cb_d ="";
    isset($pt_hb_d)?$pt_hb_d :$pt_hb_d ="";
    isset($pt_hs_d)?$pt_hs_d :$pt_hs_d ="";
    isset($pt_cs_d)?$pt_cs_d :$pt_cs_d ="";
    isset($pt_pme_d)?$pt_pme_d :$pt_pme_d ="";
    isset($pt_pe_d)?$pt_pe_d :$pt_pe_d ="";
    isset($pt_nr_d)?$pt_nr_d :$pt_nr_d ="";
    isset($pt_lo_d)?$pt_lo_d :$pt_lo_d ="";
    isset($pt_o_d)?$pt_o_d :$pt_o_d ="";
    isset($pt_sn_d)?$pt_sn_d :$pt_sn_d ="";
    isset($pt_te_d)?$pt_te_d :$pt_te_d ="";
    isset($pt_cb_e)?$pt_cb_e :$pt_cb_e ="";
    isset($pt_hb_e)?$pt_hb_e :$pt_hb_e ="";
    isset($pt_hs_e)?$pt_hs_e :$pt_hs_e ="";
    isset($pt_cs_e)?$pt_cs_e :$pt_cs_e ="";
    isset($pt_pme_e)?$pt_pme_e :$pt_pme_e ="";
    isset($pt_pe_e)?$pt_pe_e :$pt_pe_e ="";
    isset($pt_nr_e)?$pt_nr_e :$pt_nr_e ="";
    isset($pt_lo_e)?$pt_lo_e :$pt_lo_e ="";
    isset($pt_o_e)?$pt_o_e :$pt_o_e ="";
    isset($pt_sn_e)?$pt_sn_e :$pt_sn_e ="";
    isset($pt_te_e)?$pt_te_e :$pt_te_e ="";
    isset($pt_cb_f)?$pt_cb_f :$pt_cb_f ="";
    isset($pt_hb_f)?$pt_hb_f :$pt_hb_f ="";
    isset($pt_hs_f)?$pt_hs_f :$pt_hs_f ="";
    isset($pt_cs_f)?$pt_cs_f :$pt_cs_f ="";
    isset($pt_pme_f)?$pt_pme_f :$pt_pme_f ="";
    isset($pt_pe_f)?$pt_pe_f :$pt_pe_f ="";
    isset($pt_nr_f)?$pt_nr_f :$pt_nr_f ="";
    isset($pt_lo_f)?$pt_lo_f :$pt_lo_f ="";
    isset($pt_o_f)?$pt_o_f :$pt_o_f ="";
    isset($pt_sn_f)?$pt_sn_f :$pt_sn_f ="";
    isset($pt_te_f)?$pt_te_f :$pt_te_f ="";
    isset($pt_cb_g)?$pt_cb_g :$pt_cb_g ="";
    isset($pt_hb_g)?$pt_hb_g :$pt_hb_g ="";
    isset($pt_hs_g)?$pt_hs_g :$pt_hs_g ="";
    isset($pt_cs_g)?$pt_cs_g :$pt_cs_g ="";
    isset($pt_pme_g)?$pt_pme_g :$pt_pme_g ="";
    isset($pt_pe_g)?$pt_pe_g :$pt_pe_g ="";
    isset($pt_nr_g)?$pt_nr_g :$pt_nr_g ="";
    isset($pt_lo_g)?$pt_lo_g :$pt_lo_g ="";
    isset($pt_o_g)?$pt_o_g :$pt_o_g ="";
    isset($pt_sn_g)?$pt_sn_g :$pt_sn_g ="";
    isset($pt_te_g)?$pt_te_g :$pt_te_g ="";
    isset($pt_cb_h)?$pt_cb_h :$pt_cb_h ="";
    isset($pt_hb_h)?$pt_hb_h :$pt_hb_h ="";
    isset($pt_hs_h)?$pt_hs_h :$pt_hs_h ="";
    isset($pt_cs_h)?$pt_cs_h :$pt_cs_h ="";
    isset($pt_pme_h)?$pt_pme_h :$pt_pme_h ="";
    isset($pt_pe_h)?$pt_pe_h :$pt_pe_h ="";
    isset($pt_nr_h)?$pt_nr_h :$pt_nr_h ="";
    isset($pt_lo_h)?$pt_lo_h :$pt_lo_h ="";
    isset($pt_o_h)?$pt_o_h :$pt_o_h ="";
    isset($pt_sn_h)?$pt_sn_h :$pt_sn_h ="";
    isset($pt_te_h)?$pt_te_h :$pt_te_h ="";
    isset($pt_cb_i)?$pt_cb_i :$pt_cb_i ="";
    isset($pt_hb_i)?$pt_hb_i :$pt_hb_i ="";
    isset($pt_hs_i)?$pt_hs_i :$pt_hs_i ="";
    isset($pt_cs_i)?$pt_cs_i :$pt_cs_i ="";
    isset($pt_pme_i)?$pt_pme_i :$pt_pme_i ="";
    isset($pt_pe_i)?$pt_pe_i :$pt_pe_i ="";
    isset($pt_nr_i)?$pt_nr_i :$pt_nr_i ="";
    isset($pt_lo_i)?$pt_lo_i :$pt_lo_i ="";
    isset($pt_o_i)?$pt_o_i :$pt_o_i ="";
    isset($pt_sn_i)?$pt_sn_i :$pt_sn_i ="";
    isset($pt_te_i)?$pt_te_i :$pt_te_i ="";
    isset($pt_cb_j)?$pt_cb_j :$pt_cb_j ="";
    isset($pt_hb_j)?$pt_hb_j :$pt_hb_j ="";
    isset($pt_hs_j)?$pt_hs_j :$pt_hs_j ="";
    isset($pt_cs_j)?$pt_cs_j :$pt_cs_j ="";
    isset($pt_pme_j)?$pt_pme_j :$pt_pme_j ="";
    isset($pt_pe_j)?$pt_pe_j :$pt_pe_j ="";
    isset($pt_nr_j)?$pt_nr_j :$pt_nr_j ="";
    isset($pt_lo_j)?$pt_lo_j :$pt_lo_j ="";
    isset($pt_o_j)?$pt_o_j :$pt_o_j ="";
    isset($pt_sn_j)?$pt_sn_j :$pt_sn_j ="";
    isset($pt_te_j)?$pt_te_j :$pt_te_j ="";
    isset($ind_scr_fhxcc_fdr )?$ind_scr_fhxcc_fdr  :$ind_scr_fhxcc_fdr  ="";
    isset($dex_oth)?$dex_oth :$dex_oth ="";
    isset($addl_polyp )?$addl_polyp  :$addl_polyp  ="";
    isset($all_plps_rem )?$all_plps_rem  :$all_plps_rem  ="";
    isset($susp_ca)?$susp_ca :$susp_ca ="";
    isset($susp_ca_loc )?$susp_ca_loc  :$susp_ca_loc  ="";
    isset($susp_ca_siz )?$susp_ca_siz  :$susp_ca_siz  ="";
    isset($susp_ca_trt_cb)?$susp_ca_trt_cb :$susp_ca_trt_cb ="";
    isset($susp_ca_trt_hb)?$susp_ca_trt_hb :$susp_ca_trt_hb ="";
    isset($susp_ca_trt_hs)?$susp_ca_trt_hs :$susp_ca_trt_hs ="";
    isset($susp_ca_trt_cs)?$susp_ca_trt_cs :$susp_ca_trt_cs ="";
    isset($susp_ca_trt_pme)?$susp_ca_trt_pme :$susp_ca_trt_pme ="";
    isset($susp_ca_trt_pe)?$susp_ca_trt_pe :$susp_ca_trt_pe ="";
    isset($susp_ca_trt_nr)?$susp_ca_trt_nr :$susp_ca_trt_nr ="";
    isset($susp_ca_trt_lo)?$susp_ca_trt_lo :$susp_ca_trt_lo ="";
    isset($susp_ca_trt_o)?$susp_ca_trt_o :$susp_ca_trt_o ="";
    isset($susp_ca_trt_sn)?$susp_ca_trt_sn :$susp_ca_trt_sn ="";
    isset($susp_ca_trt_te)?$susp_ca_trt_te :$susp_ca_trt_te ="";
    isset($susp_crohns )?$susp_crohns  :$susp_crohns  ="";
    isset($susp_crohns_calced)?$susp_crohns_calced :$susp_crohns_calced ="";
    isset($susp_UC )?$susp_UC  :$susp_UC  ="";
    isset($susp_UC_calced)?$susp_UC_calced :$susp_UC_calced ="";
    isset($find_other)?$find_other :$find_other ="";
    isset($find_oth_bmc)?$find_oth_bmc :$find_oth_bmc ="";
    isset($find_oth_ibd)?$find_oth_ibd :$find_oth_ibd ="";
    isset($find_oth_biop)?$find_oth_biop :$find_oth_biop ="";
    isset($find_oth_other)?$find_oth_other :$find_oth_other ="";
    isset($prep )?$prep  :$prep  ="";
    isset($prep_type )?$prep_type  :$prep_type  ="";
    isset($meds_used_versed)?$meds_used_versed :$meds_used_versed ="";
    isset($meds_used_demerol)?$meds_used_demerol :$meds_used_demerol ="";
    isset($meds_used_fentanyl)?$meds_used_fentanyl :$meds_used_fentanyl ="";
    isset($meds_used_propofol)?$meds_used_propofol :$meds_used_propofol ="";
    isset($meds_used_none)?$meds_used_none :$meds_used_none ="";
    isset($meds_used_other)?$meds_used_other :$meds_used_other ="";
    isset($end_proc_stat_rr )?$end_proc_stat_rr  :$end_proc_stat_rr  ="";
    isset($abort_reas_pp )?$abort_reas_pp  :$abort_reas_pp  ="";
    isset($abort_reas_obs )?$abort_reas_obs  :$abort_reas_obs  ="";
    isset($abort_reas_sedprob )?$abort_reas_sedprob  :$abort_reas_sedprob  ="";
    isset($abort_reas_tc )?$abort_reas_tc  :$abort_reas_tc  ="";
    isset($abort_reas_oth )?$abort_reas_oth  :$abort_reas_oth  ="";
    isset($wthdrwl_time )?$wthdrwl_time  :$wthdrwl_time  ="";
    isset($comp_none )?$comp_none  :$comp_none  ="";
    isset($comp_bleed )?$comp_bleed  :$comp_bleed  ="";
    isset($comp_perf )?$comp_perf  :$comp_perf  ="";
    isset($comp_cardio )?$comp_cardio  :$comp_cardio  ="";
    isset($comp_resparr )?$comp_resparr  :$comp_resparr  ="";
    isset($comp_oth )?$comp_oth  :$comp_oth  ="";
    isset($fup_lt1 )?$fup_lt1  :$fup_lt1  ="";
    isset($fup_2t3 )?$fup_2t3  :$fup_2t3  ="";
    isset($fup_4t5 )?$fup_4t5  :$fup_4t5  ="";
    isset($fup_6t9 )?$fup_6t9  :$fup_6t9  ="";
    isset($fup_10 )?$fup_10  :$fup_10  ="";
    isset($fup_gt10 )?$fup_gt10  :$fup_gt10  ="";
    isset($fup_nfsi )?$fup_nfsi  :$fup_nfsi  ="";
    isset($fup_rwp )?$fup_rwp  :$fup_rwp  ="";
    isset($fup_pp )?$fup_pp  :$fup_pp  ="";
    isset($fup_baren )?$fup_baren  :$fup_baren  ="";
    isset($fup_othproc )?$fup_othproc  :$fup_othproc  ="";
    isset($fup_ctc )?$fup_ctc  :$fup_ctc  ="";
    isset($fup_surgcons )?$fup_surgcons  :$fup_surgcons  ="";
    isset($fup_pcp )?$fup_pcp  :$fup_pcp  ="";
    isset($fup_1t3 )?$fup_1t3  :$fup_1t3  ="";
    isset($fup_6t10 )?$fup_6t10  :$fup_6t10  ="";
    isset($dex_cbh_diarcons)?$dex_cbh_diarcons :$dex_cbh_diarcons ="";
    isset($dex_abd_pain)?$dex_abd_pain :$dex_abd_pain ="";
    isset($ind_scr_phxcca)?$ind_scr_phxcca :$ind_scr_phxcca ="";
    isset($ind_sur_phxplpcca)?$ind_sur_phxplpcca :$ind_sur_phxplpcca ="";
    isset($data_source )?$data_source  :$data_source  ="";
    isset($prep_typ_nulytely)?$prep_typ_nulytely :$prep_typ_nulytely ="";
    isset($prep_typ_halflytely)?$prep_typ_halflytely :$prep_typ_halflytely ="";
    isset($prep_typ_osmo)?$prep_typ_osmo :$prep_typ_osmo ="";
    isset($prep_typ_fleet)?$prep_typ_fleet :$prep_typ_fleet ="";
    isset($prep_typ_oth)?$prep_typ_oth :$prep_typ_oth ="";
    isset($vr_uccrohn)?$vr_uccrohn :$vr_uccrohn ="";
    isset($util_bool)?$util_bool :$util_bool ="";
    isset($computed_fnd_polyp)?$computed_fnd_polyp :$computed_fnd_polyp ="";
    isset($computed_fnd_siz)?$computed_fnd_siz :$computed_fnd_siz ="";
    isset($endo_code )?$endo_code  :$endo_code  ="";
    isset($f_reas_curex )?$f_reas_curex  :$f_reas_curex  ="";
    isset($f_reas_famhx )?$f_reas_famhx  :$f_reas_famhx  ="";
    isset($f_reas_perhx )?$f_reas_perhx  :$f_reas_perhx  ="";
    isset($f_reas_ibd )?$f_reas_ibd  :$f_reas_ibd  ="";
    isset($f_reas_oth )?$f_reas_oth  :$f_reas_oth  ="";
    isset($computed_normal_exam)?$computed_normal_exam :$computed_normal_exam ="";
    isset($computed_plp_trtmnt)?$computed_plp_trtmnt :$computed_plp_trtmnt ="";
    isset($computed_susp_ca_loc)?$computed_susp_ca_loc :$computed_susp_ca_loc ="";
    isset($computed_susp_ca_siz)?$computed_susp_ca_siz :$computed_susp_ca_siz ="";
    isset($computed_susp_ca_trtmnt)?$computed_susp_ca_trtmnt :$computed_susp_ca_trtmnt ="";
    isset($computed_susp_crohn)?$computed_susp_crohn :$computed_susp_crohn ="";
    isset($computed_susp_uc)?$computed_susp_uc :$computed_susp_uc ="";
    isset($computed_susp_other)?$computed_susp_other :$computed_susp_other ="";
    isset($su_cr_loc_ti)?$su_cr_loc_ti :$su_cr_loc_ti ="";
    isset($su_cr_loc_ce)?$su_cr_loc_ce :$su_cr_loc_ce ="";
    isset($su_cr_loc_ac)?$su_cr_loc_ac :$su_cr_loc_ac ="";
    isset($su_cr_loc_hf)?$su_cr_loc_hf :$su_cr_loc_hf ="";
    isset($su_cr_loc_tc)?$su_cr_loc_tc :$su_cr_loc_tc ="";
    isset($su_cr_loc_sf)?$su_cr_loc_sf :$su_cr_loc_sf ="";
    isset($su_cr_loc_dc)?$su_cr_loc_dc :$su_cr_loc_dc ="";
    isset($su_cr_loc_sg)?$su_cr_loc_sg :$su_cr_loc_sg ="";
    isset($su_cr_loc_re)?$su_cr_loc_re :$su_cr_loc_re ="";
    isset($su_cr_loc_u)?$su_cr_loc_u :$su_cr_loc_u ="";
    isset($su_uc_loc_ti)?$su_uc_loc_ti :$su_uc_loc_ti ="";
    isset($su_uc_loc_ce)?$su_uc_loc_ce :$su_uc_loc_ce ="";
    isset($su_uc_loc_ac)?$su_uc_loc_ac :$su_uc_loc_ac ="";
    isset($su_uc_loc_hf)?$su_uc_loc_hf :$su_uc_loc_hf ="";
    isset($su_uc_loc_tc)?$su_uc_loc_tc :$su_uc_loc_tc ="";
    isset($su_uc_loc_sf)?$su_uc_loc_sf :$su_uc_loc_sf ="";
    isset($su_uc_loc_dc)?$su_uc_loc_dc :$su_uc_loc_dc ="";
    isset($su_uc_loc_sg)?$su_uc_loc_sg :$su_uc_loc_sg ="";
    isset($su_uc_loc_re)?$su_uc_loc_re :$su_uc_loc_re ="";
    isset($su_uc_loc_u)?$su_uc_loc_u :$su_uc_loc_u ="";
    isset($indication_calculated )?$indication_calculated  :$indication_calculated  ="";
    isset($fu_form_completed)?$fu_form_completed :$fu_form_completed ="";
    isset($computed_susp_ca)?$computed_susp_ca :$computed_susp_ca ="";
    isset($p_flat_a)?$p_flat_a :$p_flat_a ="";
    isset($p_flat_b)?$p_flat_b :$p_flat_b ="";
    isset($p_flat_c)?$p_flat_c :$p_flat_c ="";
    isset($p_flat_d)?$p_flat_d :$p_flat_d ="";
    isset($p_flat_e)?$p_flat_e :$p_flat_e ="";
    isset($p_flat_f)?$p_flat_f :$p_flat_f ="";
    isset($p_flat_g)?$p_flat_g :$p_flat_g ="";
    isset($pth_req_id)?$pth_req_id :$pth_req_id ="";
    isset($find_calc_normal)?$find_calc_normal :$find_calc_normal ="";
    isset($find_calc_polyp)?$find_calc_polyp :$find_calc_polyp ="";
    isset($find_calc_cancer)?$find_calc_cancer :$find_calc_cancer ="";
    isset($find_calc_other)?$find_calc_other :$find_calc_other ="";
    isset($find_calc_nodata)?$find_calc_nodata :$find_calc_nodata ="";

    try{
            $stmt = pg_prepare($conn,"the_query","select * from public.set_specimen($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19,$20,$21,$22,$23,$24,$25)");
            if ($stmt) {
                $result = pg_execute($conn,"the_query", array(
                $specimen_id,
                $endo_first_name,
                $endo_middle_name,
                $endo_dob,
                $endo_gender_male,
                $comments,
                $endo_status,
                $endo_status_date)
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

$result = pg_query("select * from vColo2 where colo_id = ".$colo_id);

while($row = pg_fetch_array($result)){
    foreach ($row as $key => $value) {
        /* assign to var (strip whitespace if 2t an array)    */
        ${$key} = is_array($value) ? $value : trim($value);
    }
}

isset($colo_id)?$colo_id :$colo_id ="";
isset($action_on)?$action_on :$action_on ="";
isset($action_by )?$action_by  :$action_by  ="";
isset($record_comment )?$record_comment  :$record_comment  ="";
isset($inserted_on)?$inserted_on :$inserted_on ="";
isset($inserted_by )?$inserted_by  :$inserted_by  ="";
isset($event_id)?$event_id :$event_id ="";
isset($facility_id )?$facility_id  :$facility_id  ="";
isset($facility_type )?$facility_type  :$facility_type  ="";
isset($exam_date)?$exam_date :$exam_date ="";
isset($teleform_formid )?$teleform_formid  :$teleform_formid  ="";
isset($crs_batch)?$crs_batch :$crs_batch ="";
isset($scan_batch)?$scan_batch :$scan_batch ="";
isset($barcode )?$barcode  :$barcode  ="";
isset($ind_scr_nosym )?$ind_scr_nosym  :$ind_scr_nosym  ="";
isset($ind_scr_fhxcc )?$ind_scr_fhxcc  :$ind_scr_fhxcc  ="";
isset($ind_scr_fhxplp )?$ind_scr_fhxplp  :$ind_scr_fhxplp  ="";
isset($ind_sur_phxcc )?$ind_sur_phxcc  :$ind_sur_phxcc  ="";
isset($ind_sur_phxplp )?$ind_sur_phxplp  :$ind_sur_phxplp  ="";
isset($ind_sur_fhnpcc )?$ind_sur_fhnpcc  :$ind_sur_fhnpcc  ="";
isset($ind_sur_ibd )?$ind_sur_ibd  :$ind_sur_ibd  ="";
isset($ibdtyp_uc )?$ibdtyp_uc  :$ibdtyp_uc  ="";
isset($ibdtyp_crohn )?$ibdtyp_crohn  :$ibdtyp_crohn  ="";
isset($ibdtyp_ind )?$ibdtyp_ind  :$ibdtyp_ind  ="";
isset($ind_diag_exam )?$ind_diag_exam  :$ind_diag_exam  ="";
isset($dex_bleed )?$dex_bleed  :$dex_bleed  ="";
isset($dex_cbh_diar )?$dex_cbh_diar  :$dex_cbh_diar  ="";
isset($dex_cbh_cons )?$dex_cbh_cons  :$dex_cbh_cons  ="";
isset($dex_elim_ibd )?$dex_elim_ibd  :$dex_elim_ibd  ="";
isset($dex_biop )?$dex_biop  :$dex_biop  ="";
isset($dex_fobt )?$dex_fobt  :$dex_fobt  ="";
isset($dex_abn_test )?$dex_abn_test  :$dex_abn_test  ="";
isset($dex_abn_tst_ctc )?$dex_abn_tst_ctc  :$dex_abn_tst_ctc  ="";
isset($dex_abn_tst_bar_en )?$dex_abn_tst_bar_en  :$dex_abn_tst_bar_en  ="";
isset($dex_abn_tst_oth )?$dex_abn_tst_oth  :$dex_abn_tst_oth  ="";
isset($dex_plpect_plp )?$dex_plpect_plp  :$dex_plpect_plp  ="";
isset($dex_ida )?$dex_ida  :$dex_ida  ="";
isset($fnd_norm_ex)?$fnd_norm_ex :$fnd_norm_ex ="";
isset($fnd_plp)?$fnd_plp :$fnd_plp ="";
isset($p_loc_a )?$p_loc_a  :$p_loc_a  ="";
isset($p_loc_b )?$p_loc_b  :$p_loc_b  ="";
isset($p_loc_c )?$p_loc_c  :$p_loc_c  ="";
isset($p_loc_d )?$p_loc_d  :$p_loc_d  ="";
isset($p_loc_e )?$p_loc_e  :$p_loc_e  ="";
isset($p_loc_f )?$p_loc_f  :$p_loc_f  ="";
isset($p_loc_g )?$p_loc_g  :$p_loc_g  ="";
isset($p_loc_h )?$p_loc_h  :$p_loc_h  ="";
isset($p_loc_i )?$p_loc_i  :$p_loc_i  ="";
isset($p_loc_j )?$p_loc_j  :$p_loc_j  ="";
isset($p_siz_a )?$p_siz_a  :$p_siz_a  ="";
isset($p_siz_b )?$p_siz_b  :$p_siz_b  ="";
isset($p_siz_c )?$p_siz_c  :$p_siz_c  ="";
isset($p_siz_d )?$p_siz_d  :$p_siz_d  ="";
isset($p_siz_e )?$p_siz_e  :$p_siz_e  ="";
isset($p_siz_f )?$p_siz_f  :$p_siz_f  ="";
isset($p_siz_g )?$p_siz_g  :$p_siz_g  ="";
isset($p_siz_h )?$p_siz_h  :$p_siz_h  ="";
isset($p_siz_i )?$p_siz_i  :$p_siz_i  ="";
isset($p_siz_j )?$p_siz_j  :$p_siz_j  ="";
isset($pt_cb_a)?$pt_cb_a :$pt_cb_a ="";
isset($pt_hb_a)?$pt_hb_a :$pt_hb_a ="";
isset($pt_hs_a)?$pt_hs_a :$pt_hs_a ="";
isset($pt_cs_a)?$pt_cs_a :$pt_cs_a ="";
isset($pt_pme_a)?$pt_pme_a :$pt_pme_a ="";
isset($pt_pe_a)?$pt_pe_a :$pt_pe_a ="";
isset($pt_nr_a)?$pt_nr_a :$pt_nr_a ="";
isset($pt_lo_a)?$pt_lo_a :$pt_lo_a ="";
isset($pt_o_a)?$pt_o_a :$pt_o_a ="";
isset($pt_sn_a)?$pt_sn_a :$pt_sn_a ="";
isset($pt_te_a)?$pt_te_a :$pt_te_a ="";
isset($pt_cb_b)?$pt_cb_b :$pt_cb_b ="";
isset($pt_hb_b)?$pt_hb_b :$pt_hb_b ="";
isset($pt_hs_b)?$pt_hs_b :$pt_hs_b ="";
isset($pt_cs_b)?$pt_cs_b :$pt_cs_b ="";
isset($pt_pme_b)?$pt_pme_b :$pt_pme_b ="";
isset($pt_pe_b)?$pt_pe_b :$pt_pe_b ="";
isset($pt_nr_b)?$pt_nr_b :$pt_nr_b ="";
isset($pt_lo_b)?$pt_lo_b :$pt_lo_b ="";
isset($pt_o_b)?$pt_o_b :$pt_o_b ="";
isset($pt_sn_b)?$pt_sn_b :$pt_sn_b ="";
isset($pt_te_b)?$pt_te_b :$pt_te_b ="";
isset($pt_cb_c)?$pt_cb_c :$pt_cb_c ="";
isset($pt_hb_c)?$pt_hb_c :$pt_hb_c ="";
isset($pt_hs_c)?$pt_hs_c :$pt_hs_c ="";
isset($pt_cs_c)?$pt_cs_c :$pt_cs_c ="";
isset($pt_pme_c)?$pt_pme_c :$pt_pme_c ="";
isset($pt_pe_c)?$pt_pe_c :$pt_pe_c ="";
isset($pt_nr_c)?$pt_nr_c :$pt_nr_c ="";
isset($pt_lo_c)?$pt_lo_c :$pt_lo_c ="";
isset($pt_o_c)?$pt_o_c :$pt_o_c ="";
isset($pt_sn_c)?$pt_sn_c :$pt_sn_c ="";
isset($pt_te_c)?$pt_te_c :$pt_te_c ="";
isset($pt_cb_d)?$pt_cb_d :$pt_cb_d ="";
isset($pt_hb_d)?$pt_hb_d :$pt_hb_d ="";
isset($pt_hs_d)?$pt_hs_d :$pt_hs_d ="";
isset($pt_cs_d)?$pt_cs_d :$pt_cs_d ="";
isset($pt_pme_d)?$pt_pme_d :$pt_pme_d ="";
isset($pt_pe_d)?$pt_pe_d :$pt_pe_d ="";
isset($pt_nr_d)?$pt_nr_d :$pt_nr_d ="";
isset($pt_lo_d)?$pt_lo_d :$pt_lo_d ="";
isset($pt_o_d)?$pt_o_d :$pt_o_d ="";
isset($pt_sn_d)?$pt_sn_d :$pt_sn_d ="";
isset($pt_te_d)?$pt_te_d :$pt_te_d ="";
isset($pt_cb_e)?$pt_cb_e :$pt_cb_e ="";
isset($pt_hb_e)?$pt_hb_e :$pt_hb_e ="";
isset($pt_hs_e)?$pt_hs_e :$pt_hs_e ="";
isset($pt_cs_e)?$pt_cs_e :$pt_cs_e ="";
isset($pt_pme_e)?$pt_pme_e :$pt_pme_e ="";
isset($pt_pe_e)?$pt_pe_e :$pt_pe_e ="";
isset($pt_nr_e)?$pt_nr_e :$pt_nr_e ="";
isset($pt_lo_e)?$pt_lo_e :$pt_lo_e ="";
isset($pt_o_e)?$pt_o_e :$pt_o_e ="";
isset($pt_sn_e)?$pt_sn_e :$pt_sn_e ="";
isset($pt_te_e)?$pt_te_e :$pt_te_e ="";
isset($pt_cb_f)?$pt_cb_f :$pt_cb_f ="";
isset($pt_hb_f)?$pt_hb_f :$pt_hb_f ="";
isset($pt_hs_f)?$pt_hs_f :$pt_hs_f ="";
isset($pt_cs_f)?$pt_cs_f :$pt_cs_f ="";
isset($pt_pme_f)?$pt_pme_f :$pt_pme_f ="";
isset($pt_pe_f)?$pt_pe_f :$pt_pe_f ="";
isset($pt_nr_f)?$pt_nr_f :$pt_nr_f ="";
isset($pt_lo_f)?$pt_lo_f :$pt_lo_f ="";
isset($pt_o_f)?$pt_o_f :$pt_o_f ="";
isset($pt_sn_f)?$pt_sn_f :$pt_sn_f ="";
isset($pt_te_f)?$pt_te_f :$pt_te_f ="";
isset($pt_cb_g)?$pt_cb_g :$pt_cb_g ="";
isset($pt_hb_g)?$pt_hb_g :$pt_hb_g ="";
isset($pt_hs_g)?$pt_hs_g :$pt_hs_g ="";
isset($pt_cs_g)?$pt_cs_g :$pt_cs_g ="";
isset($pt_pme_g)?$pt_pme_g :$pt_pme_g ="";
isset($pt_pe_g)?$pt_pe_g :$pt_pe_g ="";
isset($pt_nr_g)?$pt_nr_g :$pt_nr_g ="";
isset($pt_lo_g)?$pt_lo_g :$pt_lo_g ="";
isset($pt_o_g)?$pt_o_g :$pt_o_g ="";
isset($pt_sn_g)?$pt_sn_g :$pt_sn_g ="";
isset($pt_te_g)?$pt_te_g :$pt_te_g ="";
isset($pt_cb_h)?$pt_cb_h :$pt_cb_h ="";
isset($pt_hb_h)?$pt_hb_h :$pt_hb_h ="";
isset($pt_hs_h)?$pt_hs_h :$pt_hs_h ="";
isset($pt_cs_h)?$pt_cs_h :$pt_cs_h ="";
isset($pt_pme_h)?$pt_pme_h :$pt_pme_h ="";
isset($pt_pe_h)?$pt_pe_h :$pt_pe_h ="";
isset($pt_nr_h)?$pt_nr_h :$pt_nr_h ="";
isset($pt_lo_h)?$pt_lo_h :$pt_lo_h ="";
isset($pt_o_h)?$pt_o_h :$pt_o_h ="";
isset($pt_sn_h)?$pt_sn_h :$pt_sn_h ="";
isset($pt_te_h)?$pt_te_h :$pt_te_h ="";
isset($pt_cb_i)?$pt_cb_i :$pt_cb_i ="";
isset($pt_hb_i)?$pt_hb_i :$pt_hb_i ="";
isset($pt_hs_i)?$pt_hs_i :$pt_hs_i ="";
isset($pt_cs_i)?$pt_cs_i :$pt_cs_i ="";
isset($pt_pme_i)?$pt_pme_i :$pt_pme_i ="";
isset($pt_pe_i)?$pt_pe_i :$pt_pe_i ="";
isset($pt_nr_i)?$pt_nr_i :$pt_nr_i ="";
isset($pt_lo_i)?$pt_lo_i :$pt_lo_i ="";
isset($pt_o_i)?$pt_o_i :$pt_o_i ="";
isset($pt_sn_i)?$pt_sn_i :$pt_sn_i ="";
isset($pt_te_i)?$pt_te_i :$pt_te_i ="";
isset($pt_cb_j)?$pt_cb_j :$pt_cb_j ="";
isset($pt_hb_j)?$pt_hb_j :$pt_hb_j ="";
isset($pt_hs_j)?$pt_hs_j :$pt_hs_j ="";
isset($pt_cs_j)?$pt_cs_j :$pt_cs_j ="";
isset($pt_pme_j)?$pt_pme_j :$pt_pme_j ="";
isset($pt_pe_j)?$pt_pe_j :$pt_pe_j ="";
isset($pt_nr_j)?$pt_nr_j :$pt_nr_j ="";
isset($pt_lo_j)?$pt_lo_j :$pt_lo_j ="";
isset($pt_o_j)?$pt_o_j :$pt_o_j ="";
isset($pt_sn_j)?$pt_sn_j :$pt_sn_j ="";
isset($pt_te_j)?$pt_te_j :$pt_te_j ="";
isset($ind_scr_fhxcc_fdr )?$ind_scr_fhxcc_fdr  :$ind_scr_fhxcc_fdr  ="";
isset($dex_oth)?$dex_oth :$dex_oth ="";
isset($addl_polyp )?$addl_polyp  :$addl_polyp  ="";
isset($all_plps_rem )?$all_plps_rem  :$all_plps_rem  ="";
isset($susp_ca)?$susp_ca :$susp_ca ="";
isset($susp_ca_loc )?$susp_ca_loc  :$susp_ca_loc  ="";
isset($susp_ca_siz )?$susp_ca_siz  :$susp_ca_siz  ="";
isset($susp_ca_trt_cb)?$susp_ca_trt_cb :$susp_ca_trt_cb ="";
isset($susp_ca_trt_hb)?$susp_ca_trt_hb :$susp_ca_trt_hb ="";
isset($susp_ca_trt_hs)?$susp_ca_trt_hs :$susp_ca_trt_hs ="";
isset($susp_ca_trt_cs)?$susp_ca_trt_cs :$susp_ca_trt_cs ="";
isset($susp_ca_trt_pme)?$susp_ca_trt_pme :$susp_ca_trt_pme ="";
isset($susp_ca_trt_pe)?$susp_ca_trt_pe :$susp_ca_trt_pe ="";
isset($susp_ca_trt_nr)?$susp_ca_trt_nr :$susp_ca_trt_nr ="";
isset($susp_ca_trt_lo)?$susp_ca_trt_lo :$susp_ca_trt_lo ="";
isset($susp_ca_trt_o)?$susp_ca_trt_o :$susp_ca_trt_o ="";
isset($susp_ca_trt_sn)?$susp_ca_trt_sn :$susp_ca_trt_sn ="";
isset($susp_ca_trt_te)?$susp_ca_trt_te :$susp_ca_trt_te ="";
isset($susp_crohns )?$susp_crohns  :$susp_crohns  ="";
isset($susp_crohns_calced)?$susp_crohns_calced :$susp_crohns_calced ="";
isset($susp_UC )?$susp_UC  :$susp_UC  ="";
isset($susp_UC_calced)?$susp_UC_calced :$susp_UC_calced ="";
isset($find_other)?$find_other :$find_other ="";
isset($find_oth_bmc)?$find_oth_bmc :$find_oth_bmc ="";
isset($find_oth_ibd)?$find_oth_ibd :$find_oth_ibd ="";
isset($find_oth_biop)?$find_oth_biop :$find_oth_biop ="";
isset($find_oth_other)?$find_oth_other :$find_oth_other ="";
isset($prep )?$prep  :$prep  ="";
isset($prep_type )?$prep_type  :$prep_type  ="";
isset($meds_used_versed)?$meds_used_versed :$meds_used_versed ="";
isset($meds_used_demerol)?$meds_used_demerol :$meds_used_demerol ="";
isset($meds_used_fentanyl)?$meds_used_fentanyl :$meds_used_fentanyl ="";
isset($meds_used_propofol)?$meds_used_propofol :$meds_used_propofol ="";
isset($meds_used_none)?$meds_used_none :$meds_used_none ="";
isset($meds_used_other)?$meds_used_other :$meds_used_other ="";
isset($end_proc_stat_rr )?$end_proc_stat_rr  :$end_proc_stat_rr  ="";
isset($abort_reas_pp )?$abort_reas_pp  :$abort_reas_pp  ="";
isset($abort_reas_obs )?$abort_reas_obs  :$abort_reas_obs  ="";
isset($abort_reas_sedprob )?$abort_reas_sedprob  :$abort_reas_sedprob  ="";
isset($abort_reas_tc )?$abort_reas_tc  :$abort_reas_tc  ="";
isset($abort_reas_oth )?$abort_reas_oth  :$abort_reas_oth  ="";
isset($wthdrwl_time )?$wthdrwl_time  :$wthdrwl_time  ="";
isset($comp_none )?$comp_none  :$comp_none  ="";
isset($comp_bleed )?$comp_bleed  :$comp_bleed  ="";
isset($comp_perf )?$comp_perf  :$comp_perf  ="";
isset($comp_cardio )?$comp_cardio  :$comp_cardio  ="";
isset($comp_resparr )?$comp_resparr  :$comp_resparr  ="";
isset($comp_oth )?$comp_oth  :$comp_oth  ="";
isset($fup_lt1 )?$fup_lt1  :$fup_lt1  ="";
isset($fup_2t3 )?$fup_2t3  :$fup_2t3  ="";
isset($fup_4t5 )?$fup_4t5  :$fup_4t5  ="";
isset($fup_6t9 )?$fup_6t9  :$fup_6t9  ="";
isset($fup_10 )?$fup_10  :$fup_10  ="";
isset($fup_gt10 )?$fup_gt10  :$fup_gt10  ="";
isset($fup_nfsi )?$fup_nfsi  :$fup_nfsi  ="";
isset($fup_rwp )?$fup_rwp  :$fup_rwp  ="";
isset($fup_pp )?$fup_pp  :$fup_pp  ="";
isset($fup_baren )?$fup_baren  :$fup_baren  ="";
isset($fup_othproc )?$fup_othproc  :$fup_othproc  ="";
isset($fup_ctc )?$fup_ctc  :$fup_ctc  ="";
isset($fup_surgcons )?$fup_surgcons  :$fup_surgcons  ="";
isset($fup_pcp )?$fup_pcp  :$fup_pcp  ="";
isset($fup_1t3 )?$fup_1t3  :$fup_1t3  ="";
isset($fup_6t10 )?$fup_6t10  :$fup_6t10  ="";
isset($dex_cbh_diarcons)?$dex_cbh_diarcons :$dex_cbh_diarcons ="";
isset($dex_abd_pain)?$dex_abd_pain :$dex_abd_pain ="";
isset($ind_scr_phxcca)?$ind_scr_phxcca :$ind_scr_phxcca ="";
isset($ind_sur_phxplpcca)?$ind_sur_phxplpcca :$ind_sur_phxplpcca ="";
isset($data_source )?$data_source  :$data_source  ="";
isset($prep_typ_nulytely)?$prep_typ_nulytely :$prep_typ_nulytely ="";
isset($prep_typ_halflytely)?$prep_typ_halflytely :$prep_typ_halflytely ="";
isset($prep_typ_osmo)?$prep_typ_osmo :$prep_typ_osmo ="";
isset($prep_typ_fleet)?$prep_typ_fleet :$prep_typ_fleet ="";
isset($prep_typ_oth)?$prep_typ_oth :$prep_typ_oth ="";
isset($vr_uccrohn)?$vr_uccrohn :$vr_uccrohn ="";
isset($util_bool)?$util_bool :$util_bool ="";
isset($computed_fnd_polyp)?$computed_fnd_polyp :$computed_fnd_polyp ="";
isset($computed_fnd_siz)?$computed_fnd_siz :$computed_fnd_siz ="";
isset($endo_code )?$endo_code  :$endo_code  ="";
isset($f_reas_curex )?$f_reas_curex  :$f_reas_curex  ="";
isset($f_reas_famhx )?$f_reas_famhx  :$f_reas_famhx  ="";
isset($f_reas_perhx )?$f_reas_perhx  :$f_reas_perhx  ="";
isset($f_reas_ibd )?$f_reas_ibd  :$f_reas_ibd  ="";
isset($f_reas_oth )?$f_reas_oth  :$f_reas_oth  ="";
isset($computed_normal_exam)?$computed_normal_exam :$computed_normal_exam ="";
isset($computed_plp_trtmnt)?$computed_plp_trtmnt :$computed_plp_trtmnt ="";
isset($computed_susp_ca_loc)?$computed_susp_ca_loc :$computed_susp_ca_loc ="";
isset($computed_susp_ca_siz)?$computed_susp_ca_siz :$computed_susp_ca_siz ="";
isset($computed_susp_ca_trtmnt)?$computed_susp_ca_trtmnt :$computed_susp_ca_trtmnt ="";
isset($computed_susp_crohn)?$computed_susp_crohn :$computed_susp_crohn ="";
isset($computed_susp_uc)?$computed_susp_uc :$computed_susp_uc ="";
isset($computed_susp_other)?$computed_susp_other :$computed_susp_other ="";
isset($su_cr_loc_ti)?$su_cr_loc_ti :$su_cr_loc_ti ="";
isset($su_cr_loc_ce)?$su_cr_loc_ce :$su_cr_loc_ce ="";
isset($su_cr_loc_ac)?$su_cr_loc_ac :$su_cr_loc_ac ="";
isset($su_cr_loc_hf)?$su_cr_loc_hf :$su_cr_loc_hf ="";
isset($su_cr_loc_tc)?$su_cr_loc_tc :$su_cr_loc_tc ="";
isset($su_cr_loc_sf)?$su_cr_loc_sf :$su_cr_loc_sf ="";
isset($su_cr_loc_dc)?$su_cr_loc_dc :$su_cr_loc_dc ="";
isset($su_cr_loc_sg)?$su_cr_loc_sg :$su_cr_loc_sg ="";
isset($su_cr_loc_re)?$su_cr_loc_re :$su_cr_loc_re ="";
isset($su_cr_loc_u)?$su_cr_loc_u :$su_cr_loc_u ="";
isset($su_uc_loc_ti)?$su_uc_loc_ti :$su_uc_loc_ti ="";
isset($su_uc_loc_ce)?$su_uc_loc_ce :$su_uc_loc_ce ="";
isset($su_uc_loc_ac)?$su_uc_loc_ac :$su_uc_loc_ac ="";
isset($su_uc_loc_hf)?$su_uc_loc_hf :$su_uc_loc_hf ="";
isset($su_uc_loc_tc)?$su_uc_loc_tc :$su_uc_loc_tc ="";
isset($su_uc_loc_sf)?$su_uc_loc_sf :$su_uc_loc_sf ="";
isset($su_uc_loc_dc)?$su_uc_loc_dc :$su_uc_loc_dc ="";
isset($su_uc_loc_sg)?$su_uc_loc_sg :$su_uc_loc_sg ="";
isset($su_uc_loc_re)?$su_uc_loc_re :$su_uc_loc_re ="";
isset($su_uc_loc_u)?$su_uc_loc_u :$su_uc_loc_u ="";
isset($indication_calculated )?$indication_calculated  :$indication_calculated  ="";
isset($fu_form_completed)?$fu_form_completed :$fu_form_completed ="";
isset($computed_susp_ca)?$computed_susp_ca :$computed_susp_ca ="";
isset($p_flat_a)?$p_flat_a :$p_flat_a ="";
isset($p_flat_b)?$p_flat_b :$p_flat_b ="";
isset($p_flat_c)?$p_flat_c :$p_flat_c ="";
isset($p_flat_d)?$p_flat_d :$p_flat_d ="";
isset($p_flat_e)?$p_flat_e :$p_flat_e ="";
isset($p_flat_f)?$p_flat_f :$p_flat_f ="";
isset($p_flat_g)?$p_flat_g :$p_flat_g ="";
isset($pth_req_id)?$pth_req_id :$pth_req_id ="";
isset($find_calc_normal)?$find_calc_normal :$find_calc_normal ="";
isset($find_calc_polyp)?$find_calc_polyp :$find_calc_polyp ="";
isset($find_calc_cancer)?$find_calc_cancer :$find_calc_cancer ="";
isset($find_calc_other)?$find_calc_other :$find_calc_other ="";
isset($find_calc_nodata)?$find_calc_nodata :$find_calc_nodata ="";

?>
<!DOCTYPE html>
<head>
<title>Colonoscopy</title>
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
<form class="form-horizontal" name="myform" id="myform" method="post" autocomplete="off">
<input type="hidden" id="colo_id" name="colo_id" value="<?php echo $colo_id; ?>"/>
<div class="container-fluid">
<?php   if(    isset($submit_message))    {    
    echo '<div class="text-info text-center bg-info h3">'.$submit_message.'</div>'; 
    } ?>
    <h3> Colonoscopy </h3>
    <div>
        Colo ID:<?php echo $colo_id; ?><br>
        Last Update: <?php echo $action_on.' - ' .$action_by; ?><br><br></b>
    </div>

    <div class="form-group row">
      <label class="control-label-left col-md-2 text-left" for="exam_date">1. Date of Procedure</label>
        <div class="col-md-2">
            <input class="form-control col-md-2" type="date" name="exam_date" id="exam_date" value="<?php echo $exam_date; ?>">
        </div>
    </div>

        <h4>2. Indication for Procedure (check all that apply)</h4>

    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="ind_scr_nosym" value="1" <?php echo $ind_scr_nosym=="1"?"checked":""; ?>><b>SCREENING EXAM</b></label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-4">
            <label><input type="checkbox" name="ind_scr_fhxcc" value="1" <?php echo $ind_scr_fhxcc=="1"?"checked":""; ?>>Screening exam for family hx of colon cancer</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label> <input type="checkbox" name="ind_scr_fhxplp" value="1" <?php echo $ind_scr_fhxplp=="1"?"checked":""; ?>>Screening exam for family hx of polyps </label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="ind_sur_phxcc" value="1" <?php echo $ind_sur_phxcc=="1"?"checked":""; ?>>Surveillance exam for personal hx of colon cancer</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="ind_sur_phxplp" value="1" <?php echo $ind_sur_phxplp=="1"?"checked":""; ?>>Surveillance exam for personal hx of polyps</label> 
        </div>
    </div>

    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="ind_sur_fhnpcc" value="1" <?php echo $ind_sur_fhnpcc=="1"?"checked":""; ?>>Surveillance exam for Familial Polyposis/HNPCC</label> 
        </div>
    </div>

    <div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="ind_sur_ibd" value="1" <?php echo $ind_sur_ibd=="1"?"checked":""; ?>>Surveillance exam for IBD</label> 
        </div>
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="ibdtyp_uc" value="1" <?php echo $ibdtyp_uc=="1"?"checked":""; ?>>ulcerative colitis</label> 
        </div>
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="ibdtyp_crohn" value="1" <?php echo $ibdtyp_crohn=="1"?"checked":""; ?>>Crohn's</label> 
        </div>
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="ibdtyp_ind" value="1" <?php echo $ibdtyp_ind=="1"?"checked":""; ?>>indeterminate</label> 
        </div>
    </div>

    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="ind_diag_exam" value="1" <?php echo $ind_diag_exam=="1"?"checked":""; ?>><b>DIAGNOSTIC EXAM</b></label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="dex_bleed" value="1" <?php echo $dex_bleed=="1"?"checked":""; ?>>Evaluate GI bleeding</label> 
        </div>
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="dex_biop" value="1" <?php echo $dex_biop=="1"?"checked":""; ?>>Biopsy of suspected cancer</label> 
        </div>
        <div class="checkbox col-md-6">
            <label><input type="checkbox" name="dex_plpect_plp" value="1" <?php echo $dex_plpect_plp=="1"?"checked":""; ?>>Polypectomy of known polyp</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="dex_cbh_diar" value="1" <?php echo $dex_cbh_diar=="1"?"checked":""; ?>>Change in bowel habits (diarrhea)</label> 
        </div>
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="dex_fobt" value="1" <?php echo $dex_fobt=="1"?"checked":""; ?>>Positive fecal occult blood test</label> 
        </div>
        <div class="checkbox col-md-6">
            <label><input type="checkbox" name="dex_ida" value="1" <?php echo $dex_ida=="1"?"checked":""; ?>>Iron deficiency anemia</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="dex_cbh_cons" value="1" <?php echo $dex_cbh_cons=="1"?"checked":""; ?>>Change in bowel habits (constipation)</label> 
        </div>
        <div class="checkbox col-md-3">
                <label><input type="checkbox" name="dex_abn_test" value="1" <?php echo $dex_abn_test=="1"?"checked":""; ?>>Abnormal test</label> 
        </div>
        <div class="checkbox col-md-6">
                <label><input type="checkbox" name="dex_oth" value="1" <?php echo $dex_oth=="1"?"checked":""; ?>>Other (explain clinical indication)</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-4">
            <label><input type="checkbox" name="dex_elim_ibd" value="1" <?php echo $dex_elim_ibd=="1"?"checked":""; ?>>Evaluate/rule out IBD</label> 
        </div>
        <div class="checkbox col-md-8">
            <label><input type="checkbox" name="dex_abn_tst_ctc" value="1" <?php echo $dex_abn_tst_ctc=="1"?"checked":""; ?>>CTC (virtual colonoscopy)</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-4"></div>
        <div class="checkbox col-md-8">
            <label><input type="checkbox" name="dex_abn_tst_bar_en" value="1" <?php echo $dex_abn_tst_bar_en=="1"?"checked":""; ?>>Barium enema</label> 
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-4"></div>
        <div class="checkbox col-md-8">
                <label><input type="checkbox" name="dex_abn_tst_oth" value="1" <?php echo $dex_abn_tst_oth=="1"?"checked":""; ?>>Other</label> 
        </div>
    </div>
    <h4>3. Findings</h4>

    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="fnd_norm_ex" value="1" <?php echo $fnd_norm_ex=="1"?"checked":""; ?>>a. NORMAL EXAM</label> 
        </div>
    </div>

    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="fnd_plp" value="1" <?php echo $fnd_plp=="1"?"checked":""; ?>>b. POLYPS</label> 
        </div>
    </div>
  <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th></th>
        <th colspan="10">Location</th>
        <th colspan="5">Size</th>
        <th colspan="9">Treatment</th>
      </tr>
      <tr>
        <th></th>
        <th>TI</th>
        <th>CE</th>
        <th>AC</th>
        <th>HF</th>
        <th>TC</th>
        <th>SF</th>
        <th>DC</th>
        <th>SG</th>
        <th>RE</th>
        <th>U</th>
        <th>flat polyp</th>
        <th><5mm</th>
        <th>5-9mm</th>
        <th>1.0-2.0cm</th>
        <th>>2.0cm</th>
        <th>CB</th>
        <th>HB</th>
        <th>HS</th>
        <th>CS</th>
        <th>PMS</th>
        <th>PE</th>
        <th>NR</th>
        <th>LO</th>
        <th>O</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>A</td>
        <td><input type="checkbox" name="p_loc_a" value="TI" <?php echo $p_loc_a=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="CE" <?php echo $p_loc_a=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="AC" <?php echo $p_loc_a=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="HF" <?php echo $p_loc_a=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="TC" <?php echo $p_loc_a=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="SF" <?php echo $p_loc_a=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="DC" <?php echo $p_loc_a=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="SG" <?php echo $p_loc_a=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="RE" <?php echo $p_loc_a=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_a" value="U" <?php echo $p_loc_a=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_a" value="1" <?php echo $p_flat_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_a" value="1" <?php echo $p_siz_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_a" value="2" <?php echo $p_siz_a=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_a" value="3" <?php echo $p_siz_a=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_a" value="4" <?php echo $p_siz_a=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_a" value="1" <?php echo $pt_cb_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_a" value="1" <?php echo $pt_hb_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_a" value="1" <?php echo $pt_hs_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_a" value="1" <?php echo $pt_cs_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_a" value="1" <?php echo $pt_pme_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_a" value="1" <?php echo $pt_pe_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_a" value="1" <?php echo $pt_nr_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_a" value="1" <?php echo $pt_lo_a=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_a" value="1" <?php echo $pt_o_a=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>B</td>
        <td><input type="checkbox" name="p_loc_b" value="TI" <?php echo $p_loc_b=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="CE" <?php echo $p_loc_b=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="AC" <?php echo $p_loc_b=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="HF" <?php echo $p_loc_b=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="TC" <?php echo $p_loc_b=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="SF" <?php echo $p_loc_b=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="DC" <?php echo $p_loc_b=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="SG" <?php echo $p_loc_b=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="RE" <?php echo $p_loc_b=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_b" value="U" <?php echo $p_loc_b=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_b" value="1" <?php echo $p_flat_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_b" value="1" <?php echo $p_siz_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_b" value="2" <?php echo $p_siz_b=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_b" value="3" <?php echo $p_siz_b=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_b" value="4" <?php echo $p_siz_b=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_b" value="1" <?php echo $pt_cb_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_b" value="1" <?php echo $pt_hb_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_b" value="1" <?php echo $pt_hs_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_b" value="1" <?php echo $pt_cs_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_b" value="1" <?php echo $pt_pme_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_b" value="1" <?php echo $pt_pe_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_b" value="1" <?php echo $pt_nr_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_b" value="1" <?php echo $pt_lo_b=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_b" value="1" <?php echo $pt_o_b=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>C</td>
        <td><input type="checkbox" name="p_loc_c" value="TI" <?php echo $p_loc_c=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="CE" <?php echo $p_loc_c=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="AC" <?php echo $p_loc_c=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="HF" <?php echo $p_loc_c=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="TC" <?php echo $p_loc_c=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="SF" <?php echo $p_loc_c=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="DC" <?php echo $p_loc_c=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="SG" <?php echo $p_loc_c=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="RE" <?php echo $p_loc_c=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_c" value="U" <?php echo $p_loc_c=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_c" value="1" <?php echo $p_flat_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_c" value="1" <?php echo $p_siz_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_c" value="2" <?php echo $p_siz_c=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_c" value="3" <?php echo $p_siz_c=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_c" value="4" <?php echo $p_siz_c=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_c" value="1" <?php echo $pt_cb_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_c" value="1" <?php echo $pt_hb_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_c" value="1" <?php echo $pt_hs_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_c" value="1" <?php echo $pt_cs_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_c" value="1" <?php echo $pt_pme_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_c" value="1" <?php echo $pt_pe_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_c" value="1" <?php echo $pt_nr_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_c" value="1" <?php echo $pt_lo_c=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_c" value="1" <?php echo $pt_o_c=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>D</td>
        <td><input type="checkbox" name="p_loc_d" value="TI" <?php echo $p_loc_d=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="CE" <?php echo $p_loc_d=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="AC" <?php echo $p_loc_d=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="HF" <?php echo $p_loc_d=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="TC" <?php echo $p_loc_d=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="SF" <?php echo $p_loc_d=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="DC" <?php echo $p_loc_d=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="SG" <?php echo $p_loc_d=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="RE" <?php echo $p_loc_d=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_d" value="U" <?php echo $p_loc_d=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_d" value="1" <?php echo $p_flat_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_d" value="1" <?php echo $p_siz_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_d" value="2" <?php echo $p_siz_d=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_d" value="3" <?php echo $p_siz_d=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_d" value="4" <?php echo $p_siz_d=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_d" value="1" <?php echo $pt_cb_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_d" value="1" <?php echo $pt_hb_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_d" value="1" <?php echo $pt_hs_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_d" value="1" <?php echo $pt_cs_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_d" value="1" <?php echo $pt_pme_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_d" value="1" <?php echo $pt_pe_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_d" value="1" <?php echo $pt_nr_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_d" value="1" <?php echo $pt_lo_d=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_d" value="1" <?php echo $pt_o_d=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>E</td>
        <td><input type="checkbox" name="p_loc_e" value="TI" <?php echo $p_loc_e=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="CE" <?php echo $p_loc_e=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="AC" <?php echo $p_loc_e=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="HF" <?php echo $p_loc_e=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="TC" <?php echo $p_loc_e=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="SF" <?php echo $p_loc_e=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="DC" <?php echo $p_loc_e=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="SG" <?php echo $p_loc_e=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="RE" <?php echo $p_loc_e=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_e" value="U" <?php echo $p_loc_e=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_e" value="1" <?php echo $p_flat_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_e" value="1" <?php echo $p_siz_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_e" value="2" <?php echo $p_siz_e=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_e" value="3" <?php echo $p_siz_e=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_e" value="4" <?php echo $p_siz_e=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_e" value="1" <?php echo $pt_cb_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_e" value="1" <?php echo $pt_hb_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_e" value="1" <?php echo $pt_hs_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_e" value="1" <?php echo $pt_cs_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_e" value="1" <?php echo $pt_pme_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_e" value="1" <?php echo $pt_pe_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_e" value="1" <?php echo $pt_nr_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_e" value="1" <?php echo $pt_lo_e=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_e" value="1" <?php echo $pt_o_e=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>F</td>
        <td><input type="checkbox" name="p_loc_f" value="TI" <?php echo $p_loc_f=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="CE" <?php echo $p_loc_f=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="AC" <?php echo $p_loc_f=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="HF" <?php echo $p_loc_f=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="TC" <?php echo $p_loc_f=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="SF" <?php echo $p_loc_f=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="DC" <?php echo $p_loc_f=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="SG" <?php echo $p_loc_f=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="RE" <?php echo $p_loc_f=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_f" value="U" <?php echo $p_loc_f=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_f" value="1" <?php echo $p_flat_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_f" value="1" <?php echo $p_siz_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_f" value="2" <?php echo $p_siz_f=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_f" value="3" <?php echo $p_siz_f=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_f" value="4" <?php echo $p_siz_f=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_f" value="1" <?php echo $pt_cb_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_f" value="1" <?php echo $pt_hb_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_f" value="1" <?php echo $pt_hs_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_f" value="1" <?php echo $pt_cs_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_f" value="1" <?php echo $pt_pme_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_f" value="1" <?php echo $pt_pe_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_f" value="1" <?php echo $pt_nr_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_f" value="1" <?php echo $pt_lo_f=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_f" value="1" <?php echo $pt_o_f=="1"?"checked":""; ?>></td>
    </tr>
    <tr>
        <td>G</td>
        <td><input type="checkbox" name="p_loc_g" value="TI" <?php echo $p_loc_g=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="CE" <?php echo $p_loc_g=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="AC" <?php echo $p_loc_g=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="HF" <?php echo $p_loc_g=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="TC" <?php echo $p_loc_g=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="SF" <?php echo $p_loc_g=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="DC" <?php echo $p_loc_g=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="SG" <?php echo $p_loc_g=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="RE" <?php echo $p_loc_g=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_loc_g" value="U" <?php echo $p_loc_g=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_flat_g" value="1" <?php echo $p_flat_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_g" value="1" <?php echo $p_siz_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_g" value="2" <?php echo $p_siz_g=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_g" value="3" <?php echo $p_siz_g=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="p_siz_g" value="4" <?php echo $p_siz_g=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cb_g" value="1" <?php echo $pt_cb_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hb_g" value="1" <?php echo $pt_hb_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_hs_g" value="1" <?php echo $pt_hs_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_cs_g" value="1" <?php echo $pt_cs_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pme_g" value="1" <?php echo $pt_pme_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_pe_g" value="1" <?php echo $pt_pe_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_nr_g" value="1" <?php echo $pt_nr_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_lo_g" value="1" <?php echo $pt_lo_g=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="pt_o_g" value="1" <?php echo $pt_o_g=="1"?"checked":""; ?>></td>
    </tr>
    </tbody>
  </table>

    <div class="form-group row">
        <label class="control-label col-md-2" for ="flg_assump"> ADDITIONAL POLYP(S)</label> 
        <div class="col-md-1">
            <label class="radio">
            <input type="radio" name="addl_polyp" value="1" <?php echo $addl_polyp=="1"?"checked":""; ?> >Yes
            </label>
        </div>
        <div class="col-md-3">
            <label class="radio">
            <input type="radio" name="addl_polyp" value="0" <?php echo $addl_polyp=="0"?"checked":""; ?> >No
            </label>
        </div>
        <label class="control-label col-md-2" for ="flg_assump"> ALL POLYPS REMOVED</label> 
        <div class="col-md-1">
            <label class="radio">
            <input type="radio" name="all_plps_rem" value="1" <?php echo $all_plps_rem=="1"?"checked":""; ?> >Yes
            </label>
        </div>
        <div class="col-md-3">
            <label class="radio">
            <input type="radio" name="all_plps_rem" value="0" <?php echo $all_plps_rem=="0"?"checked":""; ?> >No
            </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-12">
            <label><input type="checkbox" name="susp_ca" value="1" <?php echo $susp_ca=="1"?"checked":""; ?>>C. SUSPECTED CANCER LOCATION</label> 
        </div>
    </div>

 <table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th colspan="10">Location</th>
        <th colspan="4">Size</th>
        <th colspan="9">Treatment</th>
      </tr>
      <tr>
        <th>TI</th>
        <th>CE</th>
        <th>AC</th>
        <th>HF</th>
        <th>TC</th>
        <th>SF</th>
        <th>DC</th>
        <th>SG</th>
        <th>RE</th>
        <th>U</th>
        <th><5mm</th>
        <th>5-9mm</th>
        <th>1.0-2.0cm</th>
        <th>>2.0cm</th>
        <th>CB</th>
        <th>HB</th>
        <th>HS</th>
        <th>CS</th>
        <th>PMS</th>
        <th>PE</th>
        <th>NR</th>
        <th>LO</th>
        <th>O</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td><input type="checkbox" name="susp_ca_loc" value="TI" <?php echo $susp_ca_loc=="TI"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="CE" <?php echo $susp_ca_loc=="CE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="AC" <?php echo $susp_ca_loc=="AC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="HF" <?php echo $susp_ca_loc=="HF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="TC" <?php echo $susp_ca_loc=="TC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="SF" <?php echo $susp_ca_loc=="SF"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="DC" <?php echo $susp_ca_loc=="DC"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="SG" <?php echo $susp_ca_loc=="SG"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="RE" <?php echo $susp_ca_loc=="RE"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_loc" value="U" <?php echo $susp_ca_loc=="U"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_siz" value="1" <?php echo $susp_ca_siz=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_siz" value="2" <?php echo $susp_ca_siz=="2"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_siz" value="3" <?php echo $susp_ca_siz=="3"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_siz" value="4" <?php echo $susp_ca_siz=="4"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_cb" value="1" <?php echo $susp_ca_trt_cb=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_hb" value="1" <?php echo $susp_ca_trt_hb=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_hs" value="1" <?php echo $susp_ca_trt_hs=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_cs" value="1" <?php echo $susp_ca_trt_cs=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_pme" value="1" <?php echo $susp_ca_trt_pme=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_pe" value="1" <?php echo $susp_ca_trt_pe=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_nr" value="1" <?php echo $susp_ca_trt_nr=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_lo" value="1" <?php echo $susp_ca_trt_lo=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="susp_ca_trt_o" value="1" <?php echo $susp_ca_trt_o=="1"?"checked":""; ?>></td>
    </tr>
    </tbody>
</table>
    <div class="form-group row">
        <div class="checkbox col-md-6">
            <label><input type="checkbox" name="susp_crohns" value="1" <?php echo $susp_crohns=="1"?"checked":""; ?>>D. KNOWN OR SUSCPECTED <b>CROHN'S</b> LOCATION</label> 
        </div>
        <div class="checkbox col-md-6">
            <label><input type="checkbox" name="susp_UC" value="1" <?php echo $susp_UC=="1"?"checked":""; ?>>E. KNOWN OR SUSCPECTED <b>UC</b> LOCATION</label> 
        </div>
    </div>
 <div class="col-md-6" >
 <table class="table table_condensed">
    <thead>
      <tr>
        <th>TI</th>
        <th>CE</th>
        <th>AC</th>
        <th>HF</th>
        <th>TC</th>
        <th>SF</th>
        <th>DC</th>
        <th>SG</th>
        <th>RE</th>
        <th>U</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><input type="checkbox" name="su_cr_loc_ti" value="1" <?php echo $su_cr_loc_ti=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_ce" value="1" <?php echo $su_cr_loc_ce=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_ac" value="1" <?php echo $su_cr_loc_ac=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_hf" value="1" <?php echo $su_cr_loc_hf=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_tc" value="1" <?php echo $su_cr_loc_tc=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_sf" value="1" <?php echo $su_cr_loc_sf=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_dc" value="1" <?php echo $su_cr_loc_dc=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_sg" value="1" <?php echo $su_cr_loc_sg=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_re" value="1" <?php echo $su_cr_loc_re=="1"?"checked":""; ?>></td>
        <td><input type="checkbox" name="su_cr_loc_u" value="1"  <?php echo $su_cr_loc_u=="1"?"checked":""; ?>></td>
    </tr>
    </tbody>
    </table>
</div>
<div class="col-md-6" >
    <table class="table table_condensed">
    <thead>
        <tr>
            <th>TI</th>
            <th>CE</th>
            <th>AC</th>
            <th>HF</th>
            <th>TC</th>
            <th>SF</th>
            <th>DC</th>
            <th>SG</th>
            <th>RE</th>
            <th>U</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="checkbox" name="su_uc_loc_ti" value="1" <?php echo $su_uc_loc_ti=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_ce" value="1" <?php echo $su_uc_loc_ce=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_ac" value="1" <?php echo $su_uc_loc_ac=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_hf" value="1" <?php echo $su_uc_loc_hf=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_tc" value="1" <?php echo $su_uc_loc_tc=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_sf" value="1" <?php echo $su_uc_loc_sf=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_dc" value="1" <?php echo $su_uc_loc_dc=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_sg" value="1" <?php echo $su_uc_loc_sg=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_re" value="1" <?php echo $su_uc_loc_re=="1"?"checked":""; ?>></td>
            <td><input type="checkbox" name="su_uc_loc_u" value="1"  <?php echo $su_uc_loc_u=="1"?"checked":""; ?>></td>
        </tr>
    </tbody>
    </table>
</div>
    <div class="form-group row">
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="find_other" value="1" <?php echo $find_other=="1"?"checked":""; ?>>F.OTHER</label> 
        </div>
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="find_oth_bmc" value="1" <?php echo $find_oth_bmc=="1"?"checked":""; ?>>Biopsy for microscopic colitis</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="find_oth_biop" value="1" <?php echo $find_oth_biop=="1"?"checked":""; ?>>Biopsy  (for a finding other than polyp)</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-2">
        </div>
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="find_oth_ibd" value="1" <?php echo $find_oth_ibd=="1"?"checked":""; ?>>Random biopsies for IBD surveillance</label> 
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="find_oth_other" value="1" <?php echo $find_oth_other=="1"?"checked":""; ?>>Other</label> 
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label-left form_control col-md-2"> 4.Preparation</label> 
        <div class="col-md-1">
         <label class="radio-inline">
            <input type="radio" name="prep" value="1" <?php echo $prep=="1"?"checked":""; ?> >Excellent</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="prep" value="2" <?php echo $prep=="2"?"checked":""; ?> >Good</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="prep" value="3" <?php echo $prep=="3"?"checked":""; ?> >Fair</label>
        </div>
        <div class="col-md-1 col-md-1">
        <label class="radio-inline">
            <input type="radio" name="prep" value="4" <?php echo $prep=="4"?"checked":""; ?> >Poor</label>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label form_control col-md-offset-1"> Type of preparation</label> 
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-offset-1 col-md-2">
            <label><input type="checkbox" name="prep_typ_nulytely" value="1" <?php echo $prep_typ_nulytely=="1"?"checked":""; ?> >Nulytely or similar(gallon)</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="prep_typ_halflytely" value="1" <?php echo $prep_typ_halflytely=="1"?"checked":""; ?> >Half-lytely</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="prep_typ_osmo" value="1" <?php echo $prep_typ_osmo=="1"?"checked":""; ?> >Osmoprep (pills)</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="prep_typ_fleet" value="1" <?php echo $prep_typ_fleet=="1"?"checked":""; ?> >Fleet prep kit</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="prep_typ_oth" value="1" <?php echo $prep_typ_oth=="1"?"checked":""; ?> >Other</label>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label-left form_control col-md-2"> 5.Medication Used</label> 
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="meds_used_versed" value="1" <?php echo $meds_used_versed=="1"?"checked":""; ?> >Versed</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="meds_used_demerol" value="1" <?php echo $meds_used_demerol=="1"?"checked":""; ?> >Demerol</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="meds_used_fentanyl" value="1" <?php echo $meds_used_fentanyl=="1"?"checked":""; ?> >Fentanyl</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="meds_used_propofol" value="1" <?php echo $meds_used_propofol=="1"?"checked":""; ?> >Propofol</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="meds_used_none" value="1" <?php echo $meds_used_none=="1"?"checked":""; ?> >None</label>
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="meds_used_other" value="1" <?php echo $meds_used_other=="1"?"checked":""; ?> >Other</label>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label-left form_control col-md-3" for ="end_proc_stat_rr"> 6.End of Procedure Status</label> 
    </div>
    <div class="form-group row">
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="1" <?php echo $end_proc_stat_rr=="1"?"checked":""; ?> >TI</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="2" <?php echo $end_proc_stat_rr=="2"?"checked":""; ?> >CE</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="3" <?php echo $end_proc_stat_rr=="3"?"checked":""; ?> >AC</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="4" <?php echo $end_proc_stat_rr=="4"?"checked":""; ?> >HF</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="5" <?php echo $end_proc_stat_rr=="5"?"checked":""; ?> >TC</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="6" <?php echo $end_proc_stat_rr=="6"?"checked":""; ?> >SF</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="7" <?php echo $end_proc_stat_rr=="7"?"checked":""; ?> >DC</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="8" <?php echo $end_proc_stat_rr=="8"?"checked":""; ?> >SG</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="9" <?php echo $end_proc_stat_rr=="9"?"checked":""; ?> >RE</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="10" <?php echo $end_proc_stat_rr=="10"?"checked":""; ?> >A</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="end_proc_stat_rr" value="11" <?php echo $end_proc_stat_rr=="11"?"checked":""; ?> >U</label>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label-left col-md-2" for ="wthdrwl_time"> 7.Withdrawal time</label> 
    </div>
    <div class="form-group row">
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="1" <?php echo $wthdrwl_time=="2"?"checked":""; ?> ><2</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="2" <?php echo $wthdrwl_time=="1"?"checked":""; ?> >2</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="3" <?php echo $wthdrwl_time=="3"?"checked":""; ?> >3</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="4" <?php echo $wthdrwl_time=="4"?"checked":""; ?> >4</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="5" <?php echo $wthdrwl_time=="5"?"checked":""; ?> >5</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="6" <?php echo $wthdrwl_time=="6"?"checked":""; ?> >6</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="7" <?php echo $wthdrwl_time=="7"?"checked":""; ?> >7</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="8" <?php echo $wthdrwl_time=="8"?"checked":""; ?> >8</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="9" <?php echo $wthdrwl_time=="9"?"checked":""; ?> >9</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="10" <?php echo $wthdrwl_time=="10"?"checked":""; ?> >10</label>
        </div>
        <div class="col-md-1">
        <label class="radio-inline">
            <input type="radio" name="wthdrwl_time" value="11" <?php echo $wthdrwl_time=="11"?"checked":""; ?> >>10</label>
        </div>
    </div>

    <div class="form-group row">
        <label class="control-label-left col-md-3" for ="wthdrwl_time"> 8.Immediate complications</label> 
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="comp_none" value="1" <?php echo $comp_none=="1"?"checked":""; ?> >none</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="comp_bleed" value="1" <?php echo $comp_bleed=="1"?"checked":""; ?> >bleeding</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="comp_perf" value="1" <?php echo $comp_perf=="1"?"checked":""; ?> >perforation</label>
        </div>
        <div class="checkbox col-md-1">
            <label><input type="checkbox" name="comp_cardio" value="1" <?php echo $comp_cardio=="1"?"checked":""; ?> >cardiovascular</label>
        </div>
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="comp_resparr" value="1" <?php echo $comp_resparr=="1"?"checked":""; ?> >respiratory arrest</label>
        </div>
        <div class="checkbox col-md-2">
            <label><input type="checkbox" name="comp_oth" value="1" <?php echo $comp_oth=="1"?"checked":""; ?> >other</label>
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label-left col-md-3"> 9. Follow-up Recomendation</label> 
    </div>

    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_lt1" value="1" <?php echo $fup_lt1=="1"?"checked":""; ?>>Follow-up in <= 1 yr</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_rwp" value="1" <?php echo $fup_rwp=="1"?"checked":""; ?>>Repeat with propofol</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_2t3" value="1" <?php echo $fup_2t3=="1"?"checked":""; ?>>Follow-up in 2 - 3 yrs</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_pp" value="1" <?php echo $fup_pp=="1"?"checked":""; ?>>Pending pathology</label> 
        </div>
    </div>
        <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_4t5" value="1" <?php echo $fup_4t5=="1"?"checked":""; ?>>Follow-up in 4 - 5 yrs</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_baren" value="1" <?php echo $fup_baren=="1"?"checked":""; ?>>Barium enema - where</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_6t9" value="1" <?php echo $fup_6t9=="1"?"checked":""; ?>>Follow-up in 6 - 9 yrs</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_othproc" value="1" <?php echo $fup_othproc=="1"?"checked":""; ?>>Other procedure</label> 
        </div>
    </div>
    <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_10" value="1" <?php echo $fup_10=="1"?"checked":""; ?>>Follow-up in 10 yrs</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_ctc" value="1" <?php echo $fup_ctc=="1"?"checked":""; ?>>Virtual Colonoscopy</label> 
        </div>
    </div>
        <div class="form-group row">
        <div class="checkbox col-md-3">
            <label><input type="checkbox" name="fup_nfsi" value="1" <?php echo $fup_nfsi=="1"?"checked":""; ?>>No further screening indicated</label> 
        </div>
        <div class="checkbox col-md-7">
            <label><input type="checkbox" name="fup_pcp" value="1" <?php echo $fup_pcp=="1"?"checked":""; ?>>Follow-up w/PCP</label> 
        </div>
    </div>

</div>
</form>
<br/>
<?php include("includes/footer.php"); ?>
<br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/colo.js"></script>
</body>
</html>
<?php
if (    isset($conn)) {
        pg_close($conn);
} 
?>