create function has_colo (in in_event_id integer)
returns varchar AS
$BODY$
declare lcl_return varchar;
begin


if not exists (select * from colo where event_id = in_event_id) then 
    select 'no'  into lcl_return;
elseif exists (select * from colo where event_id = in_event_id and
	(ind_scr_nosym = '0' or ind_scr_nosym is null) and
	(ind_scr_fhxcc = '0' or  ind_scr_fhxcc is null) and 
	(ind_scr_fhxplp = '0' or  ind_scr_fhxplp is null ) and 
	(ind_sur_phxcc = '0' or ind_sur_phxcc is null ) and 
	(ind_sur_phxplp = '0' or ind_sur_phxplp is null ) and 
	(ind_sur_fhnpcc = '0' or ind_sur_fhnpcc is null ) and 
	(ind_sur_ibd = '0' or ind_sur_ibd is null ) and 
	(ibdtyp_uc = '0' or ibdtyp_uc is null ) and 
	(ibdtyp_crohn = '0' or ibdtyp_crohn is null ) and 
	(ibdtyp_ind = '0' or ibdtyp_ind is null ) and 
	(ind_diag_exam = '0' or ind_diag_exam is null ) and 
	(dex_bleed = '0' or dex_bleed is null ) and 
	(dex_cbh_diar = '0' or dex_cbh_diar is null ) and 
	(dex_cbh_cons = '0' or dex_cbh_cons is null ) and 
	(dex_elim_ibd = '0' or dex_elim_ibd is null ) and 
	(dex_biop = '0' or dex_biop is null ) and 
	(dex_fobt = '0' or dex_fobt is null ) and 
	(dex_abn_test = '0' or dex_abn_test is null ) and 
	(dex_abn_tst_ctc = '0' or dex_abn_tst_ctc is null ) and 
	(dex_abn_tst_bar_en = '0' or dex_abn_tst_bar_en is null ) and 
	(dex_abn_tst_oth = '0' or dex_abn_tst_oth is null ) and 
	(dex_plpect_plp = '0' or dex_plpect_plp is null ) and 
	(dex_ida = '0' or dex_ida is null ) and 
	(fnd_norm_ex = 0 or fnd_norm_ex is null ) and 
	(fnd_plp = 0 or fnd_plp is null ) and 
	(p_loc_a = '99' or p_loc_a = '' or p_loc_a is null ) and 
	(p_loc_b = '99' or p_loc_b = '' or p_loc_b is null ) and 
	(p_loc_c = '99' or p_loc_c = '' or p_loc_c = '' or p_loc_c is null ) and 
	(p_loc_d = '99' or p_loc_d = '' or p_loc_d is null ) and 
	(p_loc_e = '99' or p_loc_d = '' or p_loc_e is null ) and 
	(p_loc_f = '99' or p_loc_f = '' or p_loc_f is null ) and 
	(p_loc_g = '99' or p_loc_g = '' or p_loc_g is null ) and 
	(p_loc_h = '99' or p_loc_h = '' or p_loc_h is null ) and 
	(p_loc_i = '99' or p_loc_i = '' or p_loc_i is null ) and 
	(p_loc_j = '99' or p_loc_j = '' or p_loc_j is null ) and 
	(p_siz_a = '99' or p_siz_a is null ) and 
	(p_siz_b = '99' or p_siz_b is null ) and 
	(p_siz_c = '99' or p_siz_c is null ) and 
	(p_siz_d = '99' or p_siz_d is null ) and 
	(p_siz_e = '99' or p_siz_e is null ) and 
	(p_siz_f = '99' or p_siz_f is null ) and 
	(p_siz_g = '99' or p_siz_g is null ) and 
	(p_siz_h = '99' or p_siz_h is null ) and 
	(p_siz_i = '99' or p_siz_i is null ) and 
	(p_siz_j = '99' or p_siz_j is null ) and 
	(pt_cb_a = 0 or pt_cb_a is null ) and 
	(pt_hb_a = 0 or pt_hb_a is null ) and 
	(pt_hs_a = 0 or pt_hs_a is null ) and 
	(pt_cs_a = 0 or pt_cs_a is null ) and 
	(pt_pme_a = 0 or pt_pme_a is null ) and 
	(pt_pe_a = 0 or pt_pe_a is null ) and 
	(pt_nr_a = 0 or pt_nr_a is null ) and 
	(pt_lo_a = 0 or pt_lo_a is null ) and 
	(pt_o_a = 0 or pt_o_a is null ) and 
	(pt_sn_a = 0 or pt_sn_a is null ) and 
	(pt_te_a = 0 or pt_te_a is null ) and 
	(pt_cb_b = 0 or pt_cb_b is null ) and 
	(pt_hb_b = 0 or pt_hb_b is null ) and 
	(pt_hs_b = 0 or pt_hs_b is null ) and 
	(pt_cs_b = 0 or pt_cs_b is null ) and 
	(pt_pme_b = 0 or pt_pme_b is null ) and 
	(pt_pe_b = 0 or pt_pe_b is null ) and 
	(pt_nr_b = 0 or pt_nr_b is null ) and 
	(pt_lo_b = 0 or pt_lo_b is null ) and 
	(pt_o_b = 0 or pt_o_b is null ) and 
	(pt_sn_b = 0 or pt_sn_b is null ) and 
	(pt_te_b = 0 or pt_te_b is null ) and 
	(pt_cb_c = 0 or pt_cb_c is null ) and 
	(pt_hb_c = 0 or pt_hb_c is null ) and 
	(pt_hs_c = 0 or pt_hs_c is null ) and 
	(pt_cs_c = 0 or pt_cs_c is null ) and 
	(pt_pme_c = 0 or pt_pme_c is null ) and 
	(pt_pe_c = 0 or pt_pe_c is null ) and 
	(pt_nr_c = 0 or pt_nr_c is null ) and 
	(pt_lo_c = 0 or pt_lo_c is null ) and 
	(pt_o_c = 0 or pt_o_c is null ) and 
	(pt_sn_c = 0 or pt_sn_c is null ) and 
	(pt_te_c = 0 or pt_te_c is null ) and 
	(pt_cb_d = 0 or pt_cb_d is null ) and 
	(pt_hb_d = 0 or pt_hb_d is null ) and 
	(pt_hs_d = 0 or pt_hs_d is null ) and 
	(pt_cs_d = 0 or pt_cs_d is null ) and 
	(pt_pme_d = 0 or pt_pme_d is null ) and 
	(pt_pe_d = 0 or pt_pe_d is null ) and 
	(pt_nr_d = 0 or pt_nr_d is null ) and 
	(pt_lo_d = 0 or pt_lo_d is null ) and 
	(pt_o_d = 0 or pt_o_d is null ) and 
	(pt_sn_d = 0 or pt_sn_d is null ) and 
	(pt_te_d = 0 or pt_te_d is null ) and 
	(pt_cb_e = 0 or pt_cb_e is null ) and 
	(pt_hb_e = 0 or pt_hb_e is null ) and 
	(pt_hs_e = 0 or pt_hs_e is null ) and 
	(pt_cs_e = 0 or pt_cs_e is null ) and 
	(pt_pme_e = 0 or pt_pme_e is null ) and 
	(pt_pe_e = 0 or pt_pe_e is null ) and 
	(pt_nr_e = 0 or pt_nr_e is null ) and 
	(pt_lo_e = 0 or pt_lo_e is null ) and 
	(pt_o_e = 0 or pt_o_e is null ) and 
	(pt_sn_e = 0 or pt_sn_e is null ) and 
	(pt_te_e = 0 or pt_te_e is null ) and 
	(pt_cb_f = 0 or pt_cb_f is null ) and 
	(pt_hb_f = 0 or pt_hb_f is null ) and 
	(pt_hs_f = 0 or pt_hs_f is null ) and 
	(pt_cs_f = 0 or pt_cs_f is null ) and 
	(pt_pme_f = 0 or pt_pme_f is null ) and 
	(pt_pe_f = 0 or pt_pe_f is null ) and 
	(pt_nr_f = 0 or pt_nr_f is null ) and 
	(pt_lo_f = 0 or pt_lo_f is null ) and 
	(pt_o_f = 0 or pt_o_f is null ) and 
	(pt_sn_f = 0 or pt_sn_f is null ) and 
	(pt_te_f = 0 or pt_te_f is null ) and 
	(pt_cb_g = 0 or pt_cb_g is null ) and 
	(pt_hb_g = 0 or pt_hb_g is null ) and 
	(pt_hs_g = 0 or pt_hs_g is null ) and 
	(pt_cs_g = 0 or pt_cs_g is null ) and 
	(pt_pme_g = 0 or pt_pme_g is null ) and 
	(pt_pe_g = 0 or pt_pe_g is null ) and 
	(pt_nr_g = 0 or pt_nr_g is null ) and 
	(pt_lo_g = 0 or pt_lo_g is null ) and 
	(pt_o_g = 0 or pt_o_g is null ) and 
	(pt_sn_g = 0 or pt_sn_g is null ) and 
	(pt_te_g = 0 or pt_te_g is null ) and 
	(pt_cb_h = 0 or pt_cb_h is null ) and 
	(pt_hb_h = 0 or pt_hb_h is null ) and 
	(pt_hs_h = 0 or pt_hs_h is null ) and 
	(pt_cs_h = 0 or pt_cs_h is null ) and 
	(pt_pme_h = 0 or pt_pme_h is null ) and 
	(pt_pe_h = 0 or pt_pe_h is null ) and 
	(pt_nr_h = 0 or pt_nr_h is null ) and 
	(pt_lo_h = 0 or pt_lo_h is null ) and 
	(pt_o_h = 0 or pt_o_h is null ) and 
	(pt_sn_h = 0 or pt_sn_h is null ) and 
	(pt_te_h = 0 or pt_te_h is null ) and 
	(pt_cb_i = 0 or pt_cb_i is null ) and 
	(pt_hb_i = 0 or pt_hb_i is null ) and 
	(pt_hs_i = 0 or pt_hs_i is null ) and 
	(pt_cs_i = 0 or pt_cs_i is null ) and 
	(pt_pme_i = 0 or pt_pme_i is null ) and 
	(pt_pe_i = 0 or pt_pe_i is null ) and 
	(pt_nr_i = 0 or pt_nr_i is null ) and 
	(pt_lo_i = 0 or pt_lo_i is null ) and 
	(pt_o_i = 0 or pt_o_i is null ) and 
	(pt_sn_i = 0 or pt_sn_i is null ) and 
	(pt_te_i = 0 or pt_te_i is null ) and 
	(pt_cb_j = 0 or pt_cb_j is null ) and 
	(pt_hb_j = 0 or pt_hb_j is null ) and 
	(pt_hs_j = 0 or pt_hs_j is null ) and 
	(pt_cs_j = 0 or pt_cs_j is null ) and 
	(pt_pme_j = 0 or pt_pme_j is null ) and 
	(pt_pe_j = 0 or pt_pe_j is null ) and 
	(pt_nr_j = 0 or pt_nr_j is null ) and 
	(pt_lo_j = 0 or pt_lo_j is null ) and 
	(pt_o_j = 0 or pt_o_j is null ) and 
	(pt_sn_j = 0 or pt_sn_j is null ) and 
	(pt_te_j = 0 or pt_te_j is null ) and 
	(ind_scr_fhxcc_fdr = '0' or ind_scr_fhxcc_fdr = '8' or ind_scr_fhxcc_fdr = '9' or ind_scr_fhxcc_fdr is null ) and 
	(dex_oth = 0 or dex_oth is null ) and 
	(addl_polyp = '0' or addl_polyp = '9' or addl_polyp is null ) and 
	(all_plps_rem = '0' or all_plps_rem = '8' or all_plps_rem = '9' or all_plps_rem is null ) and 
	(susp_ca = 0 or susp_ca = 9 or  susp_ca is null ) and 
	(susp_ca_loc = '0' or susp_ca_loc = '99' or susp_ca_loc is null ) and 
	(susp_ca_siz = '0' or susp_ca_siz = '99' or susp_ca_siz is null ) and 
	(susp_ca_trt_cb = 0 or susp_ca_trt_cb is null ) and 
	(susp_ca_trt_hb = 0 or susp_ca_trt_hb is null ) and 
	(susp_ca_trt_hs = 0 or susp_ca_trt_hs is null ) and 
	(susp_ca_trt_cs = 0 or susp_ca_trt_cs is null ) and 
	(susp_ca_trt_pme = 0 or susp_ca_trt_pme is null ) and 
	(susp_ca_trt_pe = 0 or susp_ca_trt_pe is null ) and 
	(susp_ca_trt_nr = 0 or susp_ca_trt_nr is null ) and 
	(susp_ca_trt_lo = 0 or susp_ca_trt_lo is null ) and 
	(susp_ca_trt_o = 0 or susp_ca_trt_o is null ) and 
	(susp_ca_trt_sn = 0 or susp_ca_trt_sn is null ) and 
	(susp_ca_trt_te = 0 or susp_ca_trt_te is null ) and 
	(susp_crohns = '0' or susp_crohns is null or susp_crohns = '9') and 
	(susp_UC = '0' or susp_UC is null or susp_UC = '9') and 
	(find_other = 0 or find_other = 9 or find_other is null ) and 
	(find_oth_bmc = 0 or find_oth_bmc is null ) and 
	(find_oth_ibd = 0 or find_oth_ibd is null ) and 
	(find_oth_biop = 0 or find_oth_biop is null ) and 
	(find_oth_other = 0 or find_oth_other is null ) and 
	(prep = '0' or prep = '9' or prep is null ) and 
	(prep_type = '0' or prep_type = '9' or prep_type is null ) and 
	(meds_used_versed = 0 or meds_used_versed is null ) and 
	(meds_used_demerol = 0 or meds_used_demerol is null ) and 
	(meds_used_fentanyl = 0 or meds_used_fentanyl is null ) and 
	(meds_used_propofol = 0 or meds_used_propofol is null ) and 
	(meds_used_none = 0 or meds_used_none is null ) and 
	(meds_used_other = 0 or meds_used_other is null ) and 
	(end_proc_stat_rr = '0' or end_proc_stat_rr = '99' or end_proc_stat_rr is null ) and 
	(abort_reas_pp = '0' or abort_reas_pp is null ) and 
	(abort_reas_obs = '0' or abort_reas_obs is null ) and 
	(abort_reas_sedprob = '0' or abort_reas_sedprob is null ) and 
	(abort_reas_tc = '0' or abort_reas_tc is null ) and 
	(abort_reas_oth = '0' or abort_reas_oth is null ) and 
	(wthdrwl_time = '0' or wthdrwl_time = '88' or wthdrwl_time = '99' or wthdrwl_time is null ) and 
	(comp_none = '0' or comp_none is null ) and 
	(comp_bleed = '0' or comp_bleed is null ) and 
	(comp_perf = '0' or comp_perf is null ) and 
	(comp_cardio = '0' or comp_cardio is null ) and 
	(comp_resparr = '0' or comp_resparr is null ) and 
	(comp_oth = '0' or comp_oth is null ) and 
	(fup_lt1 = '0' or fup_lt1 is null ) and 
	(fup_2t3 = '0' or fup_2t3 is null ) and 
	(fup_4t5 = '0' or fup_4t5 is null ) and 
	(fup_6t9 = '0' or fup_6t9 is null ) and 
	(fup_10 = '0' or fup_10 is null ) and 
	(fup_gt10 = '0' or fup_gt10 is null ) and 
	(fup_nfsi = '0' or fup_nfsi is null ) and 
	(fup_rwp = '0' or fup_rwp is null ) and 
	(fup_pp = '0' or fup_pp is null ) and 
	(fup_baren = '0' or fup_baren is null ) and 
	(fup_othproc = '0' or fup_othproc is null ) and 
	(fup_ctc = '0' or fup_ctc is null ) and 
	(fup_surgcons = '0' or fup_surgcons is null ) and 
	(fup_pcp = '0' or fup_pcp is null ) and 
	(fup_1t3 = '0' or fup_1t3 is null ) and 
	(fup_6t10 = '0' or fup_6t10 is null ) and 
	(dex_cbh_diarcons = 0 or dex_cbh_diarcons is null ) and 
	(dex_abd_pain = 0 or dex_abd_pain is null ) and 
	(ind_scr_phxcca = 0 or ind_scr_phxcca is null ) and 
	(ind_sur_phxplpcca = 0 or ind_sur_phxplpcca is null ) and 
	(data_source = '0' or data_source is null ) and 
	(prep_typ_nulytely = 0 or prep_typ_nulytely is null ) and 
	(prep_typ_halflytely = 0 or prep_typ_halflytely is null ) and 
	(prep_typ_osmo = 0 or prep_typ_osmo is null ) and 
	(prep_typ_fleet = 0 or prep_typ_fleet is null ) and 
	(prep_typ_oth = 0 or prep_typ_oth is null ) and 
	(vr_uccrohn = 0 or vr_uccrohn is null ) and 
	(util_bool = 0 or util_bool is null ) and 
	(f_reas_curex = '0' or f_reas_curex = '8' or f_reas_curex is null ) and 
	(f_reas_famhx = '0' or f_reas_famhx = '8' or f_reas_famhx is null ) and 
	(f_reas_perhx = '0' or f_reas_perhx = '8' or f_reas_perhx is null ) and 
	(f_reas_ibd = '0' or f_reas_ibd = '8' or f_reas_ibd is null ) and 
	(f_reas_oth = '0' or f_reas_oth = '8' or f_reas_oth is null ) and 
	(su_cr_loc_ti = 0 or su_cr_loc_ti is null ) and 
	(su_cr_loc_ce = 0 or su_cr_loc_ce is null ) and 
	(su_cr_loc_ac = 0 or su_cr_loc_ac is null ) and 
	(su_cr_loc_hf = 0 or su_cr_loc_hf is null ) and 
	(su_cr_loc_tc = 0 or su_cr_loc_tc is null ) and 
	(su_cr_loc_sf = 0 or su_cr_loc_sf is null ) and 
	(su_cr_loc_dc = 0 or su_cr_loc_dc is null ) and 
	(su_cr_loc_sg = 0 or su_cr_loc_sg is null ) and 
	(su_cr_loc_re = 0 or su_cr_loc_re is null ) and 
	(su_cr_loc_u = 0 or su_cr_loc_u is null ) and 
	(su_uc_loc_ti = 0 or su_uc_loc_ti is null ) and 
	(su_uc_loc_ce = 0 or su_uc_loc_ce is null ) and 
	(su_uc_loc_ac = 0 or su_uc_loc_ac is null ) and 
	(su_uc_loc_hf = 0 or su_uc_loc_hf is null ) and 
	(su_uc_loc_tc = 0 or su_uc_loc_tc is null ) and 
	(su_uc_loc_sf = 0 or su_uc_loc_sf is null ) and 
	(su_uc_loc_dc = 0 or su_uc_loc_dc is null ) and 
	(su_uc_loc_sg = 0 or su_uc_loc_sg is null ) and 
	(su_uc_loc_re = 0 or su_uc_loc_re is null ) and 
	(su_uc_loc_u = 0 or su_uc_loc_u is null ) and 
	(p_flat_a = 0 or p_flat_a is null ) and 
	(p_flat_b = 0 or p_flat_b is null ) and 
	(p_flat_c = 0 or p_flat_c is null ) and 
	(p_flat_d = 0 or p_flat_d is null ) and 
	(p_flat_e = 0 or p_flat_e is null ) and 
	(p_flat_f = 0 or p_flat_f is null ) and 
	(p_flat_g = 0 or p_flat_g is null)) then 
        select 'empty' into lcl_return;
    else
        select 'yes' into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql