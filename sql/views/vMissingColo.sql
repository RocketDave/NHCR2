create view public.vMissingColo as 
    select 
        e.event_date,e.event_id,	b.facility_id, e.batch_id,endo_barcode,	last_name,	first_name,	e.person_id 
    from 
        event e left outer join colo c on e.event_id = c.event_id 
    join 
        person p on e.person_id = p.person_id 
    join 
        batch b on e.batch_id = b.batch_id 
    where 
        c.event_id is null and e.endo_barcode is not null and 
        e.endo_barcode != '' and e.endo_barcode != 'PathLink' and 
        e.event_date >= '2017-06-01' and e.event_date <= '2017-12-31'
    order by 
        e.batch_id,last_name;
grant select on public.vMissingColo to nhcr2_data