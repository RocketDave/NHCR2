﻿create view vColo as select
    colo_id,
    event_id as c_event_id,
    facility_id ,
    facility_type ,
    to_char(exam_date,'yyyy-mm-dd') as exam_date,
    teleform_formid ,
    crs_batch ,
    scan_batch ,
    barcode ,
    ind_scr_nosym ,
    ind_scr_fhxcc ,
    ind_scr_fhxplp ,
    ind_sur_phxcc ,
    ind_sur_phxplp ,
    ind_sur_fhnpcc ,
    ind_sur_ibd ,
    ibdtyp_uc ,
    ibdtyp_crohn ,
    ibdtyp_ind ,
    ind_diag_exam ,
    dex_bleed ,
    dex_cbh_diar ,
    dex_cbh_cons ,
    dex_elim_ibd ,
    dex_biop ,
    dex_fobt ,
    dex_abn_test ,
    dex_abn_tst_ctc ,
    dex_abn_tst_bar_en ,
    dex_abn_tst_oth ,
    dex_plpect_plp ,
    dex_ida ,
    fnd_norm_ex ,
    fnd_plp ,
    ind_scr_fhxcc_fdr ,
    dex_oth ,
    addl_polyp ,
    all_plps_rem ,
    susp_ca ,
    susp_ca_loc ,
    susp_ca_siz ,
    susp_ca_trt_cb ,
    susp_ca_trt_hb ,
    susp_ca_trt_hs ,
    susp_ca_trt_cs ,
    susp_ca_trt_pme ,
    susp_ca_trt_pe ,
    susp_ca_trt_nr ,
    susp_ca_trt_lo ,
    susp_ca_trt_o ,
    susp_ca_trt_sn ,
    susp_ca_trt_te ,
    susp_crohns ,
    susp_crohns_calced ,
    susp_UC ,
    susp_UC_calced ,
    find_other ,
    find_oth_bmc ,
    find_oth_ibd ,
    find_oth_biop ,
    find_oth_other ,
    prep ,
    prep_type ,
    meds_used_versed ,
    meds_used_demerol ,
    meds_used_fentanyl ,
    meds_used_propofol ,
    meds_used_none ,
    meds_used_other ,
    end_proc_stat_rr ,
    abort_reas_pp ,
    abort_reas_obs ,
    abort_reas_sedprob ,
    abort_reas_tc ,
    abort_reas_oth ,
    wthdrwl_time ,
    comp_none ,
    comp_bleed ,
    comp_perf ,
    comp_cardio ,
    comp_resparr ,
    comp_oth ,
    fup_lt1 ,
    fup_2t3 ,
    fup_4t5 ,
    fup_6t9 ,
    fup_10 ,
    fup_gt10 ,
    fup_nfsi ,
    fup_rwp ,
    fup_pp ,
    fup_baren ,
    fup_othproc ,
    fup_ctc ,
    fup_surgcons ,
    fup_pcp ,
    fup_1t3 ,
    fup_6t10 ,
    dex_cbh_diarcons ,
    dex_abd_pain ,
    ind_scr_phxcca ,
    ind_sur_phxplpcca ,
    data_source ,
    prep_typ_nulytely ,
    prep_typ_halflytely ,
    prep_typ_osmo ,
    prep_typ_fleet ,
    prep_typ_oth ,
    vr_uccrohn ,
    util_bool ,
    computed_fnd_polyp ,
    computed_fnd_siz ,
    endo_code ,
    f_reas_curex ,
    f_reas_famhx ,
    f_reas_perhx ,
    f_reas_ibd ,
    f_reas_oth ,
    computed_normal_exam ,
    computed_plp_trtmnt ,
    computed_susp_ca_loc ,
    computed_susp_ca_siz ,
    computed_susp_ca_trtmnt ,
    computed_susp_crohn ,
    computed_susp_uc ,
    computed_susp_other ,
    su_cr_loc_ti ,
    su_cr_loc_ce ,
    su_cr_loc_ac ,
    su_cr_loc_hf ,
    su_cr_loc_tc ,
    su_cr_loc_sf ,
    su_cr_loc_dc ,
    su_cr_loc_sg ,
    su_cr_loc_re ,
    su_cr_loc_u ,
    su_uc_loc_ti ,
    su_uc_loc_ce ,
    su_uc_loc_ac ,
    su_uc_loc_hf ,
    su_uc_loc_tc ,
    su_uc_loc_sf ,
    su_uc_loc_dc ,
    su_uc_loc_sg ,
    su_uc_loc_re ,
    su_uc_loc_u ,
    indication_calculated ,
    fu_form_completed ,
    computed_susp_ca ,
    p_flat_a ,
    p_flat_b ,
    p_flat_c ,
    p_flat_d ,
    p_flat_e ,
    p_flat_f ,
    p_flat_g ,
    pth_req_id ,
    find_calc_normal ,
    find_calc_polyp ,
    find_calc_cancer ,
    find_calc_other ,
    find_calc_nodata 
    from colo;
