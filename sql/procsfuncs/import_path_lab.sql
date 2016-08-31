create function import_path_lab()
returns void as 
$BODY$
begin
    insert into path_lab (
    path_lab_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    lab_name,
    lab_code,
    contact_last_name,
    contact_first_name,
    phone1,
    phone2,
    address1,
    address2,
    city,
    state,
    zip,
    request_procedure,
    notes,
    status,
    path_report_trigger,
    contact_email,
    contac_salutation,
    contact_suffix)
    select
    path_lab_id,
    mod_rec_date,
    mod_rec_user,
    new_rec_date,
    new_rec_user,
    lab_name,
    lab_code,
    contact_last_name,
    contact_first_name,
    phone1,
    phone2,
    address1,
    address2,
    city,
    state,
    zip,
    request_procedure,
    notes,
    status,
    path_report_trigger,
    contact_email,
    contac_salutation,
    contact_suffix
    from 
        path_lab_import
    order by path_lab_id;
end;
$BODY$
language plpgsql;