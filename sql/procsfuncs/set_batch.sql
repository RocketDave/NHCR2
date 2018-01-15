create or replace function public.set_batch(
    in in_batch_id integer,
    in in_facility_id varchar,
    in in_arrival_date varchar,
    in in_entry_completed smallint,
    in in_entry_completed_on varchar,
    in in_refusals_with_r integer,
    in in_refusals_without_r integer,
    in in_refusals_without_g integer,
    in in_unsigned_with_r integer,
    in in_unsigned_without_r integer,
    in in_orphans integer,
    in in_not_approached integer,
    in in_disabled integer,
    in in_language integer,
    in in_comments varchar
)
returns table (
    lcl_batch_id bigint, 
    lcl_message varchar) AS
$BODY$

begin

    if (in_arrival_date = '') then select null into in_arrival_date; end if;
    if (in_entry_completed_on = '') then select null into in_entry_completed_on; end if;

    if exists(select * from batch where batch_id = in_batch_id) then
        update batch set
        facility_id = in_facility_id , 
        arrival_date = cast (in_arrival_date as date),
        entry_completed = in_entry_completed,
        entry_completed_on = cast (in_entry_completed_on as date),
        refusals_with_r = in_refusals_with_r,
        refusals_without_r = in_refusals_without_r,
        refusals_without_g = in_refusals_without_g,
        unsigned_with_r = in_unsigned_with_r,
        unsigned_without_r = in_unsigned_without_r,
        orphans = in_orphans,
        not_approached = in_not_approached,
        disabled = in_disabled,
        language = in_language,
        comments = in_comments
            where batch_id = in_batch_id;
    else 
        insert into batch (
        facility_id,
        arrival_date,
        entry_completed,
        entry_completed_on,
        refusals_with_r,
        refusals_without_r,
        refusals_without_g,
        unsigned_with_r,
        unsigned_without_r,
        orphans,
        not_approached,
        disabled,
        language,
        comments
        )
        values (
        in_facility_id,
        cast (in_arrival_date as date) ,
        in_entry_completed,
        cast (in_entry_completed_on as date) ,
        in_refusals_with_r,
        in_refusals_without_r,
        in_refusals_without_g,
        in_unsigned_with_r,
        in_unsigned_without_r,
        in_orphans,
        in_not_approached,
        in_disabled,
        in_language,
        in_comments
        );
    end if;

    if (in_batch_id = -9) then
        select currval('batch_batch_id_seq') into lcl_batch_id;
        select 'Record Updated - New Batch ID - ' ||  lcl_batch_id into lcl_message;
    else
        select 'Record Updated' into lcl_message;
        lcl_batch_id = in_batch_id;
    end if;

    
    return query 
        select lcl_batch_id, lcl_message;
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_batch (integer,varchar,varchar,smallint,varchar,integer,integer,integer,integer,integer,integer,integer,integer,integer,varchar) to NHCR2_rc; 

