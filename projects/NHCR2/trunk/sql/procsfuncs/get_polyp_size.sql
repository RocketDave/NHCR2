create function public.get_polyp_size (in in_size varchar)
returns varchar as
$BODY$
declare
    lcl_size varchar;

begin
    select '' into lcl_size;

    if in_size = '99' then 
        lcl_size = 'unknown';
    elseif in_size = '1'  then 
        lcl_size = '<5';
    elseif in_size = '2'  then 
        lcl_size = '5-9';
    elseif in_size = '3'  then 
        lcl_size = '1.0-2.0';
    elseif in_size = '4'  then 
        lcl_size = '>2.0'; 
    end  if;

    return lcl_size;
end;
$BODY$
language plpgsql;
    