create function move_path_lab()
returns void as 
$BODY$
begin
    insert into path_lab (
    path_lab_id ,
    action_on,
    action_by ,
    inserted_on,
    inserted_by ,
    lab_name ,
    lab_code ,
    contact1_name ,
    contact1_phone ,
    contact1_email ,
    address1 ,
    address2 ,
    city ,
    state ,
    zip ,
    request_procedure,
    notes ,
    status ,
    path_report_trigger)
    select
    path_lab_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by ,
    lab_name ,
    lab_code ,
    contact_first_name || ' ' ||    contact_last_name,
    phone1,
    contact_email ,
    address1 ,
    address2 ,
    city ,
    state,
    zip ,
    request_procedure,
    notes ,
    status ,
    path_report_trigger 
        from 
            path_lab_old
        order by path_lab_id;
end;
$BODY$
language plpgsql;