CREATE OR REPLACE VIEW vAll_e2 AS 
		 SELECT case
			when (p.c_event_id is not null) then p.c_event_id 
			when (p.s_event_id is not null) then p.s_event_id 
			else 
				c.c_event_id end  AS event_id, c.c_event_id, p.p2_event_id, 
			p.s_event_id, p.old_polyp_id, p.p_loc, p.p_siz, p.pt_cb, p.pt_hb, 
			p.pt_hs, p.pt_cs, p.pt_pme, p.pt_pe, p.pt_nr, p.pt_lo, p.pt_o, 
			p.pt_sn, p.pt_te, p.p2_notes, p.p_flat, p.specimen_id, 
			p.path_report_id, p.path_polyp_loc, p.polyp_num, 
			p.container, p.fragment, p.other_dx_specify, p.site_location_cm, 
			p.site_desc, p.size_mm, p.anallevel, p.flg_no_path_spec, 
			p.ptype_carcinoid, p.ptype_ganglio, p.ptype_hamart, p.ptype_hp, 
			p.ptype_inflam, p.ptype_juvenile, p.ptype_lelomyoma, p.ptype_lipoma, 
			p.ptype_mp, p.ptype_norm_muc, p.ptype_not_polyp, p.ptype_other, 
			p.ptype_pautzjeg, p.ptype_sa, p.ptype_ssp, p.ptype_mixed, 
			p.ptype_ta, p.ptype_tva, p.ptype_va, p.flg_dx, p.flg_no_discrep, 
			p.flg_no_q_spec, p.flg_num_polyps, p.flg_site_discrep, 
			p.flg_site_uncert, p.flg_path_sites, p.flg_review, p.hgd, p.ibd_ibd, 
			p.ibd_actcol, p.ibd_chroncol, p.ibd_coloth, p.ibd_inactcol, 
			p.ibd_lgdysp, p.n_intra_ca, p.n_inv_ca, p.n_cancer, 
			p.ptype_fibroblast, p.ptype_lymphoid, p.flg_noqdata, p.flg_assump, 
			p.flg_multis, p.flg_multisites, p.flg_residual, 
			p.flg_assump_numpolyps, p.flg_dx_size, p.flg_dx_site, 
			p.flg_dx_multis, p.specimen_type, p.s_notes, p.t_class, p.n_class, 
			p.date_of_export, p.y_prefix, p.record_complete, p.flg_size_discrep, 
			p.sas_key_id, p.discrepnote,
			c.exam_date, c.teleform_formid, c.crs_batch, c.scan_batch, 
			c.barcode, c.ind_scr_nosym, c.ind_scr_fhxcc, c.ind_scr_fhxplp, 
			c.ind_sur_phxcc, c.ind_sur_phxplp, c.ind_sur_fhnpcc, c.ind_sur_ibd, 
			c.ibdtyp_uc, c.ibdtyp_crohn, c.ibdtyp_ind, c.ind_diag_exam, 
			c.dex_bleed, c.dex_cbh_diar, c.dex_cbh_cons, c.dex_elim_ibd, 
			c.dex_biop, c.dex_fobt, c.dex_abn_test, c.dex_abn_tst_ctc, 
			c.dex_abn_tst_bar_en, c.dex_abn_tst_oth, c.dex_plpect_plp, 
			c.dex_ida, c.fnd_norm_ex, c.fnd_plp, c.ind_scr_fhxcc_fdr, c.dex_oth, 
			c.addl_polyp, c.all_plps_rem, c.susp_ca, c.susp_ca_loc, 
			c.susp_ca_siz, c.susp_ca_trt_cb, c.susp_ca_trt_hb, c.susp_ca_trt_hs, 
			c.susp_ca_trt_cs, c.susp_ca_trt_pme, c.susp_ca_trt_pe, 
			c.susp_ca_trt_nr, c.susp_ca_trt_lo, c.susp_ca_trt_o, 
			c.susp_ca_trt_sn, c.susp_ca_trt_te, c.susp_crohns, 
			c.susp_crohns_calced, c.susp_uc, c.susp_uc_calced, c.find_other, 
			c.find_oth_bmc, c.find_oth_ibd, c.find_oth_biop, c.find_oth_other, 
			c.prep, c.prep_type, c.meds_used_versed, c.meds_used_demerol, 
			c.meds_used_fentanyl, c.meds_used_propofol, c.meds_used_none, 
			c.meds_used_other, c.end_proc_stat_rr, c.abort_reas_pp, 
			c.abort_reas_obs, c.abort_reas_sedprob, c.abort_reas_tc, 
			c.abort_reas_oth, c.wthdrwl_time, c.comp_none, c.comp_bleed, 
			c.comp_perf, c.comp_cardio, c.comp_resparr, c.comp_oth, c.fup_lt1, 
			c.fup_2t3, c.fup_4t5, c.fup_6t9, c.fup_10, c.fup_gt10, c.fup_nfsi, 
			c.fup_rwp, c.fup_pp, c.fup_baren, c.fup_othproc, c.fup_ctc, 
			c.fup_surgcons, c.fup_pcp, c.fup_1t3, c.fup_6t10, 
			c.dex_cbh_diarcons, c.dex_abd_pain, c.ind_scr_phxcca, 
			c.ind_sur_phxplpcca, c.data_source, c.prep_typ_nulytely, 
			c.prep_typ_halflytely, c.prep_typ_osmo, c.prep_typ_fleet, 
			c.prep_typ_oth, c.vr_uccrohn, c.util_bool, c.computed_fnd_polyp, 
			c.computed_fnd_siz, c.endo_code, c.f_reas_curex, c.f_reas_famhx, 
			c.f_reas_perhx, c.f_reas_ibd, c.f_reas_oth, c.computed_normal_exam, 
			c.computed_plp_trtmnt, c.computed_susp_ca_loc, 
			c.computed_susp_ca_siz, c.computed_susp_ca_trtmnt, 
			c.computed_susp_crohn, c.computed_susp_uc, c.computed_susp_other, 
			c.su_cr_loc_ti, c.su_cr_loc_ce, c.su_cr_loc_ac, c.su_cr_loc_hf, 
			c.su_cr_loc_tc, c.su_cr_loc_sf, c.su_cr_loc_dc, c.su_cr_loc_sg, 
			c.su_cr_loc_re, c.su_cr_loc_u, c.su_uc_loc_ti, c.su_uc_loc_ce, 
			c.su_uc_loc_ac, c.su_uc_loc_hf, c.su_uc_loc_tc, c.su_uc_loc_sf, 
			c.su_uc_loc_dc, c.su_uc_loc_sg, c.su_uc_loc_re, c.su_uc_loc_u, 
			c.indication_calculated, c.fu_form_completed, c.computed_susp_ca, 
			c.p_flat_a, c.p_flat_b, c.p_flat_c, c.p_flat_d, c.p_flat_e, 
			c.p_flat_f, c.p_flat_g, c.pth_req_id, c.find_calc_normal, 
			c.find_calc_polyp, c.find_calc_cancer, c.find_calc_other, 
			c.find_calc_nodata
			from vcolo c full join vpolypspecimen_e p ON c.c_event_id = p.event_id;
