create view vBatches as select
    batch_id ,
    b.action_on,
    b.action_by,
    to_char(b.inserted_on,'yyyy-mm-dd') as inserted_on,
    b.inserted_by ,
    b.facility_id,
    f.facility_name,
    to_char(arrival_date,'yyyy-mm-dd') as arrival_date,
    entry_completed,
    to_char(entry_completed_on,'yyyy-mm-dd') as entry_completed_on,
    refusals_with_r ,
    refusals_without_r ,
    refusals_without_g ,
    unsigned_with_r ,
    unsigned_without_r ,
    orphans,
    language,
    disabled,
    not_approached,
    b.comments
    from batch b join facility f on b.facility_id = f.facility_id 
    order by b.batch_id;
grant select on vBatches to NHCR2_rc;