create function import_other_name()
returns void as 
$BODY$
begin

insert into other_name (
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    person_id,
    last_name,
    maiden_flag)
select
    modify_date,
    modify_user,
    create_date,
    create_user,
    person_id,
    last_name,
    convert_true_false(maiden_flag)
from other_name_import;
end;
$BODY$
language plpgsql;