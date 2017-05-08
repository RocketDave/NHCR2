create view vPathRequest as select
    path_request_id,
    p.action_on,
    p.action_by,
    p.inserted_on,
    p.inserted_by,
    p.event_id,
    c.facility_id,
    f.facility_name,
    c.patient_id,
    to_char(c.exam_date,'yyyy-mm-dd') as exam_date,
    to_char(p.print_date,'yyyy-mm-dd') as print_date,
    to_char(p.recvd_date,'yyyy-mm-dd') as recvd_date,
    n_a_reason,
    notes,
    med_rec_num,
    no_path_report,
    path_report_id,
    temp_last_name,
    temp_dob,
    temp_endo_info,
    fac_requires_request
    from path_request p join colo c on p.event_id = c.event_id join event e on c.event_id = e.event_id join batch b on e.batch_id = b.batch_id join facility f on b.facility_id = f.facility_id;

GRANT select on vPathRequest to nhcr2_rc;