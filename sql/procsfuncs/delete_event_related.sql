create or replace function delete_event_related (in in_event_id integer)
returns table (
    lcl_message varchar) AS
$BODY$
declare
	lcl_count integer;

begin

		delete from colo where event_id = in_event_id;
		delete from follow_up where fu_event_id = in_event_id;
		delete from specimen s using path_report p where p.event_id = in_event_id and s.path_report_id = p.path_report_id; --delete specimen from path link  path report
		delete from path_request where event_id = in_event_id;
		delete from polyp2 where event_id = in_event_id;
		delete from survey where event_id = in_event_id;
		delete from path_report where event_id = in_event_id;
		delete from event where event_id = in_event_id;

		select 'Event and all related records have been deleted.' into lcl_message;

	return query select lcl_message;
end;
$BODY$
language plpgsql;
	