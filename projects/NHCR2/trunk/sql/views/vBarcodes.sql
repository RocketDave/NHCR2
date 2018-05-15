create view public.vBarcodes as select
    e.event_id,
    e.inserted_on as event_created,
    patient_barcode,
    endo_barcode,
    c.inserted_on as colo_created,
    c.barcode as colo_barcode,
    s.inserted_on as survey_created,
    s.barcode as survey_barcode
    from event e left outer join colo c on e.event_id = c.event_id
    left outer join survey s on e.event_id = s.event_id
    where patient_barcode != 'Pathlink' and endo_barcode != 'Pathlink' and ((c.barcode is null and endo_barcode is not null) or 
        (s.barcode is null and patient_barcode is not null));
grant select on public.vBarcodes to NHCR2_rc;
