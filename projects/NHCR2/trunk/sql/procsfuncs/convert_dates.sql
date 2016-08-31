create or replace function fix_dates (in_date character varying)
returns date
$BODY
declare
    lcl_indx integer;
    lcl_str character varying(10);
    lcl_pos integer;
    lcl_m integer;
    lcl_d integer;
    lcl_y integer;
begin
    lcl_pos = position('/' in in_date);
    if lcl_pos = 0 then {
        lcl_str = substring(in_date,1,4) || '/' || 
        substring(in_date,5,2)  || '/' || 
        substring(in_date,7,2)
    }
    else {
        lcl_m = substring(in_date,1,lcl_pos-1);
        lcl_str = substring(in_date,lcl_pos + 1);
        lcl_pos = position('/' in lcl_str);
        lcl_d = substring(lcl_str,lcl_pos-1);
        lcl_str = substring(lcl_str,lcl_pos + 1);
        lcl_y = substring(lcl_str,1,2);
        lcl_str = '20' || lcl_y || '-' || lcl_m || lcl_d;
    }
    end if;
    return lcl_string
end;
$BODY$
language plpgsql;
    