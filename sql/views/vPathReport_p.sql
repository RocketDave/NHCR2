create view vPathReport_p as select
    path_report_id,
    p.action_on,
    p.action_by,
    p.inserted_on,
    p.inserted_by,
    p.event_id ,
    case when path_report_complete=1 then 'Yes' else 'No' end as path_report_complete,
    e.person_id ,
    date_of_birth,
    case_no,
    pathologist_code_cprs,
    pathology_date,
    lab_code,
    b.facility_id,
    e.endo_barcode
    from path_report p join event e on p.event_id = e.event_id join batch b on e.batch_id = b.batch_id;

GRANT select on vPathReport_p to nhcr2_rc;