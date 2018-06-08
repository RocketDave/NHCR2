create or replace function get_related_personid (in in_person_id integer)
returns varchar as
$BODY$
declare
    lcl_related varchar;
begin
    select '' into lcl_related ;

    if exists (select * from event where person_id = in_person_id) then lcl_related = lcl_related || 'events, '; end if;
    if exists (select * from follow_up where fu_person_id = in_person_id) then lcl_related = lcl_related || 'follow_up, '; end if;
    if exists (select * from other_name where person_id = in_person_id) then lcl_related = lcl_related || 'other_name'; end if;

    if (substring(lcl_related,length(lcl_related),1) = ',') then
        lcl_related = substring(lcl_related,1,length(lcl_related)-1);
    end if;

    return lcl_related;

end;
$BODY$
language plpgsql;
    