create view vpathreportsrch as select
    p.person_id, 
    p.refused,
    event_date, 
    e.event_id, 
    e.event_type,
    e.medical_record_number,
    e.endo_code,
    p.last_name, 
    p.first_name, 
    p.middle_name, 
    dob ,
    p.gender_calcd, 
    b.facility_id,
    facility_name
    from Event e join  Person p on e.person_id = p.person_id 
    left outer join  Batch b on e.batch_id = b.batch_id 
    left outer join facility f on b.facility_id = f.facility_id;
grant select on vpathreportsrch to NHCR2_rc;
