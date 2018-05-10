create or replace function public.set_path_report_admin(
	in in_path_report_id integer,
	in in_event_id integer,
	in in_person_id varchar
	)

returns table (
	lcl_path_report_id integer,
	lcl_message varchar) AS
$BODY$
	declare lcl_check integer;
	declare lcl_person_id varchar;

begin

	if exists(select person_id from event where event_id = in_event_id) then
		select 1 into lcl_check;
		select person_id into lcl_person_id from event where event_id = in_event_id;
	else
		select 0 into lcl_check;
	end if;

	if exists(select * from path_report where path_report_id = in_path_report_id and lcl_check = 1) then
		update path_report set 
			event_id = in_event_id
		where path_report_id = in_path_report_id;
		if (in_person_id != lcl_person_id) then
			select 'Record Updated, but new Person ID - ' || lcl_person_id || ' is different than old Person ID - ' || in_person_id into lcl_message;
		else
			select 'Record Updated for Person ID - ' || lcl_person_id into lcl_message;
		end if;
	else
		select 'Problem updating record - check event ID' into lcl_message;
	end if;


	return query select 
		in_path_report_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_path_report_admin
	(integer,integer,varchar) to nhcr2_admin; 
