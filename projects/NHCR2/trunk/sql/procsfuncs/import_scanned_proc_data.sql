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
    declare cur1 cursor for select event_id  from import_scanned_proc_data where to_char(inserted_on,'yyyy-mm-dd') = in_today and barcode is not null;
begin

    update import_scanned_proc_data i set event_id = event.event_id from event where upper(barcode) = upper(endo_barcode) and i.inserted_on = cast (in_today as date);
    update colo c set event_id = cast(i.event_id as integer) from import_scanned_proc_data i where upper(c.barcode) = upper(i.barcode) and c.inserted_on = cast (in_today as date);
    update colo set indication_calculated = get_indication (colo_id) where inserted_on = cast (in_today as date);

    open cur1;
    loop
    -- fetch row into the film
      fetch cur1 into lcl_event_id;
    -- exit when no more row to fetch
      exit when not found;
      perform colopolypnormalize(lcl_event_id);
   end loop;

    perform convert_sizes(in_today);

    perform set_calculated_variables(colo_id) from colo where to_char(inserted_on,'yyyy-mm-dd') = in_today;
    perform set_calculated_variables2(colo_id) from colo where to_char(inserted_on,'yyyy-mm-dd') = in_today;

    select count(*) into lcl_colo_records from colo c join import_scanned_proc_data i on upper(c.barcode) = upper(i.barcode) where to_char(c.inserted_on,'yyyy-mm-dd') = in_today and i.barcode is not null;
    select count(*) into lcl_polyp2_records from polyp2 p join import_scanned_proc_data i on p.event_id = cast(i.event_id as integer) where to_char(p.inserted_on,'yyyy-mm-dd') = in_today and i.event_id is not null;
    select count(*) into lcl_recs_loaded from import_scanned_proc_data where inserted_on =  cast (in_today as date);
    select count(*) into lcl_no_barcode from import_scanned_proc_data where inserted_on = cast (in_today as date) and event_id is null;
    insert into upload (records_loaded,file_name,duplicates,colo_records,polyp2_records,no_barcode) values (lcl_recs_loaded,in_file_name,in_dups,lcl_colo_records,lcl_polyp2_records,lcl_no_barcode);

    --delete from import_scanned_proc_data;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.import_scanned_proc_data(varchar,varchar,integer) to NHCR2_rc; 