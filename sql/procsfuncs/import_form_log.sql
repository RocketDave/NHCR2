create function import_form_log()
returns void as 
$BODY$
begin
    --update form_log_import set ship_date = null where ship_date = '00/00/00';
    --update form_log_import set create_date = null where create_date = '00/00/00';
    --update form_log_import set modify_date = null where modify_date = '00/00/00';

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
        fix_dates_1899 (create_date),
        create_user,
        facility_id,
        convert_true_false(form_is_patient),
        start_barcode,
        end_barcode,
        fix_dates_1899 (ship_date)
    from 
        form_log_import;

    perform setval('form_log_form_log_id_seq', max(form_log_id)) from form_log;
end;
$BODY$
language plpgsql;