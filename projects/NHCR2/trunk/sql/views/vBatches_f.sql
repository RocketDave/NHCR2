create view vbatches_f as select
    batch_id ,
    b.facility_id,
    f.facility_name,
    --to_char(arrival_date,'mm/dd/yyyy') as arrival_date
    arrival_date
    from batch b join facility f on b.facility_id = f.facility_id 
    order by b.batch_id;
grant select on vBatches_f to NHCR2_rc;