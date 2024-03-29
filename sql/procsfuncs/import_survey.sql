create function import_survey()
returns void as 
$BODY$
begin

insert into survey (
    scan_date,
    inserted_by,
    patient_id,
    event_id,
    facility_id,
    crs_batch,
    exam_date,
    teleform_formid,
    barcode,
    scan_batch,
    vr_nosymp,
    vr_phxp,
    vr_phxcca,
    vr_fhxp,
    vr_fhxcca,
    vr_bleed,
    vr_phx_uc,
    vr_uc_age_dx,
    vr_phx_crohn,
    vr_crohn_age_dx,
    vr_other,
    prep_type_nul,
    prep_type_hal,
    prep_type_fleet,
    prep_type_osmo,
    prep_type_oth,
    prev_colo,
    pcr_nofind,
    pcr_plp,
    pcr_colon_ca,
    pcr_rectal_ca,
    pcr_roids,
    pcr_dvt,
    pcr_oth,
    psr_nofind,
    psr_plp,
    psr_colon_ca,
    psr_rectal_ca,
    psr_roids,
    psr_dvt,
    psr_oth,
    relca_mom,
    relca_dad,
    relca_sis,
    relca_bro,
    relca_kid,
    relcab450_mom,
    relcab450_dad,
    relcab450_sis,
    relcab450_bro,
    relcab450_kid,
    relcab450_dk,
    relcagt50_mom,
    relcagt50_dad,
    relcagt50_sis,
    relcagt50_bro,
    relcagt50_kid,
    relcagt50_dk,
    ever_cplp,
    ever_cplp_fam,
    ever_fap,
    ever_hnpcc,
    ever_ibs,
    other_ca,
    other_ca_fam,
    aspirin,
    aspirin_duration,
    vitamins_pilot,
    nsaids,
    nsaids_duration,
    health,
    smoker,
    yrs_smoke,
    qty_smoke,
    alcohol,
    exercise,
    curr_ht_ft,
    curr_ht_in,
    curr_wt,
    wt_20,
    ins_mcare,
    ins_mcaid,
    ins_priv,
    ins_hmo,
    ins_oth,
    ins_unsure,
    ins_none,
    hispanic,
    race_white,
    race_black,
    race_asian,
    race_pacisl,
    race_amind,
    race_oth,
    education,
    marital_status,
    state_born,
    comp_race,
    coumadin,
    prev_sigcolo,
    pscr_neg,
    pscr_bplp,
    pscr_cca,
    pscr_roids,
    pscr_dvt,
    pscr_oth,
    vitamin_duration,
    ext_calcium,
    ext_calcium_daration,
    oth_fam_poly,
    vr_uccrohn,
    relb450_mom_pilot,
    relb450_dad_pilot,
    relb450_sis_pilot,
    relb450_bro_pilot,
    relb450_kid_pilot,
    vitamins,
    util_bool,
    prep_type,
    foreign_born,
    vr_none_tab,
    vr_dk_tab,
    pcr_dk_tab,
    psr_never_tab,
    psr_dk_tab,
    relca_mom_gt60_tab,
    relca_mom_dk_tab,
    relca_dad_gt60_tab,
    relca_dad_dk_tab,
    relca_sis_gt60_tab,
    relca_bro_gt60_tab,
    relca_kid_gt60_tab,
    relca_sis_dk_tab,
    relca_bro_dk_tab,
    relca_kid_dk_tab,
    evr_crc_tab,
    relca_age_mom_tab,
    relca_age_dad_tab
    )
    select
    safe_cast(create_datetime,null::timestamp),
    create_user,
    patient_id,
    visit_id,
    facility_id,
    crs_batch,
    safe_cast(exam_date,null::date),
    teleform_formid,
    barcode,
    scan_batch,
    vr_nosymp,
    vr_phxp,
    vr_phxcca,
    vr_fhxp,
    vr_fhxcca,
    vr_bleed,
    vr_phx_uc,
    vr_uc_age_dx,
    vr_phx_crohn,
    vr_crohn_age_dx,
    vr_other,
    prep_type_nul,
    prep_type_hal,
    prep_type_fleet,
    prep_type_osmo,
    prep_type_oth,
    prev_colo,
    pcr_nofind,
    pcr_plp,
    pcr_colon_ca,
    pcr_rectal_ca,
    pcr_roids,
    pcr_dvt,
    pcr_oth,
    psr_nofind,
    psr_plp,
    psr_colon_ca,
    psr_rectal_ca,
    psr_roids,
    psr_dvt,
    psr_oth,
    relca_mom,
    relca_dad,
    relca_sis,
    relca_bro,
    relca_kid,
    relcab450_mom,
    relcab450_dad,
    relcab450_sis,
    relcab450_bro,
    relcab450_kid,
    relcab450_dk,
    relcagt50_mom,
    relcagt50_dad,
    relcagt50_sis,
    relcagt50_bro,
    relcagt50_kid,
    relcagt50_dk,
    ever_cplp,
    ever_cplp_fam,
    ever_fap,
    ever_hnpcc,
    ever_ibs,
    other_ca,
    other_ca_fam,
    aspirin,
    aspirin_duration,
    vitamins_pilot,
    nsaids,
    nsaids_duration,
    health,
    smoker,
    yrs_smoke,
    qty_smoke,
    alcohol,
    exercise,
    curr_ht_ft,
    curr_ht_in,
    curr_wt,
    wt_20,
    convert_true_false(ins_mcare),
    convert_true_false(ins_mcaid),
    convert_true_false(ins_priv),
    convert_true_false(ins_hmo),
    convert_true_false(ins_oth),
    convert_true_false(ins_unsure),
    convert_true_false(ins_none),
    hispanic,
    convert_true_false(race_white),
    convert_true_false(race_black),
    convert_true_false(race_asian),
    convert_true_false(race_pacisl),
    convert_true_false(race_amind),
    convert_true_false(race_oth),
    education,
    marital_status,
    state_born,
    comp_race,
    convert_true_false(coumadin),
    prev_sigcolo,
    convert_true_false(pscr_neg),
    convert_true_false(pscr_bplp),
    convert_true_false(pscr_cca),
    convert_true_false(pscr_roids),
    convert_true_false(pscr_dvt),
    convert_true_false(pscr_oth),
    vitamin_duration,
    ext_calcium,
    ext_calcium_daration,
    oth_fam_poly,
    vr_uccrohn,
    relb450_mom_pilot,
    relb450_dad_pilot,
    relb450_sis_pilot,
    relb450_bro_pilot,
    relb450_kid_pilot,
    vitamins,
    convert_true_false(util_bool),
    prep_type,
    foreign_born,
    vr_none_tab,
    vr_dk_tab,
    pcr_dk_tab,
    psr_never_tab,
    psr_dk_tab,
    relca_mom_gt60_tab,
    relca_mom_dk_tab,
    relca_dad_gt60_tab,
    relca_dad_dk_tab,
    relca_sis_gt60_tab,
    relca_bro_gt60_tab,
    relca_kid_gt60_tab,
    relca_sis_dk_tab,
    relca_bro_dk_tab,
    relca_kid_dk_tab,
    evr_crc_tab,
    relca_age_mom_tab,
    relca_age_dad_tab
    from survey_import
    order by patient_id;
end;
$BODY$
language plpgsql;