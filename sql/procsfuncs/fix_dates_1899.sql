create or replace function fix_dates_1899 (in_date date)
returns date as
$BODY$
begin
    if extract (year from in_date) = 1899 then --when 4D import comes through as 12/29/1899 
        return null;
    else
        return  in_date;
    end if;
end;
$BODY$
language plpgsql