create function import_path_request()
returns void as 
$BODY$
begin
    insert into path_request (
    path_request_id,
    action_on,
    action_by,
    record_comment,
    inserted_on,
    inserted_by,
    event_id,
    print_date,
    recvd_date,
    n_a_reason,
    notes,
    med_rec_num,
    no_path_report,
    path_report_id,
    temp_last_name,
    temp_dob,
    temp_endo_info,
    fac_requires_request)
    select
    request_id ,
    safe_cast(mod_rec_date, null::timestamp),
    mod_rec_user,
    'import from 4D',
    new_rec_date,
    new_rec_user ,
    colo_visit_id ,
    safe_cast(print_date,null::date),
    safe_cast(recvd_date,null::date),
    n_a_reason,
    notes,
    med_rec_num ,
    no_path_report ,
    path_report_id ,
    temp_last_name ,
    temp_dob ,
    temp_endo_info ,
    fac_requires_request 
    from path_request_import
    order by request_id;

    perform setval('path_request_path_request_id_seq', max(path_request_id)) from path_request;
end;
$BODY$
language plpgsql;