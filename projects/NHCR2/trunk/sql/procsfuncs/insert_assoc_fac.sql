create function insert_assoc_fac (in in_parent_id character varying, in in_assoc_fac_id character varying, in_assoc_fac_name character varying)
returns void as 
$BODY$
begin
    if not exists (select * from assoc_facility where parent_facility_id = in_parent_id and assoc_fac_id = in_assoc_fac_id) then
        insert into assoc_facility (parent_facility_id, assoc_fac_id, assoc_facility_name ) values (in_parent_id,in_assoc_fac_id,in_assoc_fac_name);
    end if;
end;
$BODY$
language plpgsql