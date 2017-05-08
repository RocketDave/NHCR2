create view vEvents as select
    event_id ,
    e.action_on,
    e.action_by,
    person_id ,
    event_type ,
    e.batch_id,
    facility_id,
    to_char(event_date,'yyyy-mm-dd') as event_date,
    e.comments ,
    patient_barcode ,
    endo_barcode ,
    medical_record_number ,
    endo_code ,
    est_exam_date ,
    signature_present ,
    not_approached ,
    disabled 
    from event e join batch b on e.batch_id = b.batch_id order by event_id;
grant select on vEvents to NHCR2_rc;