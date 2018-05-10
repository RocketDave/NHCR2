create or replace function public.get_responses (in in_table varchar, in in_column varchar)
returns table (
    lcl_responses varchar) AS
$BODY$
    declare lcl_sql varchar;
begin
    select into lcl_sql  
        'select ' || in_column || ' from ' || in_table ||
        ' group by ' || in_column;
   return query execute lcl_sql;
end;
$BODY$
language plpgsql