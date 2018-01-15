create view vform_logs_p as select
    form_log_id,
    fl.action_on,
    fl.action_by,
    fl.inserted_on,
    fl.inserted_by ,
    fl.facility_id,
    f.facility_name,
    case when form_is_patient=1 then 'Patient' else 'Endoscopy' end as form_is_patient,
    start_barcode,
    end_barcode,
    ship_date
    from form_log fl join facility f on fl.facility_id = f.facility_id ;
grant select on vform_logs_p to NHCR2_rc, NHCR2_staff;