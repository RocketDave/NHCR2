create view public.vColosAll as select
    colo_id,
    c.event_id,
    event_date,
    facility_name,
    scan_batch,
    e.batch_id
    from colo c left outer join event e on c.event_id = e.event_id
    	left outer join batch b on e.batch_id = b.batch_id
        left outer join facility f on b.facility_id = f.facility_id
    order by 
    colo_id ;
grant select on public.vColosAll to NHCR2_rc;