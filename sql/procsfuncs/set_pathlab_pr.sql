create or replace function set_pathlab_pr(
    in in_path_lab_id integer,
    in in_path_report_trigger varchar,
    in in_request_procedure varchar
)
returns table (
    lcl_path_lab_id varchar, 
    lcl_message varchar) AS
$BODY$

begin
    update path_lab set 
        path_report_trigger = in_path_report_trigger,
        request_procedure = in_request_procedure
    where path_lab_id = in_path_lab_id;

    select 'Record Updated' into lcl_message;
    select in_path_lab_id into lcl_path_lab_id;

    return query select 
        lcl_path_lab_id, lcl_message;
end;
$BODY$
language plpgsql
