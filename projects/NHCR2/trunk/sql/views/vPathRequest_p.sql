create view vpathrequest_p as select
    path_request_id,
    p.action_on,
    p.action_by,
    p.inserted_on,
    p.inserted_by,
    p.event_id,
    f.facility_id,
    f.facility_name,
    e.person_id,
    e.event_date as exam_date,
    print_date,
    recvd_date,
    n_a_reason,
    notes,
    med_rec_num,
    no_path_report,
    path_report_id, 
    crs_batch,
    scan_batch,
    fac_requires_request
    from path_request p join colo c on p.event_id = c.event_id join event e on c.event_id = e.event_id join batch b on e.batch_id = b.batch_id join facility f on b.facility_id = f.facility_id;

GRANT select on vpathrequest_p to nhcr2_rc;