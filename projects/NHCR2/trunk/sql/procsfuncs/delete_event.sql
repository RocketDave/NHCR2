create or replace function delete_event (in in_event_id integer)
returns table (
    lcl_message varchar) AS
$BODY$
declare
    lcl_count integer;

begin

    select check_related(in_event_id) into lcl_count;

    if lcl_count = 0 then 
        delete from event where event_id = in_event_id;
        select 'Record Deleted' into lcl_message;
    else
        select 'Cannot delete event - related records exist' into lcl_message;
    end if;

    return query select lcl_message;
end;
$BODY$
language plpgsql;
    