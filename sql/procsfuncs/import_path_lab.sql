create function import_path_lab()
returns void as 
$BODY$
begin
    insert into path_lab (
    path_lab_id,
    action_on,
    action_by,
    record_comment,
    inserted_on,
    inserted_by,
    lab_name,
    lab_code,
    contact1_name,
    contact1_phone,
    contact1_email,
    contact2_phone,
    address1,
    address2,
    city,
    state,
    zip,
    request_procedure,
    status)
    select
    path_lab_id,
    mod_rec_date,
    mod_rec_user,
    'import from 4D',
    new_rec_date,
    new_rec_user,
    lab_name,
    lab_code,
    contact_first_name || ' ' || contact_last_name,
    phone1,
    contact_email,
    phone2,
    address1,
    address2,
    city,
    state,
    zip,
    request_procedure,
    status
    from 
        pathology_lab_import
    order by path_lab_id;

    perform setval('path_lab_path_lab_id_seq', max(path_lab_id)) from path_lab;
end;
$BODY$
language plpgsql;