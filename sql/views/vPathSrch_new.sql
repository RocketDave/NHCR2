create view vPathSrch_new as select
    person_id, 
    refused,
    last_name, 
    first_name, 
    middle_name, 
    dob
    from Person ;
grant select on vPathSrch_new to NHCR2_rc;
