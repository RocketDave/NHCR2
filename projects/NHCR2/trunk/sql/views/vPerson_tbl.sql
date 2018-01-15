create view vPerson_tbl as select 
    person_id,
    inserted_on,
    last_name,
    first_name,
    dob
    from Person;
grant select on vPerson_tbl to NHCR2_rc;