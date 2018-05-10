create or replace function delete_path_specimens (in in_path_report_id integer)
returns table (
    lcl_message varchar) AS
$BODY$
declare
    lcl_count integer;

begin

    delete from specimen where path_report_id = in_path_report_id;
    delete from path_report where path_report_id = in_path_report_id;
    select 'Record Deleted' into lcl_message;
    
    return query select lcl_message;
end;
$BODY$
language plpgsql;
    