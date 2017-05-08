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

    if (in_dob = '') then select null into in_dob; end if;
    if (in_deceased_date = '') then select null into in_deceased_date;end if;
    if (in_refused_date = '') then select null into in_refused_date;end if;
    if (in_bad_address_date = '') then select null into in_bad_address_date;end if;

    if exists(select * from person where person_id =  in_person_id) then
        update person set 
            ssn = in_ssn,
            first_name = initcap(lower(in_first_name)),
            middle_name = initcap(lower(in_middle_name)),
            last_name = initcap(lower(in_last_name)),
            suffix = initcap(lower(in_suffix)),
            address1 = initcap(lower(in_address1)),
            address2 = initcap(lower(in_address2)),
            city = initcap(lower(in_city)),
            state = upper(in_state),
            zip = in_zip,
            dob = cast(in_dob as date),
            deceased = in_deceased,
            deceased_date = cast(in_deceased_date as date),
            refused = in_refused,
            refused_date = cast(in_refused_date as date),
            gender_calcd = in_gender_calcd,
            source_gender_calcd = in_source_gender_calcd,
            bad_address = in_bad_address,
            bad_address_date = cast(in_bad_address_date as date),
            comments = in_comments 
            where person_id = in_person_id;
        select 'Record Updated' into lcl_message;
    else
        select 'ID - ' || in_person_id || 'not found' into lcl_message;
    end if;

    return query 
        select in_person_id, lcl_message;
end;
$BODY$
language plpgsql
