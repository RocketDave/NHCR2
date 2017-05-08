﻿create table colo (
    colo_id serial,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    patient_id varchar,
    event_id integer unique,
    facility_id varchar,
    facility_type varchar,
    exam_date date,
    teleform_formid varchar,
    crs_batch integer,
    scan_batch integer,
    barcode varchar,
    ind_scr_nosym varchar,
    ind_scr_fhxcc varchar,
    ind_scr_fhxplp varchar,
    ind_sur_phxcc varchar,
    ind_sur_phxplp varchar,
    ind_sur_fhnpcc varchar,
    ind_sur_ibd varchar,
    ibdtyp_uc varchar,
    ibdtyp_crohn varchar,
    ibdtyp_ind varchar,
    ind_diag_exam varchar,
    dex_bleed varchar,
    dex_cbh_diar varchar,
    dex_cbh_cons varchar,
    dex_elim_ibd varchar,
    dex_biop varchar,
    dex_fobt varchar,
    dex_abn_test varchar,
    dex_abn_tst_ctc varchar,
    dex_abn_tst_bar_en varchar,
    dex_abn_tst_oth varchar,
    dex_plpect_plp varchar,
    dex_ida varchar,
    fnd_norm_ex smallint,
    fnd_plp smallint,
    p_loc_a varchar,
    p_loc_b varchar,
    p_loc_c varchar,
    p_loc_d varchar,
    p_loc_e varchar,
    p_loc_f varchar,
    p_loc_g varchar,
    p_loc_h varchar,
    p_loc_i varchar,
    p_loc_j varchar,
    p_siz_a varchar,
    p_siz_b varchar,
    p_siz_c varchar,
    p_siz_d varchar,
    p_siz_e varchar,
    p_siz_f varchar,
    p_siz_g varchar,
    p_siz_h varchar,
    p_siz_i varchar,
    p_siz_j varchar,
    pt_cb_a smallint,
    pt_hb_a smallint,
    pt_hs_a smallint,
    pt_cs_a smallint,
    pt_pme_a smallint,
    pt_pe_a smallint,
    pt_nr_a smallint,
    pt_lo_a smallint,
    pt_o_a smallint,
    pt_sn_a smallint,
    pt_te_a smallint,
    pt_cb_b smallint,
    pt_hb_b smallint,
    pt_hs_b smallint,
    pt_cs_b smallint,
    pt_pme_b smallint,
    pt_pe_b smallint,
    pt_nr_b smallint,
    pt_lo_b smallint,
    pt_o_b smallint,
    pt_sn_b smallint,
    pt_te_b smallint,
    pt_cb_c smallint,
    pt_hb_c smallint,
    pt_hs_c smallint,
    pt_cs_c smallint,
    pt_pme_c smallint,
    pt_pe_c smallint,
    pt_nr_c smallint,
    pt_lo_c smallint,
    pt_o_c smallint,
    pt_sn_c smallint,
    pt_te_c smallint,
    pt_cb_d smallint,
    pt_hb_d smallint,
    pt_hs_d smallint,
    pt_cs_d smallint,
    pt_pme_d smallint,
    pt_pe_d smallint,
    pt_nr_d smallint,
    pt_lo_d smallint,
    pt_o_d smallint,
    pt_sn_d smallint,
    pt_te_d smallint,
    pt_cb_e smallint,
    pt_hb_e smallint,
    pt_hs_e smallint,
    pt_cs_e smallint,
    pt_pme_e smallint,
    pt_pe_e smallint,
    pt_nr_e smallint,
    pt_lo_e smallint,
    pt_o_e smallint,
    pt_sn_e smallint,
    pt_te_e smallint,
    pt_cb_f smallint,
    pt_hb_f smallint,
    pt_hs_f smallint,
    pt_cs_f smallint,
    pt_pme_f smallint,
    pt_pe_f smallint,
    pt_nr_f smallint,
    pt_lo_f smallint,
    pt_o_f smallint,
    pt_sn_f smallint,
    pt_te_f smallint,
    pt_cb_g smallint,
    pt_hb_g smallint,
    pt_hs_g smallint,
    pt_cs_g smallint,
    pt_pme_g smallint,
    pt_pe_g smallint,
    pt_nr_g smallint,
    pt_lo_g smallint,
    pt_o_g smallint,
    pt_sn_g smallint,
    pt_te_g smallint,
    pt_cb_h smallint,
    pt_hb_h smallint,
    pt_hs_h smallint,
    pt_cs_h smallint,
    pt_pme_h smallint,
    pt_pe_h smallint,
    pt_nr_h smallint,
    pt_lo_h smallint,
    pt_o_h smallint,
    pt_sn_h smallint,
    pt_te_h smallint,
    pt_cb_i smallint,
    pt_hb_i smallint,
    pt_hs_i smallint,
    pt_cs_i smallint,
    pt_pme_i smallint,
    pt_pe_i smallint,
    pt_nr_i smallint,
    pt_lo_i smallint,
    pt_o_i smallint,
    pt_sn_i smallint,
    pt_te_i smallint,
    pt_cb_j smallint,
    pt_hb_j smallint,
    pt_hs_j smallint,
    pt_cs_j smallint,
    pt_pme_j smallint,
    pt_pe_j smallint,
    pt_nr_j smallint,
    pt_lo_j smallint,
    pt_o_j smallint,
    pt_sn_j smallint,
    pt_te_j smallint,
    ind_scr_fhxcc_fdr varchar,
    dex_oth smallint,
    addl_polyp varchar,
    all_plps_rem varchar,
    susp_ca smallint,
    susp_ca_loc varchar,
    susp_ca_siz varchar,
    susp_ca_trt_cb smallint,
    susp_ca_trt_hb smallint,
    susp_ca_trt_hs smallint,
    susp_ca_trt_cs smallint,
    susp_ca_trt_pme smallint,
    susp_ca_trt_pe smallint,
    susp_ca_trt_nr smallint,
    susp_ca_trt_lo smallint,
    susp_ca_trt_o smallint,
    susp_ca_trt_sn smallint,
    susp_ca_trt_te smallint,
    susp_crohns varchar,
    susp_crohns_calced smallint,
    susp_UC varchar,
    susp_UC_calced smallint,
    find_other smallint,
    find_oth_bmc smallint,
    find_oth_ibd smallint,
    find_oth_biop smallint,
    find_oth_other smallint,
    prep varchar,
    prep_type varchar,
    meds_used_versed smallint,
    meds_used_demerol smallint,
    meds_used_fentanyl smallint,
    meds_used_propofol smallint,
    meds_used_none smallint,
    meds_used_other smallint,
    end_proc_stat_rr varchar,
    abort_reas_pp varchar,
    abort_reas_obs varchar,
    abort_reas_sedprob varchar,
    abort_reas_tc varchar,
    abort_reas_oth varchar,
    wthdrwl_time varchar,
    comp_none varchar,
    comp_bleed varchar,
    comp_perf varchar,
    comp_cardio varchar,
    comp_resparr varchar,
    comp_oth varchar,
    fup_lt1 varchar,
    fup_2t3 varchar,
    fup_4t5 varchar,
    fup_6t9 varchar,
    fup_10 varchar,
    fup_gt10 varchar,
    fup_nfsi varchar,
    fup_rwp varchar,
    fup_pp varchar,
    fup_baren varchar,
    fup_othproc varchar,
    fup_ctc varchar,
    fup_surgcons varchar,
    fup_pcp varchar,
    fup_1t3 varchar,
    fup_6t10 varchar,
    dex_cbh_diarcons smallint,
    dex_abd_pain smallint,
    ind_scr_phxcca smallint,
    ind_sur_phxplpcca smallint,
    data_source varchar,
    prep_typ_nulytely smallint,
    prep_typ_halflytely smallint,
    prep_typ_osmo smallint,
    prep_typ_fleet smallint,
    prep_typ_oth smallint,
    vr_uccrohn smallint,
    util_bool smallint,
    computed_fnd_polyp smallint,
    computed_fnd_siz smallint,
    endo_code varchar,
    f_reas_curex varchar,
    f_reas_famhx varchar,
    f_reas_perhx varchar,
    f_reas_ibd varchar,
    f_reas_oth varchar,
    computed_normal_exam smallint,
    computed_plp_trtmnt smallint,
    computed_susp_ca_loc smallint,
    computed_susp_ca_siz smallint,
    computed_susp_ca_trtmnt smallint,
    computed_susp_crohn smallint,
    computed_susp_uc smallint,
    computed_susp_other smallint,
    su_cr_loc_ti smallint,
    su_cr_loc_ce smallint,
    su_cr_loc_ac smallint,
    su_cr_loc_hf smallint,
    su_cr_loc_tc smallint,
    su_cr_loc_sf smallint,
    su_cr_loc_dc smallint,
    su_cr_loc_sg smallint,
    su_cr_loc_re smallint,
    su_cr_loc_u smallint,
    su_uc_loc_ti smallint,
    su_uc_loc_ce smallint,
    su_uc_loc_ac smallint,
    su_uc_loc_hf smallint,
    su_uc_loc_tc smallint,
    su_uc_loc_sf smallint,
    su_uc_loc_dc smallint,
    su_uc_loc_sg smallint,
    su_uc_loc_re smallint,
    su_uc_loc_u smallint,
    indication_calculated varchar,
    fu_form_completed smallint,
    computed_susp_ca smallint,
    p_flat_a smallint,
    p_flat_b smallint,
    p_flat_c smallint,
    p_flat_d smallint,
    p_flat_e smallint,
    p_flat_f smallint,
    p_flat_g smallint,
    pth_req_id integer,
    find_calc_normal smallint,
    find_calc_polyp smallint,
    find_calc_cancer smallint,
    find_calc_other smallint,
    find_calc_nodata smallint,
    constraint colo_pkey PRIMARY KEY (colo_id)
);
ALTER TABLE colo
    OWNER TO informatics;
GRANT ALL ON TABLE colo TO informatics;

COMMENT ON TABLE colo
    IS 'Colonoscopy Form.';
-- Trigger: audit_colo on colo

-- DROP TRIGGER audit_colo ON colo;

--CREATE TRIGGER audit_colo
    --AFTER UPDATE OR DELETE
    --ON colo
    --FOR EACH ROW
    --EXECUTE PROCEDURE create_colo_audit_record();


