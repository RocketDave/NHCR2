create or replace function set_person(
    in in_person_id integer,
    in in_ssn varchar,
    in in_first_name varchar,
    in in_middle_name varchar,
    in in_last_name varchar,
    in in_suffix varchar,
    in in_address1 varchar,
    in in_address2 varchar,
    in in_city varchar,
    in in_state varchar,
    in in_zip varchar,
    in in_dob varchar,
    in in_deceased smallint,
    in in_deceased_date varchar,
    in in_refused smallint,
    in in_refused_date varchar,
    in in_gender_calcd varchar,
    in in_source_gender_calcd varchar,
    in in_bad_address smallint,
    in in_bad_address_date varchar,
    in in_comments varchar)
returns table (
    lcl_person_id integer, 
    lcl_message varchar) AS
$BODY$

begin

if exists(select * from person where person_id =  in_person_id) then
        update person set 
            ssn = in_ssn,
            first_name = in_first_name,
            middle_name = in_middle_name,
            last_name = in_last_name,
            suffix = in_suffix,
            address1 = in_address1,
            address2 = in_address2,
            city = in_city,
            state = upper(in_state),
            zip = in_zip,
            dob = safe_cast(in_dob,null::date),
            deceased = in_deceased,
            deceased_date = safe_cast(in_deceased_date,null::date),
            refused = in_refused,
            refused_date = safe_cast(in_refused_date,null::date),
            gender_calcd = in_gender_calcd,
            source_gender_calcd = in_source_gender_calcd,
            bad_address = in_bad_address,
            bad_address_date = safe_cast(in_bad_address_date,null::date),
            comments = in_comments 
            where person_id = in_person_id;
                select 'Record Updated'  into lcl_message;
    else
        select 'ID - ' || in_person_id || 'not found' into lcl_message;
end if;

    return query 
        select in_person_id, lcl_message;
end;
$BODY$
language plpgsql
