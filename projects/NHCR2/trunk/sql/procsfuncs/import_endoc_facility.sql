create function import_endo_fac()
returns void as 
$BODY$
begin
    insert into endo_fac (
        facility_id,
        endo_code) 
    select
        facility_id,
        endo_code
    from 
        endo_fac_import;
end;
$BODY$
language plpgsql;