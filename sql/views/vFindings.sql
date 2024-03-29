create view vFindings as select
  colo_id ,
  event_id ,
  pr_event_id ,
  inserted_on ,
  event_type ,
  path_report_complete ,
  age_exam ,
  exam_date,
  endoscopist_id ,
  facility_id ,
  gender_calcd ,
  end_proc_stat_rr ,
  prep ,
  adenoma_detected ,
  clinically_serrated ,
  proximal_serrated ,
  screening ,
  surveillance ,
  diagnostic ,
  eligible ,
  indication_calculated ,
  ind_scr_nosym ,
  ind_scr_fhxcc ,
  ind_scr_fhxplp ,
  ind_sur_phxcc ,
  ind_sur_phxplp ,
  ind_sur_phxplpcca ,
  ind_sur_fhnpcc ,
  ind_scr_phxcca ,
  ind_sur_ibd ,
  ibdtyp_uc ,
  ibdtyp_crohn ,
  ibdtyp_ind ,
  ind_diag_exam ,
  dex_bleed ,
  dex_cbh_diar ,
  dex_cbh_cons ,
  dex_cbh_diarcons ,
  dex_elim_ibd ,
  dex_biop ,
  dex_fobt ,
  dex_abn_test ,
  dex_abn_tst_ctc ,
  dex_abn_tst_bar_en ,
  dex_abn_tst_oth ,
  dex_plpect_plp ,
  dex_ida ,
  dex_oth ,
  find_calc_normal ,
  find_calc_polyp ,
  find_calc_cancer ,
  find_calc_other ,
  fnd_norm_ex ,
  fnd_plp ,
  find_other ,
  find_oth_bmc ,
  find_oth_ibd ,
  find_oth_biop ,
  find_oth_other ,
  completed ,
  abort_reas_pp ,
  abort_reas_obs ,
  abort_reas_sedprob ,
  abort_reas_tc ,
  abort_reas_oth ,
  wthdrwl_time ,
  fup_10 ,
  fu_form_completed ,
  fup_gt10 
from public.findings;
grant select on public.vFindings to nhcr2_data;
