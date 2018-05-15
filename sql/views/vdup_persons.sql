create view public.vdup_persons as select 
    p.person_id, 
	p.ssn,
    p.inserted_on,
    p.last_name,
    p.first_name,
    p.middle_name,
    p.dob,
	get_events(p.person_id) as 'Event Dates'
    from
    (select  last_name,first_name,dob,count(*) from person group by last_name,first_name,dob having count(*) > 1 ) as dups 
    join person p on p.last_name = dups.last_name and p.first_name = dups.first_name and p.dob = dups.dob
	order by p.last_name,p.first_name;
grant select on  public.vdup_persons to nhcr2_rc;
