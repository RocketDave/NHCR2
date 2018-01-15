﻿create view vEvents_p as select
    event_id ,
    e.action_on,
    e.action_by,
    e.inserted_on,
    person_id ,
    event_type ,
    e.batch_id,
    facility_id,
    event_date,
    e.comments ,
    patient_barcode ,
    endo_barcode ,
    medical_record_number ,
    endo_code ,
    est_exam_date ,
    signature_present ,
    second_batch
    from event e join batch b on e.batch_id = b.batch_id order by event_id;
grant select on vEvents_p to NHCR2_rc;