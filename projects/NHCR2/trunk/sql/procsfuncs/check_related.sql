create or replace function check_related (in in_event_id integer)
returns integer as
$BODY$
declare
    lcl_colo integer;
    lcl_follow_up integer;
    lcl_path_report integer;
    lcl_path_request integer;
    lcl_polyp2 integer;
    lcl_survey integer;
begin
    select count(*) from colo into lcl_colo where event_id = in_event_id;
    select count(*) from follow_up into lcl_follow_up where fu_event_id = in_event_id;
    select count(*) from path_report into lcl_path_report where event_id = in_event_id;
    select count(*) from path_request into lcl_path_request where event_id = in_event_id;
    select count(*) from polyp2 into lcl_polyp2 where event_id = in_event_id;
    select count(*) from survey into lcl_survey where event_id = in_event_id;

    if (lcl_colo > 0 or lcl_follow_up > 0 or lcl_path_report > 0 or lcl_path_request > 0 or lcl_polyp2 > 0 or lcl_survey > 0 )then 
        return 1;
    else
        return 0;
    end if;

end;
$BODY$
language plpgsql;
    