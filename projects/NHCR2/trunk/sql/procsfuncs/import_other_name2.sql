create or replace function import_other_name2()
returns void as 
$BODY$
begin

update other_name_import set modify_date = null where modify_date = '00/00/00';
update other_name_import set create_date = null where create_date = '00/00/00';

insert into other_name (
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    person_id,
    last_name,
    maiden_flag)
select
    safe_cast(modify_date,null::timestamp),
    modify_user,
    safe_cast(create_date,null::date),
    create_user,
    person_id,
    last_name,
    maiden_flag
from other_name_import;
end;
$BODY$
language plpgsql;