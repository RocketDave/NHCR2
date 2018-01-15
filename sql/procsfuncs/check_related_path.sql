create or replace function check_related_path (in in_path_report_id integer)
returns integer as
$BODY$
declare
    lcl_specimen integer;
begin
    select count(*) from specimen into lcl_specimen where path_report_id = in_path_report_id;

    if (lcl_specimen > 0)then 
        return 1;
    else
        return 0;
    end if;

end;
$BODY$
language plpgsql;