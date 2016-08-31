create function import_person()
returns void as 
$BODY$
begin

  --update person_import set dob = fix_dates_1899(dob);
  update person_import set deceased_date = fix_dates_1899(deceased_date);
  update person_import set refused_date = fix_dates_1899(refused_date);
  update person_import set bad_address_date = fix_dates_1899(bad_address_date);

insert into person (
    person_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    SSN,
    last_name,
    first_name,
    middle_name,
    address1,
    address2,
    city,
    state,
    zip,
    ln_soundex,
    dob,
    deceased,
    deceased_date,
    sex_male  ,
    comments,
    refused,
    refused_date,
    double_entered,
    bad_address,
    bad_address_date,
    NoOtherContact,
    sex_female,
    gender_calcd,
    source_gender_calcd)
select
    person_id,
    modify_date,
    modify_user,
    create_date,
    create_user,
    SSN,
    last_name,
    first_name,
    middle_name,
    address1,
    address2,
    city,
    state,
    zip,
    ln_soundex,
    cast(dob as date),
    convert_true_false(deceased),
    cast(deceased_date as date),
    convert_true_false(sex_male),
    comments,
    convert_true_false(refused),
    cast(refused_date as date),
    convert_true_false(double_entered),
    convert_true_false(bad_address),
    cast (bad_address_date as date),
    convert_true_false(NoOtherContact),
    convert_true_false(sex_female),
    gender_calcd,
    source_gender_calcd 
    from person_import
order by person_id;
end;
$BODY$
language plpgsql;