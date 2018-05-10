create or replace function get_related_eventid (in in_event_id integer)
returns varchar as
$BODY$
declare
    lcl_related varchar;
begin
    select '' into lcl_related ;
    if exists (select * from colo where event_id = in_event_id) then lcl_related = lcl_related || 'colo, '; end if;
    if exists (select * from follow_up where fu_event_id = in_event_id) then lcl_related = lcl_related || 'follow_up, '; end if;
    if exists (select * from path_report where event_id = in_event_id) then lcl_related = lcl_related || 'path_report, '; end if;
    if exists (select * from specimen s join path_report p on s.path_report_id = p.path_report_id where p.event_id = in_event_id) then lcl_related = lcl_related || 'specimen, '; end if;
    if exists (select * from path_request where event_id = in_event_id) then lcl_related = lcl_related || 'path_request, '; end if;
    if exists (select * from polyp2 where event_id = in_event_id) then lcl_related = lcl_related || 'polyp2, '; end if;
    if exists (select * from survey where event_id = in_event_id) then lcl_related = lcl_related || 'survey '; end if;
    if (substring(lcl_related,length(lcl_related),1) = ',') then
        lcl_related = substring(lcl_related,1,length(lcl_related)-1);
    end if;

    return lcl_related;

end;
$BODY$
language plpgsql;
    