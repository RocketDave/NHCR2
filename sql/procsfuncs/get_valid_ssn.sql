create or replace function get_valid_ssn (in in_person_id integer)
returns varchar as
$BODY$
declare
    lcl_ssn varchar;
begin
	select ssn into lcl_ssn from person where person_id = in_person_id;
	if (substring(lcl_ssn,1,3) = '999') then 
		select '' into lcl_ssn;
	end if;
	return lcl_ssn;
		
end;
$BODY$
language plpgsql;