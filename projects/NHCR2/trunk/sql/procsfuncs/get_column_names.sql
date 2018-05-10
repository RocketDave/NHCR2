
CREATE OR REPLACE FUNCTION public.get_column_names(in in_schema varchar, in in_table varchar)
  RETURNS TABLE(
  table_name1 varchar,
  column_names varchar, 
  column_types varchar) 
AS
$$
begin
    return query select 
    table_name :: varchar,
    column_name :: varchar, 
    data_type :: varchar
    from information_schema.columns 
        where table_schema = in_schema and table_name =  in_table;
end;
$$ LANGUAGE plpgsql;
