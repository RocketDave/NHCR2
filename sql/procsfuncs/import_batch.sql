﻿create or replace function import_batch()
returns void as 
$BODY$
begin

update batch_import set create_date = null where create_date = '1899-12-29';
update batch_import set modify_date = null where modify_date = '1899-12-29';

insert into batch (
    batch_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by ,
    facility_id ,
    arrival_date ,
    comments,
    path_link)
    select
    batch_id,
    cast(modify_date as timestamp),
    modify_user,
    cast(create_date as date),
    create_user,
    facility_id,
    arrival_date,
    comments,
    path_link
    from batch_import
    order by batch_id;

perform setval('batch_batch_id_seq', max(batch_id)) from batch;
end;


$BODY$
language plpgsql;