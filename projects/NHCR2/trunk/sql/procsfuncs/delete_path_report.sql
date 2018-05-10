create or replace function delete_path_report (in in_path_report_id integer)
returns table (
    lcl_message varchar) AS
$BODY$
declare
    lcl_count integer;

begin

    select check_related_path(in_path_report_id) into lcl_count;

    if lcl_count = 0 then 
        delete from path_report where path_report_id = in_path_report_id;
        select 'Record Deleted' into lcl_message;
    else
        select 'Cannot delete path report - related records exist. Please delete the specimen records first.' into lcl_message;
    end if;

    return query select lcl_message;
end;
$BODY$
language plpgsql;
    