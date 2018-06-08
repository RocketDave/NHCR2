create or replace function delete_person (in in_person_id integer)
returns table (
	lcl_message varchar) AS
$BODY$
declare
	lcl_count integer;

begin

	select check_related_person(in_person_id) into lcl_count;

	if lcl_count = 0 then 
		delete from person where person_id = in_person_id;
		delete from follow_up where fu_person_id = in_person_id;
		select 'Record Deleted' into lcl_message;
	else
		select 'Cannot delete person -.related records exist - ' || get_related_personid(in_person_id) into lcl_message;
	end if;

	return query select lcl_message;
end;
$BODY$
language plpgsql;
	