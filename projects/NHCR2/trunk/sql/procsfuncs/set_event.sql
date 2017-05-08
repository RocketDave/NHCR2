create or replace function set_event(
    in in_event_id integer,
    in in_person_id integer,
    in in_endo_barcode varchar,
    in in_patient_barcode varchar,
    in in_event_date varchar,
    in in_event_type varchar,
    in in_batch_id integer,
    in in_medical_record_number varchar,
    in in_endo_code varchar,
    in in_est_exam_date integer,
    in in_not_approached integer,
    in in_signature_present integer,
    in in_disabled integer,
    in in_comments varchar,
    in in_facility_id varchar
)
returns table (
    lcl_event_id varchar, 
    lcl_message varchar) AS
$BODY$
    declare lcl_barcode_check_p integer;
    declare lcl_barcode_check_e integer;
begin

    if in_endo_code = '' then
        select null into in_endo_code;
    end if;
    
    if in_event_date = '' then
        select null into in_event_date;
    end if;

    -- uncomment 2 lines below for production
    --select check_barcode(in_patient_barcode,in_facility_id) into lcl_barcode_check_p; 
    --select check_barcode(in_endo_barcode,in_facility_id) into lcl_barcode_check_e;
    select 1 into lcl_barcode_check_p,lcl_barcode_check_e; -- remove this line for production

    if (lcl_barcode_check_p = 0 or lcl_barcode_check_p = 0) then
        select 'Barcode does not match barcodes for this facility' into lcl_message;
    elseif exists(select * from event where person_id = in_person_id and event_date = cast(in_event_date as date) and event_id != in_event_id) then
        select 'Event already exists for that date' into lcl_message;
    elseif exists(select * from event where event_id = in_event_id) then
        update event set
        event_date = cast(event_date as date) , 
        event_type = in_event_type,
        batch_id = in_batch_id,
        person_id = in_person_id,
        comments = in_comments , 
        patient_barcode = in_patient_barcode , 
        endo_barcode = in_endo_barcode , 
        medical_record_number = in_medical_record_number , 
        endo_code = cast(in_endo_code as integer), 
        est_exam_date = in_est_exam_date , 
        signature_present = in_signature_present , 
        not_approached = in_not_approached , 
        disabled = in_disabled
            where event_id = in_event_id;
        select 'Record Updated' into lcl_message;
    else 
        insert into event (
            person_id,
            event_date ,
            event_type,
            batch_id,
            comments ,
            patient_barcode ,
            endo_barcode ,
            medical_record_number ,
            endo_code ,
            est_exam_date ,
            signature_present ,
            not_approached ,
            disabled 
            )
        values (
            in_person_id,
            cast(in_event_date as date),
            in_event_type,
            in_batch_id,
            in_comments ,
            in_patient_barcode ,
            in_endo_barcode ,
            in_medical_record_number ,
            cast(in_endo_code as integer) ,
            in_est_exam_date ,
            in_signature_present ,
            in_not_approached ,
            in_disabled);
        select 'Record Updated' into lcl_message;
    end if;

    if (in_event_id = -9 and lcl_message = 'Record Updated') then
        select currval('event_event_id_seq') into lcl_event_id;
    else
        lcl_event_id = in_event_id;
    end if;

    return query 
        select lcl_event_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_event(integer, integer, varchar, varchar, varchar, varchar, integer, varchar, varchar, integer, integer, integer, integer,varchar,varchar) to NHCR2_rc; 
