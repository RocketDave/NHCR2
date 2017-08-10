create or replace function check_container (in_path_report_id integer, in_specimen_type varchar, in_specimen_id integer, in_container varchar)
returns integer as
$BODY$
declare
    lcl_count integer;

begin
    select count(*) from specimen into lcl_count 
        where path_report_id =in_path_report_id and specimen_type = in_specimen_type and 
            container = in_container and specimen_id != in_specimen_id;

    if lcl_count > 0 then
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql;
    