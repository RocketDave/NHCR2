﻿create view vFindings as select
    colo_id,
    c.event_id,
    e.event_type,
    p.path_report_complete,
    exam_date,
    ed.endoscopist_id,
    facility_id ,
    facility_type ,
    pn.gender_calcd,
    end_proc_stat_rr,
    prep,
    get_indication(colo_id) as myDx,
    get_adenoma_detected(c.event_id) as adenoma_detected_new,
    get_clinically_serrated(c.event_id) as clinically_serrated,
    get_proximal_serrated(c.event_id) as proximal_serrated,
    get_screening(colo_id) as screening,
    get_surveillance(colo_id) as surveillance,
    get_diagnostic(colo_id) as diagnostic,
    get_eligible(colo_id) as eligible,
    indication_calculated,
    ind_scr_nosym ,
    ind_scr_fhxcc ,
    ind_scr_fhxplp ,
    ind_sur_phxcc ,
    ind_sur_phxplp ,
    ind_sur_phxplpcca,
    ind_sur_fhnpcc ,
    ind_scr_phxcca,
    ind_sur_ibd ,
    ibdtyp_uc ,
    ibdtyp_crohn ,
    ibdtyp_ind ,
    ind_diag_exam ,
    dex_bleed ,
    dex_cbh_diar ,
    dex_cbh_cons ,
    dex_cbh_diarcons,
    dex_elim_ibd ,
    dex_biop ,
    dex_fobt ,
    dex_abn_test ,
    dex_abn_tst_ctc ,
    dex_abn_tst_bar_en ,
    dex_abn_tst_oth ,
    dex_plpect_plp ,
    dex_ida ,
    dex_oth,
    find_calc_normal ,
    find_calc_polyp ,
    find_calc_cancer ,
    find_calc_other ,
    find_calc_nodata ,
    fnd_norm_ex,
    fnd_plp,
    find_other ,
    find_oth_bmc ,
    find_oth_ibd ,
    find_oth_biop ,
    find_oth_other ,
    wthdrwl_time,
    case when end_proc_stat_rr = '1' or end_proc_stat_rr = '2' then 1 else 0 end as completed,
    adenoma_detected,
    serrated_detected
    from colo c join event e on c.event_id = e.event_id join person pn on e.person_id = pn.person_id join endoscopist ed on e.endo_code = ed.endoscopist_id
    left outer join path_report p on c.event_id = p.event_id where pn.refused = 0 and e.event_type = 'Colonoscopy' ;
    grant select on vFindings to nhcr2_rc;