create or replace function check_related_person (in in_person_id integer)
returns integer as
$BODY$
declare
    lcl_event integer;
    lcl_other_name integer;
    lcl_follow_up integer;
    lcl_survey integer;
begin
    select count(*) from event into lcl_event where person_id = in_person_id;
    select count(*) from other_name into lcl_other_name where person_id = in_person_id;
    /*select count(*) from follow_up into lcl_follow_up where fu_person_id = in_person_id;*/
    /*select count(*) from survey s join event e on s.event_id = e.event_id into lcl_survey where e.person_id = in_person_id;*/

    if (lcl_event > 0 or lcl_other_name > 0)then 
        return 1;
    else
        return 0;
    end if;

end;
$BODY$
language plpgsql;