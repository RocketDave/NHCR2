create function import_assoc_facility()
returns void as 
$BODY$
begin
    insert into assoc_facility (
        id,
        inserted_on,
        inserted_by,
        parent_facility_id,
        assoc_fac_id,
        assoc_facility_name,
        notes) 
    select
        id,
        create_date,
        create_user,
        parent_facility_id,
        trim(assoc_fac_id),
        assoc_facility_name,
        notes
    from 
        assoc_facility_import
    order by id;

    perform setval('assoc_facility_assoc_facility_id_seq', max(assoc_facility_id)) from assoc_facility;
end;
$BODY$
language plpgsql;