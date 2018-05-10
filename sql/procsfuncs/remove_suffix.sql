create function remove_suffix(in in_name varchar)
returns varchar AS
$BODY$
declare lcl_suffix varchar;
declare lcl_name varchar;
declare lcl_len1 integer;
declare lcl_len2 integer;
declare lcl_pos integer;
begin
	select substring(in_name from position(' ' in in_name) + 1) into lcl_suffix;
	select position(' ' in in_name) - 1 into lcl_pos;
	select substring(in_name from 1 for lcl_pos) into lcl_name;
	select length(in_name) into lcl_len1;
	select length(lcl_suffix) into lcl_len2;
	if (lcl_len2 < 4) then
		return lcl_name;
	else
		return in_name;
	end if;
end;
$BODY$
language plpgsql