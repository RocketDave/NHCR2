
CREATE OR REPLACE FUNCTION public.get_table_names(in in_table_schema varchar)
  RETURNS TABLE(tablenames varchar, tabletypes varchar) 
  AS
$$
begin
    return query select 
        table_name :: varchar, 
        table_type :: varchar 
    from information_schema.tables where table_schema = in_table_schema;
end;
$$
LANGUAGE plpgsql;
