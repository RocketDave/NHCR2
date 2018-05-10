create or replace function public.get_responses2 (in in_table varchar, in in_column varchar)
returns varchar

$BODY$
    declare lcl_sql varchar;
begin

    select into lcl_sql  
        'select string_agg(distinct ' || in_column || ','','') from ' || in_table ;

   return query execute lcl_sql;
end;
$BODY$
language plpgsql
