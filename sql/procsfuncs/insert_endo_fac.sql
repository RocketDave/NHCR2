create function insert_endo_fac (in in_facility_id character varying, in in_endo_code integer)
returns void as 
$BODY$
begin
    if not exists (select * from endo_fac where facility_id = in_facility_id and endo_code = in_endo_code) then
        insert into endo_fac (facility_id, endo_code) values (in_facility_id,in_endo_code);
    end if;
end;
$BODY$
language plpgsql