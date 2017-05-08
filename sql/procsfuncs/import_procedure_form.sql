create or replace function import_procedure_form (
)
returns void as 
$BODY$

declare
    rec RECORD;
    lcl_event_id integer;

begin

    for rec in select * 
        from colo where event_id is null 
    loop 
        select event_id into lcl_event_id from event where endo_barcode = rec.barcode;
        update colo set event_id = lcl_event_id where barcode = rec.barcode;
        perform ColoPolypNormalize(lcl_event_id);
    end loop;

end;
$BODY$
language plpgsql