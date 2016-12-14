create or replace function set_event(
    in in_event_id integer,
    in in_endo_barcode character varying,
    in in_patient_barcode character varying,
    in in_event_date character varying,
    in in_medical_record_number character varying,
    in in_endo_code character varying,
    in in_est_exam_date integer,
    in in_not_approached integer,
    in in_signature_present integer,
    in in_disabled integer,
    in in_comments character varying
)
returns table (
    lcl_event_id character varying, 
    lcl_message character varying) AS
$BODY$
    declare lcl_event_date date;
    declare lcl_endo_code integer;
begin

    if (in_endo_code ='') then
        lcl_endo_code = null;
    else
        lcl_endo_code = cast(in_endo_code as integer);
    end if;
        
    if (in_event_date = '') then
        lcl_event_date = null;
    else
        lcl_event_date = cast (in_event_date as date);
    end if;

    if exists(select * from event where event_id = in_event_id) then
        update event set
        event_date = lcl_event_date , 
        comments = in_comments , 
        patient_barcode = in_patient_barcode , 
        endo_barcode = in_endo_barcode , 
        medical_record_number = in_medical_record_number , 
        endo_code = lcl_endo_code , 
        est_exam_date = in_est_exam_date , 
        signature_present = in_signature_present , 
        not_approached = in_not_approached , 
        disabled = in_disabled
            where event_id = in_event_id;
    else 
        insert into event (
        event_id ,
        event_date ,
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
        in_event_id ,
        lcl_event_date ,
        in_comments ,
        in_patient_barcode ,
        in_endo_barcode ,
        in_medical_record_number ,
        lcl_endo_code ,
        in_est_exam_date ,
        in_signature_present ,
        in_not_approached ,
        in_disabled
        );
    end if;

    select in_event_id into lcl_event_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_event_id, lcl_message;
end;
$BODY$
language plpgsql
