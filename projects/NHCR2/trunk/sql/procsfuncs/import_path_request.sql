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
    fix_dates2(mod_rec_date),
    mod_rec_user ,
    'import from 4D',
    new_rec_date,
    new_rec_user ,
    colo_visit_id ,
    fix_dates2(print_date),
    fix_dates2(recvd_date),
    n_a_reason,
    notes,
    med_rec_num ,
    no_path_report ,
    path_report_id ,
    temp_last_name ,
    fix_dates2(temp_dob) ,
    temp_endo_info ,
    fac_requires_request 
    from path_request_import
    order by request_id;
end;
$BODY$
language plpgsql;