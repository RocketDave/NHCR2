CREATE OR REPLACE FUNCTION convert_true_false(in_string character varying)
returns smallint as 
$BODY$
begin
if in_string = 'True' then
    return 1;
elseif in_string = 'False' then
    return 0;
else
    return null;
end if;

end;
$BODY$
language plpgsql;