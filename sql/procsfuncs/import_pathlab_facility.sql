create function import_pathlab_facility()
returns void as 
$BODY$
begin
    insert into pathlab_facility(
    record_comment,
    facility_id,
    lab_code)
    select
    'import from 4D',
    facility_id,
    lab_code
    from 
        pathlab_facility_import
    order by lab_code;
end;
$BODY$
language plpgsql;