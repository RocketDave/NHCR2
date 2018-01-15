create function get_gender(in in_person_id bigint)
returns varchar AS
$BODY$
declare lcl_gender varchar;
begin
    select gender_calcd into lcl_gender from person where person_id = in_person_id;
    return lcl_gender;
end;
$BODY$
language plpgsql