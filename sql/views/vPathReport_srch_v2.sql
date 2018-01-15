create view public.vPathReportSrchv2 as select
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
    p.dob,
    p.gender_calcd
    from Event e join  Person p on e.person_id = p.person_id;
grant select on public.vPathReportSrchv2 to NHCR2_rc;
