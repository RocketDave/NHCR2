create view vPathReport_all as select
    path_report_id,
    p.action_on,
    p.action_by,
    p.inserted_on,
    p.inserted_by,
    p.event_id ,
    case when path_report_complete=1 then 'Yes' else 'No' end as path_report_complete,
    p.person_id ,
    to_char(date_of_birth::timestamp with time zone, 'yyyy-mm-dd'::text) AS date_of_birth,
    case_no,
    pathologist_code_cprs,
    to_char(pathology_date::timestamp with time zone, 'yyyy-mm-dd'::text) AS pathology_date,
    lab_code,
    b.facility_id
    from path_report p left outer join event e on p.event_id = e.event_id left outer join batch b on e.batch_id = b.batch_id;

GRANT select on vPathReport_all to nhcr2_rc;