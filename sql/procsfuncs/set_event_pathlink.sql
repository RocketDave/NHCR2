create or replace function set_event_pathlink(
    in in_event_id integer,
    in in_person_id integer,
    in in_facility_id varchar,
    in in_event_date varchar,
    in in_endo_code varchar,
    in in_est_exam_date integer,
    in in_comments varchar
)
returns table (
    lcl_event_id varchar, 
    lcl_message varchar) AS
$BODY$
    declare lcl_event_date date;
    declare lcl_batch_id integer;
    declare lcl_endo_code integer;
begin

    select batch_id into lcl_batch_id from batch where 
        facility_id = in_facility_id and
        path_link = 1;

    if in_endo_code = '' then
        select null into lcl_endo_code;
    else
        lcl_endo_code = cast(in_endo_code as integer);
    end if;
    
    if in_event_date = '' then
        select null into lcl_event_date;
    else
        lcl_event_date = cast (in_event_date as date);
    end if;

    if exists(select * from event where event_id = in_event_id) then
        update event set
        event_date = lcl_event_date , 
        event_type = 'LINK',
        batch_id = lcl_batch_id,
        person_id = in_person_id,
        comments = in_comments , 
        patient_barcode = 'PathLink' , 
        endo_barcode = 'PathLink' , 
        endo_code = lcl_endo_code , 
        est_exam_date = in_est_exam_date
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
        endo_code ,
        est_exam_date 
        )
        values (
        in_person_id,
        lcl_event_date ,
        'LINK',
        lcl_batch_id,
        in_comments ,
        'PathLink' ,
        'PathLink' ,
        lcl_endo_code,
        in_est_exam_date
        );
        select 'Record Updated' into lcl_message;
    end if;

    if (in_event_id = -9) then
        select currval('event_event_id_seq') into lcl_event_id;
    else
        lcl_event_id = in_event_id;
    end if;

    return query select 
        lcl_event_id, lcl_message;
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_event_pathlink(integer, integer, varchar, varchar, varchar, integer, varchar) to NHCR2_rc; 
