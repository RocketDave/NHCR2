create view vPersonSrch as select
    person_id, 
    ssn,
    last_name, 
    first_name, 
    middle_name, 
    address1,
    city,
    state,
    dob
    from Person ;
grant select on vPersonSrch to NHCR2_rc;
