create view public.vdup_path_reports as select 
    p.path_report_id, 
    p.inserted_on,
    dups.event_id,
    pathology_date,
    case_no,
    path_report_complete,
	total_specimens from
    (select  event_id,count(*) from path_report where event_id is not null group by event_id having count(*) > 1 ) as dups 
    join path_report p on dups.event_id = p.event_id left outer join (select path_report_id,count(*) as total_specimens from specimen group by path_report_id)  as specimens 
	on p.path_report_id = specimens.path_report_id
	order by p.event_id,p.inserted_on;
grant select on  public.vdup_path_reports to nhcr2_rc;
