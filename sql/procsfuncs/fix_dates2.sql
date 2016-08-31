create or replace function fix_dates2 (in_date character varying)
returns date as
$BODY$
begin
    if in_date = '00/00/00' then
        return null;
    else
        return  cast(in_date as date);
    end if;
end;
$BODY$
language plpgsql