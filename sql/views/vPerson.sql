create view vPerson as select 
    person_id,
    action_on,
    action_by,
    ssn,
    first_name,
    middle_name,
    last_name,
    suffix,
    address1,
    address2,
    city,
    state,
    zip,
    to_char(dob,'yyyy-mm-dd') as dob,
    deceased,
    to_char(deceased_date,'yyyy-mm-dd') as deceased_date,
    refused,
    to_char(refused_date,'yyyy-mm-dd') as refused_date,
    gender_calcd,
    source_gender_calcd,
    sex_male,
    bad_address,
    to_char(bad_address_date,'yyyy-mm-dd') as bad_address_date,
    sex_female,
    comments
    from Person;
grant select on vPerson to NHCR2_rc;