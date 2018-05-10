create or replace function fix_suffix (in in_person_id integer)
returns void as 
$BODY$
declare
    lcl_suffix varchar;
	lcl_last_name varchar;
begin
	select get_suffix(last_name) into lcl_suffix from person where person_id = in_person_id;
	select remove_suffix(last_name) into lcl_last_name from person where person_id = in_person_id;
	update person set last_name = lcl_last_name, suffix = lcl_suffix where person_id = in_person_id;
end;
$BODY$
language plpgsql;