create or replace function create_event_pathlink(
    in_person_id integer,
    in_event_date character varying,
    in_patient_barcode character varying,
    in_endo_code character varying)
returns table (
    lcl_batch_id integer) AS
$BODY$

begin

    select batch_id into lcl_batch_id from batch where 
        facility_id = in_facility_id and
        path_link = 1 and
        first_pass_done = 1 and
        last_pass_done = 1 and
        path_link_closed = 0;

    insert into public.event (
        person_id, 
        event_date, 
        event_type, 
        patient_barcode, 
        endo_barcode, 
        endo_code, 
        patient_form_double_entered, 
        endo_form_double_entered, batch_id)
    values (
        in_person_id, 
        in_event_date, 
        'LINK', 
        in_patient_barcode, 
        'pathlink', 
        in_endo_code, 
        1, 
        1, 
        lcl_batch_id);

    return query select 
        in_path_request_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.create_event_pathlink(integer, character varying, character varying, character varying) to NHCR2_rc; 