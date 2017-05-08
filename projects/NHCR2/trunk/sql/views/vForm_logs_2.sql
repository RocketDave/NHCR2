create view vform_logs_2 as select
    form_log_id,
    fl.action_on,
    fl.action_by,
    to_char(fl.inserted_on,'yyyy-mm-dd') as inserted_on,
    fl.inserted_by ,
    fl.facility_id,
    f.facility_name,
    form_is_patient,
    start_barcode,
    end_barcode,
    to_char(ship_date,'yyyy-mm-dd') as ship_date
    from form_log fl join facility f on fl.facility_id = f.facility_id ;
grant select on vform_logs_2 to NHCR2_rc, NHCR2_staff;