create function get_suffix(in in_name varchar)
returns varchar AS
$BODY$
declare lcl_suffix varchar;
begin
	select trim(substring(in_name from position(' ' in in_name) + 1)) into lcl_suffix;
	return lcl_suffix;
end;
$BODY$
language plpgsql