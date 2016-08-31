create or replace function fix_dates (in_date character varying)
returns date as
$BODY$
declare
    lcl_indx integer;
    lcl_str character varying(20);
    lcl_pos integer;
    lcl_m character varying(2);
    lcl_d character varying(2);
    lcl_y character varying(2);
begin
    lcl_pos = position('/' in in_date);
    if lcl_pos = 0 then
        lcl_str = substring(in_date,1,4) || '-' || 
        substring(in_date from 5 for 2)  || '-' || 
        substring(in_date from 7 for 2);  
    else
        lcl_m = substring(in_date from 1 for lcl_pos-1); -- first 2
        lcl_str = substring(in_date from lcl_pos + 1); -- remove first 2
        lcl_pos = position('/' in lcl_str); --find next
        lcl_d = substring(lcl_str from 1 for lcl_pos-1);
        lcl_str = substring(lcl_str from lcl_pos + 1);
        lcl_y = substring(lcl_str,1,2);
        lcl_str = '20' || lcl_y || '-' || lcl_m || '-' || lcl_d;
    end if;
    return  cast(lcl_str as date);
end;
$BODY$
language plpgsql