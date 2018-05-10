create or replace function public.get_specimen_count (in in_path_report_id integer)
returns varchar as
$BODY$
declare
    lcl_count integer;
begin

    select count(*) into lcl_count from specimen where path_report_id = in_path_report_id;

    return lcl_count;

end;
$BODY$
language plpgsql;
grant execute on public.get_specimen_count to NHCR2_data;
    