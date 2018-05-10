create or replace function fix_dup_events ()
returns void as 
$BODY$
    declare cur1 cursor for select event_id, event_id2, patient_barcode2  from dup_events;
    declare lcl_event_id integer;
    declare lcl_event_id2 integer;
    declare lcl_barcode2 varchar;
begin

    open cur1;
    loop
    -- fetch row into the film
      fetch cur1 into lcl_event_id, lcl_event_id2, lcl_barcode2;
    -- exit when no more row to fetch
      exit when not found;

    update colo set event_id = lcl_event_id where event_id = lcl_event_id2;
    update follow_up set fu_event_id = lcl_event_id where fu_event_id = lcl_event_id2;
    update path_report set event_id = lcl_event_id where event_id = lcl_event_id2;
    update path_request set event_id = lcl_event_id where event_id = lcl_event_id2;
    update polyp2 set event_id = lcl_event_id where event_id = lcl_event_id2;
    update survey set event_id = lcl_event_id where event_id = lcl_event_id2;
    update event set patient_barcode = lcl_barcode2 where event_id = lcl_event_id;
    delete from event where event_id = lcl_event_id2;
   end loop;

end;
$BODY$
language plpgsql