create table import_scanned_proc_data (
    id serial not null,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    time_stamp character varying,
    verify_wks character varying,
    form_id character varying,
    bat_no bigint,
    bat_dir character varying,
    batchpgno integer,
    batchpgcnt integer,
    ind_scr_nosym character varying,
    fhxcc character varying,
    fhxplp character varying,
    phxcc character varying,
    phxplp character varying,
    fhnpcc character varying,
    ibd character varying,
    isfhcc character varying,
    ibdt_uc character varying,
    ibdt_crohn character varying,
    ibdt_ind character varying,
    inddiag character varying,
    bleed character varying,
    cbh_diar character varying,
    cbh_cons character varying,
    elim_ibd character varying,
    biop_sus_ca character varying,
    pos_fobt character varying,
    abn_tst character varying,
    plpt_plp character varying,
    ida character varying,
    oth character varying,
    dea_ctc character varying,
    dea_bar_en character varying,
    dea_oth character varying,
    find_norm character varying,
    find_polyp character varying,
    polyp_loc_a character varying,
    polyp_loc_b character varying,
    polyp_loc_c character varying,
    polyp_loc_d character varying,
    polyp_loc_e character varying,
    polyp_loc_f character varying,
    polyp_loc_g character varying,
    polyp_siz_a character varying,
    polyp_siz_b character varying,
    polyp_siz_c character varying,
    polyp_siz_d character varying,
    polyp_siz_e character varying,
    polyp_siz_f character varying,
    polyp_siz_g character varying,
    pt_cb_a character varying,
    pt_hb_a character varying,
    pt_hs_a character varying,
    pt_cs_a character varying,
    pt_pme_a character varying,
    pt_pe_a character varying,
    pt_nr_a character varying,
    pt_lo_a character varying,
    pt_o_a character varying,
    pt_cb_b character varying,
    pt_hb_b character varying,
    pt_hs_b character varying,
    pt_cs_b character varying,
    pt_pme_b character varying,
    pt_pe_b character varying,
    pt_nr_b character varying,
    pt_lo_b character varying,
    pt_o_b character varying,
    pt_cb_c character varying,
    pt_hb_c character varying,
    pt_hs_c character varying,
    pt_cs_c character varying,
    pt_pme_c character varying,
    pt_pe_c character varying,
    pt_nr_c character varying,
    pt_lo_c character varying,
    pt_o_c character varying,
    pt_cb_d character varying,
    pt_hb_d character varying,
    pt_hs_d character varying,
    pt_cs_d character varying,
    pt_pme_d character varying,
    pt_pe_d character varying,
    pt_nr_d character varying,
    pt_lo_d character varying,
    pt_o_d character varying,
    pt_cb_e character varying,
    pt_hb_e character varying,
    pt_hs_e character varying,
    pt_cs_e character varying,
    pt_pme_e character varying,
    pt_pe_e character varying,
    pt_nr_e character varying,
    pt_lo_e character varying,
    pt_o_e character varying,
    pt_cb_f character varying,
    pt_hb_f character varying,
    pt_hs_f character varying,
    pt_cs_f character varying,
    pt_pme_f character varying,
    pt_pe_f character varying,
    pt_nr_f character varying,
    pt_lo_f character varying,
    pt_o_f character varying,
    pt_cb_g character varying,
    pt_hb_g character varying,
    pt_hs_g character varying,
    pt_cs_g character varying,
    pt_pme_g character varying,
    pt_pe_g character varying,
    pt_nr_g character varying,
    pt_lo_g character varying,
    pt_o_g character varying,
    addl_plp character varying,
    allpolprem character varying,
    find_ca character varying,
    find_crohns character varying,
    cr_ti character varying,
    cr_ce character varying,
    cr_ac character varying,
    cr_hf character varying,
    cr_tc character varying,
    cr_sf character varying,
    cr_dc character varying,
    cr_sg character varying,
    cr_re character varying,
    cr_u character varying,
    find_uc character varying,
    uc_ti character varying,
    uc_ce character varying,
    uc_ac character varying,
    uc_hf character varying,
    uc_tc character varying,
    uc_sf character varying,
    uc_dc character varying,
    uc_sg character varying,
    uc_re character varying,
    uc_u character varying,
    cal_ti character varying,
    cal_ce character varying,
    cal_ac character varying,
    cal_hf character varying,
    cal_tc character varying,
    cal_sf character varying,
    cal_dc character varying,
    cal_sg character varying,
    cal_re character varying,
    cal_u character varying,
    cas_lt5mm character varying,
    cas_5t9mm character varying,
    cas_1t2cm character varying,
    cas_gt2cm character varying,
    cat_cb character varying,
    cat_hb character varying,
    cat_hs character varying,
    cat_cs character varying,
    cat_pme character varying,
    cat_pe character varying,
    cat_nr character varying,
    cat_lo character varying,
    cat_o character varying,
    find_oth character varying,
    o_oth character varying,
    o_bmc character varying,
    o_bop character varying,
    o_br character varying,
    preparation character varying,
    prep_typ character varying,
    meds_used_versed character varying,
    meds_used_demerol character varying,
    meds_used_fentanyl character varying,
    meds_used_propofol character varying,
    meds_used_other character varying,
    meds_used_none character varying,
    end_proc_stat character varying,
    pa_pp character varying,
    pa_sed_prob character varying,
    pa_obs character varying,
    pa_oth character varying,
    pa_tc character varying,
    wthdrwl_time character varying,
    cpml_none character varying,
    cpml_bleed character varying,
    cpml_perf character varying,
    cpml_cardio character varying,
    cpml_other character varying,
    cpml_resp_arr character varying,
    fr_lt1 character varying,
    fr_2t3 character varying,
    fr_bar_en character varying,
    fr_oth character varying,
    fr_surg character varying,
    fr_pnd_pth character varying,
    fr_4t5 character varying,
    fr_6t9 character varying,
    fr_10 character varying,
    fr_gt10 character varying,
    fr_nfsi character varying,
    fr_fup_pcp character varying,
    fr_ctc character varying,
    fr_rp character varying,
    f_reas_cur_ex character varying,
    f_reas_fam_hist character varying,
    f_reas_ibd character varying,
    f_reas_oth character varying,
    f_reas_pershx character varying,
    barcode character varying,
    person_id bigint,
    dead boolean,
    refused boolean,
    gender character varying,
    facility_id character varying,
    endo_code character varying,
    report_code character varying,
    added_to_colo boolean,
    event_id bigint,
    event_date date,
    cprs_batch_id bigint,
    primary key (id)
);
alter table import_scanned_proc_data
    owner to informatics;
grant all on table specimen to informatics;