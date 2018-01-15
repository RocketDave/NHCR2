create view vcolo_p as select
    colo_id,
    event_id,
    facility_id,
    exam_date,
    crs_batch,
    scan_batch
    from colo;
    grant select on vcolo_p to NHCR2_rc;