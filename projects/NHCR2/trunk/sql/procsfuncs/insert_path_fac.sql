create function insert_path_fac (in in_facility_id character varying, in in_lab_code character varying)
returns void as 
$BODY$
begin
    if not exists (select * from pathlab_facility where facility_id = in_facility_id and lab_code = in_lab_code) then
        insert into pathlab_facility (facility_id, lab_code) values (in_facility_id,in_lab_code);
    end if;
end;
$BODY$
language plpgsql