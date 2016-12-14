create function import_event()
returns void as 
$BODY$
begin
    update event_import set event_date = null where event_date like '%00/00%';
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
        cast(event_date as date),
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
end;
$BODY$
language plpgsql;