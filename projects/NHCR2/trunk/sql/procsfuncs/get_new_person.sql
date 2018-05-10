create or replace function get_new_person(
    in in_dob varchar,
    in in_ssn varchar,
    in in_last_name varchar,
    in in_first_name varchar
    )
returns table (
    lcl_person_id integer, 
    lcl_message varchar) AS
$BODY$
    declare lcl_dob date;
begin

    insert into person (record_comment) values('New subject');
    if (in_dob = '') then select null into in_dob; end if;

	if (in_last_name != '' and in_first_name != '') then
		select check_for_dup (in_last_name, in_first_name) into lcl_message;
	else
		select '' into lcl_message;
	end if;

    select  currval('person_person_id_seq') into lcl_person_id;
    select lcl_message || ' New subject - ' || lcl_person_id into lcl_message;
    select safe_cast(in_dob,null::date) into lcl_dob;

    update person set 
            dob = lcl_dob,
            ssn = in_ssn,
            last_name = in_last_name,
            first_name = in_first_name
    where person_id = lcl_person_id;

    return query 
        select lcl_person_id, lcl_message;
end;
$BODY$
language plpgsql
