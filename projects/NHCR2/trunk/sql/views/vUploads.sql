create view public.vuploads as select
    to_char(inserted_on,'mm/dd/yyyy') as inserted_on,
    inserted_by,
    file_name,
    records_loaded,
    duplicates,
    colo_records,
    polyp2_records,
    survey_records,
    no_barcode 
    from upload order by inserted_on,inserted_by;
grant select on public.vuploads to NHCR2_rc;