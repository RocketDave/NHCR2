create view vEvents as select
    event_id ,
    action_on,
    action_by,
    person_id ,
    event_type ,
    to_char(event_date,'yyyy-mm-dd') as event_date,
    comments ,
    patient_barcode ,
    endo_barcode ,
    medical_record_number ,
    endo_code ,
    est_exam_date ,
    signature_present ,
    not_approached ,
    disabled 
    from
        event order by event_id;
grant select on vEvents to NHCR2_rc;