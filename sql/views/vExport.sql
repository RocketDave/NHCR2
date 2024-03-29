create view vExport as select
p.person_id as p_person_id,
e.person_id as e_person_id,
c.visit_id as c_visit_id,
s.event_id as s_event_id,
e.event_id as e_event_id,
p2.visit_id as p2_visit_id,
pr.event_id_cprs as pr_event_id,
sv.visit_id as sv_visit_id,
c.abort_reas_obs,
c.abort_reas_oth,
c.abort_reas_pp,
c.abort_reas_sedprob,
c.abort_reas_tc,
pr.ad_det_manual,
c.addl_polyp as addl_polyps,
pr.adenoma_detected,
sv.alcohol,
c.all_plps_rem,
pr.amended_path_report,
s.anallevel,
pr.APC,
sv.aspirin,
sv.aspirin_duration,
e.batch_id,
pr.case_no,
en.comments,
c.comp_bleed,
c.comp_cardio,
c.comp_none,
c.comp_oth,
c.comp_perf,
c.comp_resparr,
c.computed_fnd_polyp,
c.computed_fnd_siz,
c.computed_normal_exam,
c.computed_plp_trtmnt,
c.computed_susp_ca,
c.computed_susp_ca_loc,
c.computed_susp_ca_siz,
c.computed_susp_ca_trtmnt,
c.computed_susp_crohn,
c.computed_susp_other,
c.computed_susp_uc,
pr.consult,
pr.consult_date,
s.container,
sv.coumadin,
sv.curr_ht_ft,
sv.curr_ht_in,
sv.curr_wt,
c.data_source,
p.deceased,
p.deceased_date,
pg.degree,
c.dex_abd_pain,
c.dex_abn_test,
c.dex_abn_tst_bar_en,
c.dex_abn_tst_ctc,
c.dex_abn_tst_oth,
c.dex_biop,
c.dex_bleed,
c.dex_cbh_cons,
c.dex_cbh_diar,
c.dex_cbh_diarcons,
c.dex_elim_ibd,
c.dex_fobt,
c.dex_ida,
c.dex_oth,
c.dex_plpect_plp,
e.disabled,
s.discrepnote,
p.dob,
sv.education,
c.end_proc_stat_rr,
e.endo_barcode as barcode_endoform,
e.endo_code,
c.endo_code as endoscopist_id_cprs,
en.endo_degree,
en.endo_dob,
en.endo_fellow_discipline,
en.endo_fellow_grad_year,
en.endo_fellowship,
e.endo_form_double_entered,
en.endo_gender_male,
en.endo_med_grad_year,
en.endo_pseudo_name,
en.endo_res_grad_year,
en.endo_specialty,
en.endo_status,
en.endo_status_date,
en.enroll_survey_done,
pr.event_id_cprs,
e.event_date,
e.event_id,
e.event_type,
sv.ever_cplp,
sv.ever_cplp_fam,
sv.ever_fap,
sv.ever_hnpcc,
sv.ever_ibs,
sv.evr_crc_tab,
sv.exercise,
sv.ext_calcium,
sv.ext_calcium_daration as ext_calcium_duration,
c.f_reas_curex,
c.f_reas_famhx,
c.f_reas_ibd,
c.f_reas_oth,
c.f_reas_perhx,
f.facility_id,
f.facility_name,
f.facility_pseudo_name,
c.find_calc_cancer,
c.find_calc_nodata,
c.find_calc_normal,
c.find_calc_other,
c.find_calc_polyp,
c.find_oth_biop,
c.find_oth_bmc,
c.find_oth_ibd,
c.find_oth_other,
c.find_other,
s.flg_assump,
s.flg_assump_numpolyps,
s.flg_dx,
s.flg_dx_multis,
s.flg_dx_site,
s.flg_dx_size,
s.flg_multis,
s.flg_multisites,
s.flg_no_discrep,
s.flg_no_path_spec,
s.flg_no_Q_spec,
s.flg_noQdata,
s.flg_num_polyps,
s.flg_path_sites,
s.flg_residual,
s.flg_review,
s.flg_site_discrep,
s.flg_site_uncert,
s.flg_size_discrep,
c.fnd_norm_ex,
c.fnd_plp as find_plp,
sv.foreign_born,
fu.fu_barcode,
fu.fu_colo_rec,
fu.fu_date,
fu.fu_docrecfut,
fu.fu_docrecscrn,
fu.fu_embarss,
fu.fu_event_id,
fu.fu_explain,
fu.fu_feelgood,
c.fu_form_completed,
fu.fu_lschncdy,
fu.fu_noworry,
fu.fu_nrvs,
fu.fu_pain,
fu.fu_person_id,
fu.fu_plp_ltr,
fu.fu_plp_ltr_info,
fu.fu_plp_rem,
fu.fu_prep,
fu.fu_pstcmp_bleed,
fu.fu_pstcmp_gas,
fu.fu_pstcmp_none,
fu.fu_pstcmp_oth,
fu.fu_pstcmp_perf,
fu.fu_pstcmp_react,
fu.fu_quality,
fu.fu_scrn,
fu.fu_teleform_formid,
fu.fu_toolong,
c.fup_10,
c.fup_1t3,
c.fup_2t3,
c.fup_4t5,
c.fup_6t10,
c.fup_6t9,
c.fup_baren,
c.fup_ctc,
c.fup_gt10,
c.fup_lt1,
c.fup_nfsi,
c.fup_othproc,
c.fup_pcp,
c.fup_pp,
c.fup_rwp,
c.fup_surgcons,
pr.gender,
p.gender_calcd,
sv.health,
s.HGD,
sv.hispanic,
s.ibd_actcol,
s.ibd_chroncol,
s.ibd_coloth,
s.ibd_ibd,
s.ibd_inactcol,
s.ibd_lgdysp,
c.idbtyp_crohn,
c.ibdtyp_ind,
c.ibdtyp_uc,
f.implementation_date,
c.ind_diag_exam,
c.ind_scr_fhxcc,
c.ind_scr_fhxcc_fdr,
c.ind_scr_fhxplp,
c.ind_scr_nosym,
c.ind_scr_phxcca,
c.ind_sur_fhnpcc,
c.ind_sur_ibd,
c.ind_sur_phxcc,
c.ind_sur_phxplp,
c.ind_sur_phxplpcca,
c.indication_calculated,
sv.ins_hmo,
sv.ins_mcaid,
sv.ins_mcare,
sv.ins_none,
sv.ins_oth,
sv.ins_priv,
sv.ins_unsure,
pr.lab_code,
pl.lab_name,
sv.marital_status,
c.meds_used_demerol,
c.meds_used_fentanyl,
c.meds_used_none,
c.meds_used_other,
c.meds_used_propofol,
c.meds_used_versed,
s.n_cancer,
s.N_class,
s.n_intra_ca,
s.n_inv_ca,
pr.no_Q_form,
e.not_approached,
sv.nsaids,
sv.nsaids_duration,
p2.old_polyp_id,
sv.oth_fam_poly,
sv.other_ca,
sv.other_ca_fam,
s.other_dx_specify,
p2.p_flat,
p2.p_loc,
p2.p_siz as polyp_siz,
en.participating,
pl.Path_lab_id,
s.path_polyp_loc,
pr.path_report_complete,
pg.pathologist_code,
pr.pathologist_code_cprs,
pg.Pathologist_id,
pr.pathology_date,
e.patient_barcode as barcode_pif,
e.patient_form_double_entered,
sv.patient_id,
sv.pcr_colon_ca,
sv.pcr_dk_tab,
sv.pcr_dvt,
sv.pcr_nofind,
sv.pcr_oth,
sv.pcr_plp,
sv.pcr_rectal_ca,
sv.pcr_roids,
s.polyp_num,
c.prep,
c.prep_typ_fleet,
c.prep_typ_halflytely,
c.prep_typ_nulytely,
c.prep_typ_osmo,
c.prep_typ_oth,
c.prep_type as colo_prep_type,
sv.prep_type as surv_prep_type,
sv.prep_type_fleet,
sv.prep_type_hal,
sv.prep_type_nul,
sv.prep_type_osmo,
sv.prep_type_oth,
sv.prev_colo,
sv.prev_sigcolo,
pr.procedure_type,
sv.pscr_bplp,
sv.pscr_cca,
sv.pscr_dvt,
sv.pscr_neg,
sv.pscr_oth,
sv.pscr_roids,
sv.psr_colon_ca,
sv.psr_dk_tab,
sv.psr_dvt,
sv.psr_never_tab,
sv.psr_nofind,
sv.psr_oth,
sv.psr_plp,
sv.psr_rectal_ca,
sv.psr_roids,
p2.pt_cb,
p2.pt_cs,
p2.pt_hb,
p2.pt_hs,
p2.pt_lo,
p2.pt_nr,
p2.pt_o,
p2.pt_pe,
p2.pt_pme,
p2.pt_sn,
p2.pt_te,
f.pth_req_required,
s.Ptype_Carcinoid,
s.Ptype_Fibroblast,
s.Ptype_Ganglio,
s.Ptype_Hamart,
s.Ptype_HP,
s.Ptype_Inflam,
s.Ptype_Juvenile,
s.Ptype_Lelomyoma,
s.Ptype_Lipoma,
s.Ptype_Lymphoid,
s.Ptype_Mixed,
s.Ptype_MP,
s.Ptype_Norm_Muc,
s.Ptype_Not_Polyp,
s.Ptype_Other,
s.Ptype_PautzJeg,
s.Ptype_SA,
s.Ptype_SSP,
s.Ptype_TA,
s.Ptype_TVA,
s.Ptype_VA,
pr.Q_form_incomplete,
sv.qty_smoke,
sv.race_amind,
sv.race_asian,
sv.race_black,
sv.race_oth,
sv.race_pacisl,
sv.race_white,
s.record_complete,
p.refused,
p.refused_date,
sv.relb450_bro_pilot,
sv.relb450_dad_pilot,
sv.relb450_kid_pilot,
sv.relb450_mom_pilot,
sv.relb450_sis_pilot,
sv.relca_age_dad_tab,
sv.relca_age_mom_tab,
sv.relca_bro,
sv.relca_bro_dk_tab,
sv.relca_bro_gt60_tab,
sv.relca_dad,
sv.relca_dad_dk_tab,
sv.relca_dad_gt60_tab,
sv.relca_kid,
sv.relca_kid_dk_tab,
sv.relca_kid_gt60_tab,
sv.relca_mom,
sv.relca_mom_dk_tab,
sv.relca_mom_gt60_tab,
sv.relca_sis,
sv.relca_sis_dk_tab,
sv.relca_sis_gt60_tab,
sv.relcab450_bro as relca_bro_b450,
sv.relcab450_dad as relca_dad_b450,
sv.relcab450_dk,
sv.relcab450_kid as relca_kid_b450,
sv.relcab450_mom as relca_mom_b450,
sv.relcagt50_sis,
sv.relcab450_sis,
sv.relcagt50_bro,
sv.relcagt50_dad,
sv.relcagt50_dk,
sv.relcagt50_kid,
sv.relcagt50_mom,
pr.Report_key_ID,
pr.serr_det_manual,
pr.serrated_detected,
p.sex_female,
p.sex_male,
s.site_location_cm,
s.size_mm,
sv.smoker,
p.source_gender_calcd,
s.specimen_type,
sv.state_born,
f.status,
f.status_date,
c.su_cr_loc_ac,
c.su_cr_loc_ce,
c.su_cr_loc_dc,
c.su_cr_loc_hf,
c.su_cr_loc_re,
c.su_cr_loc_sf,
c.su_cr_loc_sg,
c.su_cr_loc_tc,
c.su_cr_loc_ti,
c.su_cr_loc_u,
c.su_uc_loc_ac,
c.su_uc_loc_ce,
c.su_uc_loc_dc,
c.su_uc_loc_hf,
c.su_uc_loc_re,
c.su_uc_loc_sf,
c.su_uc_loc_sg,
c.su_uc_loc_tc,
c.su_uc_loc_ti,
c.su_uc_loc_u,
c.susp_ca as suspca,
c.susp_ca_loc as suspcaloc,
c.susp_ca_siz,
c.susp_ca_trt_cb,
c.susp_ca_trt_cs,
c.susp_ca_trt_hb,
c.susp_ca_trt_hs,
c.susp_ca_trt_lo,
c.susp_ca_trt_nr,
c.susp_ca_trt_o,
c.susp_ca_trt_pe,
c.susp_ca_trt_pme,
c.susp_ca_trt_sn,
c.susp_ca_trt_te,
c.susp_crohns,
c.susp_crohns_calced,
c.susp_UC,
c.susp_UC_calced,
s.T_class,
c.teleform_formid as formid_endoform,
sv.teleform_formid as formid_pif,
sv.vitamin_duration,
sv.vitamins,
sv.vitamins_pilot,
sv.vr_bleed,
sv.vr_crohn_age_dx,
sv.vr_dk_tab,
sv.vr_fhxcca,
sv.vr_fhxp,
sv.vr_none_tab,
sv.vr_nosymp,
sv.vr_other,
sv.vr_phx_crohn,
sv.vr_phx_uc,
sv.vr_phxcca,
sv.vr_phxp,
sv.vr_uc_age_dx,
sv.vr_uccrohn,
sv.wt_20,
c.wthdrwl_time as withdrwl_time,
s.y_prefix,
en.year_first_colo,
en.year_first_colo_here,
sv.yrs_smoke,
f.zip
from event_import e
full join colo_import c ON e.event_id = c.visit_id
full join person_import p ON e.person_id = p.person_id
full join vSpecimen s ON s.event_id = e.event_id
full join path_report_import pr ON pr.report_key_id = s.path_id
full join polyp2_import p2 ON p2.visit_id = e.event_id AND p2.old_polyp_id = s.polyp_num
full join survey_import sv ON sv.visit_id = e.event_id
full join follow_up_import fu ON e.event_id = fu.fu_event_id
full join endoscopist_import en ON e.endo_code = en.endo_code
full join pathologist_import pg ON pr.pathologist_code_cprs = pg.pathologist_code
full join facility_import f ON c.facility_id = f.facility_id
full join pathology_lab_import pl ON pr.lab_code = pl.lab_code;