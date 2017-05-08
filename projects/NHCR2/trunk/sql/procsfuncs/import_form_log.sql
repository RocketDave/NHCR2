create function import_form_log()
returns void as 
$BODY$
begin
    update form_log_import set ship_date = null where ship_date = '00/00/00';
    update form_log_import set create_date = null where create_date = '00/00/00';
    update form_log_import set modify_date = null where modify_date = '00/00/00';

    insert into form_log (
        action_on,
        action_by,
        inserted_on,
        inserted_by,
        facility_id,
        form_is_patient,
        start_barcode,
        end_barcode,
        ship_date) 
    select
        to_timestamp(modify_date || ' 00:00:00','yyyy/mm/dd hh24:mi:ss'),
        modify_user,
        cast (create_date as date),
        create_user,
        facility_id,
        form_is_patient,
        start_barcode,
        end_barcode,
        cast (ship_date as date)
    from 
        form_log_import;
end;
$BODY$
language plpgsql;