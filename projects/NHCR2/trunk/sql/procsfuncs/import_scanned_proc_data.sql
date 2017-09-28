create or replace function public.import_scanned_proc_data(
    in in_today varchar,
    in in_file_name varchar,
    in in_dups integer
)
returns void as 
$BODY$
    declare lcl_recs_loaded integer;
    declare lcl_no_barcode integer;
    declare lcl_colo_records integer;
    declare lcl_polyp2_records integer;
    declare lcl_event_id integer;
    declare cur1 cursor for select event_id  from import_scanned_proc_data where to_char(action_on,'yyyy-mm-dd') = in_today and barcode is not null;
begin

    update import_scanned_proc_data set event_id = event.event_id from event where barcode = endo_barcode and to_char(import_scanned_proc_data.action_on,'yyyy-mm-dd') = in_today;
    update colo c set event_id = i.event_id from import_scanned_proc_data i where c.barcode = i.barcode and to_char(i.action_on,'yyyy-mm-dd') = in_today;
    select count(*) into lcl_colo_records from colo where to_char(inserted_on,'yyyy-mm-dd') = in_today;
    select count(*) into lcl_polyp2_records from polyp2 where to_char(inserted_on,'yyyy-mm-dd') = in_today;
    select count(*) into lcl_recs_loaded from import_scanned_proc_data where to_char(action_on,'yyyy-mm-dd') = in_today;
    select count(*) into lcl_no_barcode from import_scanned_proc_data where to_char(action_on,'yyyy-mm-dd') = in_today and event_id is null;

    open cur1;
    loop
    -- fetch row into the film
      fetch cur1 into lcl_event_id;
    -- exit when no more row to fetch
      exit when not found;
      perform colopolypnormalize(lcl_event_id);
   end loop;

    insert into upload (records_loaded,file_name,duplicates,colo_records,polyp2_records,no_barcode) values (lcl_recs_loaded,in_file_name,in_dups,lcl_colo_records,lcl_polyp2_records,lcl_no_barcode);

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.import_scanned_proc_data(varchar,varchar,integer) to NHCR2_rc; 