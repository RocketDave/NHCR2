create or replace function fix_dup_events2 ()
returns void as 
$BODY$
    declare cur1 cursor for select event_id, event_id2, patient_barcode2  from dup_events2;
    declare lcl_event_id integer;
    declare lcl_event_id2 integer;
    declare lcl_barcode2 varchar;
begin

    -- fixes path links where there was a pathlink created for an existing event
    open cur1;
    loop
    -- fetch row into the film
      fetch cur1 into lcl_event_id, lcl_event_id2, lcl_barcode2;
    -- exit when no more row to fetch
      exit when not found;

    if exists (select * from path_report where event_id = lcl_event_id2) then --there is a path report that exists for the non pathlink event
        delete from specimen s using path_report p where event_id = lcl_event_id and s.path_report_id = p.path_report_id; --delete specimen from path link  path report
        delete from path_report where event_id = lcl_event_id; --delete path report (pathlink)
        delete from colo where event_id = lcl_event_id; --delete colo from pathlink event
        delete from polyp2 where event_id = lcl_event_id; --delete colo from pathlink event(should be no records)
    else --only have one path report
        update path_report set event_id = lcl_event_id2 where event_id = lcl_event_id; --update to correct event record
    end if;
    delete from colo where event_id = lcl_event_id;
    delete from event where event_id = lcl_event_id; --delete pathlink event
    
   end loop;

end;
$BODY$
language plpgsql