create or replace function public.check_for_dup (in in_last_name varchar, in in_first_name varchar)
returns varchar as
$BODY$
declare
    lcl_check integer;
begin
    select count(*) into lcl_check from person where upper(last_name) = upper(in_last_name) and upper(first_name) = upper(in_first_name); 
    if (lcl_check > 0)then 
        return 'Possible Duplicate';
    else
        return 'OK';
    end if;

end;
$BODY$
language plpgsql;