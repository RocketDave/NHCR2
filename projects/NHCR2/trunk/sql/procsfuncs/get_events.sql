create function get_events(in in_person_id integer)
returns varchar AS
$BODY$
begin

	return string_agg(to_char(event_date ,'mm/dd/yyyy'),',') from event where person_id = in_person_id ;

end;
$BODY$
language plpgsql