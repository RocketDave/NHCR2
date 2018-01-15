create function import_event2()
returns void as 
$BODY$
begin

    insert into event (
        event_id,
        action_on,
        action_by,
        inserted_on,
        inserted_by,
        person_id,
        event_type,
        event_date,
        event_desc,
        comments,
        batch_id,
        second_batch,
        patient_barcode,
        endo_barcode,
        ref_phys_last,
        ref_phys_first,
        medical_record_number,
        endo_code,
        est_exam_date,
        chase_trace,
        patient_form_double_entered,
        signature_present,
        not_approached,
        disabled,
        report_group_code,
        endo_form_double_entered)
    select
        event_id,
        to_timestamp(modify_date || ' 00:00:00','yyyy/mm/dd hh24:mi:ss'),
        modify_user,
        create_date,
        create_user,
        person_id,
        event_type,
        safe_cast(event_date,null::timestamp),
        event_desc,
        comments,
        batch_id,
        second_batch,
        patient_barcode,
        endo_barcode,
        ref_phys_last,
        ref_phys_first,
        medical_record_number,
        endo_code,
        est_exam_date,
        chase_trace,
        patient_form_double_entered,
        signature_present,
        not_approached,
        disabled,
        report_group_code,
        endo_form_double_entered
    from 
        event_import
    order by event_id;

    perform setval('event_event_id_seq', max(event_id)) from event;

end;
$BODY$
language plpgsql;