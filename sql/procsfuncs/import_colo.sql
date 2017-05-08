create function import_colo()
returns void as 
$BODY$
begin
    insert into colo (
    inserted_on,
    inserted_by,
    patient_id,
    event_id,
    facility_id,
    facility_type,
    exam_date,
    teleform_formid,
    crs_batch,
    scan_batch,
    barcode,
    ind_scr_nosym,
    ind_scr_fhxcc,
    ind_scr_fhxplp,
    ind_sur_phxcc,
    ind_sur_phxplp,
    ind_sur_fhnpcc,
    ind_sur_ibd,
    ibdtyp_uc,
    ibdtyp_crohn,
    ibdtyp_ind,
    ind_diag_exam,
    dex_bleed,
    dex_cbh_diar,
    dex_cbh_cons,
    dex_elim_ibd,
    dex_biop,
    dex_fobt,
    dex_abn_test,
    dex_abn_tst_ctc,
    dex_abn_tst_bar_en,
    dex_abn_tst_oth,
    dex_plpect_plp,
    dex_ida,
    fnd_norm_ex,
    fnd_plp,
    p_loc_a,
    p_loc_b,
    p_loc_c,
    p_loc_d,
    p_loc_e,
    p_loc_f,
    p_loc_g,
    p_loc_h,
    p_loc_i,
    p_loc_j,
    p_siz_a,
    p_siz_b,
    p_siz_c,
    p_siz_d,
    p_siz_e,
    p_siz_f,
    p_siz_g,
    p_siz_h,
    p_siz_i,
    p_siz_j,
    pt_cb_a,
    pt_hb_a,
    pt_hs_a,
    pt_cs_a,
    pt_pme_a,
    pt_pe_a,
    pt_nr_a,
    pt_lo_a,
    pt_o_a,
    pt_sn_a,
    pt_te_a,
    pt_cb_b,
    pt_hb_b,
    pt_hs_b,
    pt_cs_b,
    pt_pme_b,
    pt_pe_b,
    pt_nr_b,
    pt_lo_b,
    pt_o_b,
    pt_sn_b,
    pt_te_b,
    pt_cb_c,
    pt_hb_c,
    pt_hs_c,
    pt_cs_c,
    pt_pme_c,
    pt_pe_c,
    pt_nr_c,
    pt_lo_c,
    pt_o_c,
    pt_sn_c,
    pt_te_c,
    pt_cb_d,
    pt_hb_d,
    pt_hs_d,
    pt_cs_d,
    pt_pme_d,
    pt_pe_d,
    pt_nr_d,
    pt_lo_d,
    pt_o_d,
    pt_sn_d,
    pt_te_d,
    pt_cb_e,
    pt_hb_e,
    pt_hs_e,
    pt_cs_e,
    pt_pme_e,
    pt_pe_e,
    pt_nr_e,
    pt_lo_e,
    pt_o_e,
    pt_sn_e,
    pt_te_e,
    pt_cb_f,
    pt_hb_f,
    pt_hs_f,
    pt_cs_f,
    pt_pme_f,
    pt_pe_f,
    pt_nr_f,
    pt_lo_f,
    pt_o_f,
    pt_sn_f,
    pt_te_f,
    pt_cb_g,
    pt_hb_g,
    pt_hs_g,
    pt_cs_g,
    pt_pme_g,
    pt_pe_g,
    pt_nr_g,
    pt_lo_g,
    pt_o_g,
    pt_sn_g,
    pt_te_g,
    pt_cb_h,
    pt_hb_h,
    pt_hs_h,
    pt_cs_h,
    pt_pme_h,
    pt_pe_h,
    pt_nr_h,
    pt_lo_h,
    pt_o_h,
    pt_sn_h,
    pt_te_h,
    pt_cb_i,
    pt_hb_i,
    pt_hs_i,
    pt_cs_i,
    pt_pme_i,
    pt_pe_i,
    pt_nr_i,
    pt_lo_i,
    pt_o_i,
    pt_sn_i,
    pt_te_i,
    pt_cb_j,
    pt_hb_j,
    pt_hs_j,
    pt_cs_j,
    pt_pme_j,
    pt_pe_j,
    pt_nr_j,
    pt_lo_j,
    pt_o_j,
    pt_sn_j,
    pt_te_j,
    ind_scr_fhxcc_fdr,
    dex_oth,
    addl_polyp,
    all_plps_rem,
    susp_ca,
    susp_ca_loc,
    susp_ca_siz,
    susp_ca_trt_cb,
    susp_ca_trt_hb,
    susp_ca_trt_hs,
    susp_ca_trt_cs,
    susp_ca_trt_pme,
    susp_ca_trt_pe,
    susp_ca_trt_nr,
    susp_ca_trt_lo,
    susp_ca_trt_o,
    susp_ca_trt_sn,
    susp_ca_trt_te,
    susp_crohns,
    susp_crohns_calced,
    susp_UC,
    susp_UC_calced,
    find_other,
    find_oth_bmc,
    find_oth_ibd,
    find_oth_biop,
    find_oth_other,
    prep,
    prep_type,
    meds_used_versed,
    meds_used_demerol,
    meds_used_fentanyl,
    meds_used_propofol,
    meds_used_none,
    meds_used_other,
    end_proc_stat_rr,
    abort_reas_pp,
    abort_reas_obs,
    abort_reas_sedprob,
    abort_reas_tc,
    abort_reas_oth,
    wthdrwl_time,
    comp_none,
    comp_bleed,
    comp_perf,
    comp_cardio,
    comp_resparr,
    comp_oth,
    fup_lt1,
    fup_2t3,
    fup_4t5,
    fup_6t9,
    fup_10,
    fup_gt10,
    fup_nfsi,
    fup_rwp,
    fup_pp,
    fup_baren,
    fup_othproc,
    fup_ctc,
    fup_surgcons,
    fup_pcp,
    fup_1t3,
    fup_6t10,
    dex_cbh_diarcons,
    dex_abd_pain,
    ind_scr_phxcca,
    ind_sur_phxplpcca,
    data_source,
    prep_typ_nulytely,
    prep_typ_halflytely,
    prep_typ_osmo,
    prep_typ_fleet,
    prep_typ_oth,
    vr_uccrohn,
    util_bool,
    computed_fnd_polyp,
    computed_fnd_siz,
    endo_code,
    f_reas_curex,
    f_reas_famhx,
    f_reas_perhx,
    f_reas_ibd,
    f_reas_oth,
    computed_normal_exam,
    computed_plp_trtmnt,
    computed_susp_ca_loc,
    computed_susp_ca_siz,
    computed_susp_ca_trtmnt,
    computed_susp_crohn,
    computed_susp_uc,
    computed_susp_other,
    su_cr_loc_ti,
    su_cr_loc_ce,
    su_cr_loc_ac,
    su_cr_loc_hf,
    su_cr_loc_tc,
    su_cr_loc_sf,
    su_cr_loc_dc,
    su_cr_loc_sg,
    su_cr_loc_re,
    su_cr_loc_u,
    su_uc_loc_ti,
    su_uc_loc_ce,
    su_uc_loc_ac,
    su_uc_loc_hf,
    su_uc_loc_tc,
    su_uc_loc_sf,
    su_uc_loc_dc,
    su_uc_loc_sg,
    su_uc_loc_re,
    su_uc_loc_u,
    indication_calculated,
    fu_form_completed,
    computed_susp_ca,
    p_flat_a,
    p_flat_b,
    p_flat_c,
    p_flat_d,
    p_flat_e,
    p_flat_f,
    p_flat_g,
    pth_req_id,
    find_calc_normal,
    find_calc_polyp,
    find_calc_cancer,
    find_calc_other,
    find_calc_nodata)
    select
    to_date(create_datetime, 'yyyy/mm/dd'),
    create_user,
    patient_id,
    visit_id,
    facility_id,
    facility_type,
    exam_date,
    teleform_formid,
    crs_batch,
    scan_batch,
    barcode,
    ind_scr_nosym,
    ind_scr_fhxcc,
    ind_scr_fhxplp,
    ind_sur_phxcc,
    ind_sur_phxplp,
    ind_sur_fhnpcc,
    ind_sur_ibd,
    ibdtyp_uc,
    idbtyp_crohn,
    ibdtyp_ind,
    ind_diag_exam,
    dex_bleed,
    dex_cbh_diar,
    dex_cbh_cons,
    dex_elim_ibd,
    dex_biop,
    dex_fobt,
    dex_abn_test,
    dex_abn_tst_ctc,
    dex_abn_tst_bar_en,
    dex_abn_tst_oth,
    dex_plpect_plp,
    dex_ida,
    convert_true_false(fnd_norm_ex),
    convert_true_false(fnd_plp),
    p_loc_a,
    p_loc_b,
    p_loc_c,
    p_loc_d,
    p_loc_e,
    p_loc_f,
    p_loc_g,
    p_loc_h,
    p_loc_i,
    p_loc_j,
    p_siz_a,
    p_siz_b,
    p_siz_c,
    p_siz_d,
    p_siz_e,
    p_siz_f,
    p_siz_g,
    p_siz_h,
    p_siz_i,
    p_siz_j,
    convert_true_false(pt_cb_a),
    convert_true_false(pt_hb_a),
    convert_true_false(pt_hs_a),
    convert_true_false(pt_cs_a),
    convert_true_false(pt_pme_a),
    convert_true_false(pt_pe_a),
    convert_true_false(pt_nr_a),
    convert_true_false(pt_lo_a),
    convert_true_false(pt_o_a),
    convert_true_false(pt_sn_a),
    convert_true_false(pt_te_a),
    convert_true_false(pt_cb_b),
    convert_true_false(pt_hb_b),
    convert_true_false(pt_hs_b),
    convert_true_false(pt_cs_b),
    convert_true_false(pt_pme_b),
    convert_true_false(pt_pe_b),
    convert_true_false(pt_nr_b),
    convert_true_false(pt_lo_b),
    convert_true_false(pt_o_b),
    convert_true_false(pt_sn_b),
    convert_true_false(pt_te_b),
    convert_true_false(pt_cb_c),
    convert_true_false(pt_hb_c),
    convert_true_false(pt_hs_c),
    convert_true_false(pt_cs_c),
    convert_true_false(pt_pme_c),
    convert_true_false(pt_pe_c),
    convert_true_false(pt_nr_c),
    convert_true_false(pt_lo_c),
    convert_true_false(pt_o_c),
    convert_true_false(pt_sn_c),
    convert_true_false(pt_te_c),
    convert_true_false(pt_cb_d),
    convert_true_false(pt_hb_d),
    convert_true_false(pt_hs_d),
    convert_true_false(pt_cs_d),
    convert_true_false(pt_pme_d),
    convert_true_false(pt_pe_d),
    convert_true_false(pt_nr_d),
    convert_true_false(pt_lo_d),
    convert_true_false(pt_o_d),
    convert_true_false(pt_sn_d),
    convert_true_false(pt_te_d),
    convert_true_false(pt_cb_e),
    convert_true_false(pt_hb_e),
    convert_true_false(pt_hs_e),
    convert_true_false(pt_cs_e),
    convert_true_false(pt_pme_e),
    convert_true_false(pt_pe_e),
    convert_true_false(pt_nr_e),
    convert_true_false(pt_lo_e),
    convert_true_false(pt_o_e),
    convert_true_false(pt_sn_e),
    convert_true_false(pt_te_e),
    convert_true_false(pt_cb_f),
    convert_true_false(pt_hb_f),
    convert_true_false(pt_hs_f),
    convert_true_false(pt_cs_f),
    convert_true_false(pt_pme_f),
    convert_true_false(pt_pe_f),
    convert_true_false(pt_nr_f),
    convert_true_false(pt_lo_f),
    convert_true_false(pt_o_f),
    convert_true_false(pt_sn_f),
    convert_true_false(pt_te_f),
    convert_true_false(pt_cb_g),
    convert_true_false(pt_hb_g),
    convert_true_false(pt_hs_g),
    convert_true_false(pt_cs_g),
    convert_true_false(pt_pme_g),
    convert_true_false(pt_pe_g),
    convert_true_false(pt_nr_g),
    convert_true_false(pt_lo_g),
    convert_true_false(pt_o_g),
    convert_true_false(pt_sn_g),
    convert_true_false(pt_te_g),
    convert_true_false(pt_cb_h),
    convert_true_false(pt_hb_h),
    convert_true_false(pt_hs_h),
    convert_true_false(pt_cs_h),
    convert_true_false(pt_pme_h),
    convert_true_false(pt_pe_h),
    convert_true_false(pt_nr_h),
    convert_true_false(pt_lo_h),
    convert_true_false(pt_o_h),
    convert_true_false(pt_sn_h),
    convert_true_false(pt_te_h),
    convert_true_false(pt_cb_i),
    convert_true_false(pt_hb_i),
    convert_true_false(pt_hs_i),
    convert_true_false(pt_cs_i),
    convert_true_false(pt_pme_i),
    convert_true_false(pt_pe_i),
    convert_true_false(pt_nr_i),
    convert_true_false(pt_lo_i),
    convert_true_false(pt_o_i),
    convert_true_false(pt_sn_i),
    convert_true_false(pt_te_i),
    convert_true_false(pt_cb_j),
    convert_true_false(pt_hb_j),
    convert_true_false(pt_hs_j),
    convert_true_false(pt_cs_j),
    convert_true_false(pt_pme_j),
    convert_true_false(pt_pe_j),
    convert_true_false(pt_nr_j),
    convert_true_false(pt_lo_j),
    convert_true_false(pt_o_j),
    convert_true_false(pt_sn_j),
    convert_true_false(pt_te_j),
    ind_scr_fhxcc_fdr,
    convert_true_false(dex_oth),
    addl_polyp,
    all_plps_rem,
    convert_true_false(susp_ca),
    susp_ca_loc,
    susp_ca_siz,
    convert_true_false(susp_ca_trt_cb),
    convert_true_false(susp_ca_trt_hb),
    convert_true_false(susp_ca_trt_hs),
    convert_true_false(susp_ca_trt_cs),
    convert_true_false(susp_ca_trt_pme),
    convert_true_false(susp_ca_trt_pe),
    convert_true_false(susp_ca_trt_nr),
    convert_true_false(susp_ca_trt_lo),
    convert_true_false(susp_ca_trt_o),
    convert_true_false(susp_ca_trt_sn),
    convert_true_false(susp_ca_trt_te),
    susp_crohns,
    convert_true_false(susp_crohns_calced),
    susp_UC,
    convert_true_false(susp_UC_calced),
    convert_true_false(find_other),
    convert_true_false(find_oth_bmc),
    convert_true_false(find_oth_ibd),
    convert_true_false(find_oth_biop),
    convert_true_false(find_oth_other),
    prep,
    prep_type,
    convert_true_false(meds_used_versed),
    convert_true_false(meds_used_demerol),
    convert_true_false(meds_used_fentanyl),
    convert_true_false(meds_used_propofol),
    convert_true_false(meds_used_none),
    convert_true_false(meds_used_other),
    end_proc_stat_rr,
    abort_reas_pp,
    abort_reas_obs,
    abort_reas_sedprob,
    abort_reas_tc,
    abort_reas_oth,
    wthdrwl_time,
    comp_none,
    comp_bleed,
    comp_perf,
    comp_cardio,
    comp_resparr,
    comp_oth,
    fup_lt1,
    fup_2t3,
    fup_4t5,
    fup_6t9,
    fup_10,
    fup_gt10,
    fup_nfsi,
    fup_rwp,
    fup_pp,
    fup_baren,
    fup_othproc,
    fup_ctc,
    fup_surgcons,
    fup_pcp,
    fup_1t3,
    fup_6t10,
    convert_true_false(dex_cbh_diarcons),
    convert_true_false(dex_abd_pain),
    convert_true_false(ind_scr_phxcca),
    convert_true_false(ind_sur_phxplpcca),
    data_source,
    convert_true_false(prep_typ_nulytely),
    convert_true_false(prep_typ_halflytely),
    convert_true_false(prep_typ_osmo),
    convert_true_false(prep_typ_fleet),
    convert_true_false(prep_typ_oth),
    convert_true_false(vr_uccrohn),
    convert_true_false(util_bool),
    convert_true_false(computed_fnd_polyp),
    convert_true_false(computed_fnd_siz),
    endo_code,
    f_reas_curex,
    f_reas_famhx,
    f_reas_perhx,
    f_reas_ibd,
    f_reas_oth,
    convert_true_false(computed_normal_exam),
    convert_true_false(computed_plp_trtmnt),
    convert_true_false(computed_susp_ca_loc),
    convert_true_false(computed_susp_ca_siz),
    convert_true_false(computed_susp_ca_trtmnt),
    convert_true_false(computed_susp_crohn),
    convert_true_false(computed_susp_uc),
    convert_true_false(computed_susp_other),
    convert_true_false(su_cr_loc_ti),
    convert_true_false(su_cr_loc_ce),
    convert_true_false(su_cr_loc_ac),
    convert_true_false(su_cr_loc_hf),
    convert_true_false(su_cr_loc_tc),
    convert_true_false(su_cr_loc_sf),
    convert_true_false(su_cr_loc_dc),
    convert_true_false(su_cr_loc_sg),
    convert_true_false(su_cr_loc_re),
    convert_true_false(su_cr_loc_u),
    convert_true_false(su_uc_loc_ti),
    convert_true_false(su_uc_loc_ce),
    convert_true_false(su_uc_loc_ac),
    convert_true_false(su_uc_loc_hf),
    convert_true_false(su_uc_loc_tc),
    convert_true_false(su_uc_loc_sf),
    convert_true_false(su_uc_loc_dc),
    convert_true_false(su_uc_loc_sg),
    convert_true_false(su_uc_loc_re),
    convert_true_false(su_uc_loc_u),
    indication_calculated,
    convert_true_false(fu_form_completed),
    convert_true_false(computed_susp_ca),
    convert_true_false(p_flat_a),
    convert_true_false(p_flat_b),
    convert_true_false(p_flat_c),
    convert_true_false(p_flat_d),
    convert_true_false(p_flat_e),
    convert_true_false(p_flat_f),
    convert_true_false(p_flat_g),
    pth_req_id,
    convert_true_false(find_calc_normal),
    convert_true_false(find_calc_polyp),
    convert_true_false(find_calc_cancer),
    convert_true_false(find_calc_other),
    convert_true_false(find_calc_nodata)
    from colo_import2
    order by 
    visit_id;
end;
$BODY$
language plpgsql;