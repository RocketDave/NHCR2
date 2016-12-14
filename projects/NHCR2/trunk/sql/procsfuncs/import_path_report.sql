create function import_path_report()
returns void as 
$BODY$
begin
    update path_report_import set event__id_cprs = null where event__id_cprs = 0;
    update path_report_import set procedure_type = 'Colonoscopy' where procedure_type = 'COLONOSCOPY' or procedure_type = 'colonosopy';
    update path_report_import set procedure_type = 'Resection' where procedure_type = 'RESECTION';

    insert into path_report (
    path_report_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    event_id,
    path_report_complete,
    patient_ID,
    date_of_birth,
    gender,
    case_no,
    procedure_type,
    consult,
    consult_date,
    endoscopist_id_cprs,
    amended_path_report,
    pathologist_code_cprs,
    pathology_date,
    lab_code,
    no_Q_form,
    Q_form_incomplete,
    apc,
    SAS_import_notes,
    pseudo_patient_id,
    source,
    study_site,
    rec_type,
    Notes,
    sas_key_id,
    pth_req_id,
    adenoma_detected,
    ad_det_manual,
    px_gender_male,
    px_gender_female,
    serrated_detected,
    serr_det_manual,
    gender_calcd)
    select
    report_key_id,
    fix_dates2(mod_rec_date),
    mod_rec_user,
    new_rec_date,
    new_rec_user,
    event__id_cprs,
    path_report_complete,
    patient_id,
    fix_dates2(date_of_birth),
    gender,
    case_no,
    procedure_type,
    consult,
    fix_dates2(consult_date),
    endoscopist_id_cprs,
    amended_path_report,
    pathologist_code_cprs,
    pathology_date,
    lab_code,
    no_Q_form,
    Q_form_incomplete,
    apc,
    SAS_import_notes,
    pseudo_patient_id,
    source,
    study_site,
    rec_type,
    Notes,
    sas_key_id,
    pth_req_id,
    adenoma_detected,
    ad_det_manual,
    px_gender_male,
    px_gender_female,
    serrated_detected,
    serr_det_manual,
    gender_calcd
    from path_report_import
    order by report_key_id;
end;
$BODY$
language plpgsql;