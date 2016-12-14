create view vPathReportSrch as select
    last_name,
    first_name,
    middle_name
    to_char(date_of_birth,'yyyy-mm-dd') as date_of_birth,
    facility_id,
    medical_record_number,
    from event e join person p on e.person_id = p.person_id 

GRANT select on vPathReportSrch to nhcr2_rc;