create or replace function check_barcode (in_barcode varchar, in_facility_id varchar)
returns integer as
$BODY$
declare
    lcl_letter varchar;
    lcl_num integer;
    lcl_count integer;

begin
    select substring (in_barcode,1,1) into lcl_letter;
    select safe_cast(substring (in_barcode,2,7),null::integer) into lcl_num;

    select count(*) from form_log where (facility_id = in_facility_id or 
        facility_id in (select assoc_fac_id from assoc_facility where parent_facility_id = in_facility_id)) and 
        substring(start_barcode,1,1) = lcl_letter  and 
        lcl_num >= safe_cast(substring(start_barcode,2,7),null::integer) and 
        substring(end_barcode,1,1) = lcl_letter  and 
        lcl_num <= safe_cast(substring(end_barcode,2,7),null::integer)
        into lcl_count;

    if lcl_count > 0 then
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql;
    