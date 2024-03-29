﻿create or replace function import_facility()
returns void as 
$BODY$
begin
    insert into facility (
    facility_id ,
    action_on,
    action_by,
    record_comment ,
    inserted_on,
    inserted_by ,
    facility_name ,
    facility_pseudo_name ,
    address1 ,
    address2 ,
    address3 ,
    city ,
    state ,
    zip ,
    fax ,
    status ,
    status_date,
    implementation_date,
    ctc,
    facility_type ,
    how_write_reports ,
    comments ,
    contact1_name ,
    contact1_phone ,
    contact1_email ,
    contact1_type ,
    contact2_name ,
    contact2_phone ,
    contact2_email ,
    contact2_type ,
    contact3_name ,
    contact3_phone ,
    contact3_email ,
    contact3_type ,
    pth_reports_contact_name ,
    pth_reports_contact_phone ,
    pth_reports_contact_email ,
    pth_req_required,
    pth_consent_form_reqd,
    pth_req_sort_col ,
    pth_req_instructions,
    irb_of_record ,
    irb_review_date,
    irb_consent_form ,
    irb_active_consent_version ,
    irb_approval_date,
    irb_expiration_date,
    irb_contact_name ,
    irb_contact_phone ,
    irb_contact_email 

) select
        facility_id,
        to_timestamp(modify_date || ' ' || to_char(modify_time, 'HH24:MI:SS'),'yyyy/mm/dd hh24:mi:ss'),
        modify_user,
        null,
        create_date,
        create_user,
        facility_name,
        facility_pseudo_name,
        address1,
        address2,
        address3,
        city,
        state,
        zip,
        fax,
        status,
        status_date,
        implementation_date,
        convert_true_false(ctc),
        facility_type,
        how_write_reports,
        comments,
        contact_doctor_name,
        contact_doctor_phone,
        contact_doctor_email,
        'doctor',
        contact_staff_name,
        contact_staff_phone,
        contact_staff_email,
        'staff',
        contact_computer_name,
        contact_computer_phone,
        contact_computer_email,
        'computer',
        contact_reports_name,
        contact_reports_phone,
        contact_reports_email,
        convert_true_false(pth_req_required),
        convert_true_false(pth_consent_form_reqd),
        pth_req_sort_col,
        pth_req_instructions,
        null,
        null,
        null,
        null,
        null,
        null,
        contact_irb_name,
        contact_irb_phone,
        contact_irb_email
    from 
        facility_import
    order by facility_id;
end;
$BODY$
language plpgsql;