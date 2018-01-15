create or replace function public.import_scanned_surv_data(
    in in_today varchar,
    in in_file_name varchar,
    in in_dups integer
)
returns void as 
$BODY$
    declare lcl_recs_loaded integer;
    declare lcl_no_barcode integer;
    declare lcl_survey_records integer;
    declare lcl_event_id integer;
begin

    update import_scanned_surv_data i set event_id = e.event_id from event e where barcode = patient_barcode and i.inserted_on = cast (in_today as date);
    update survey s set event_id = e.event_id from event e where barcode = patient_barcode and s.inserted_on = cast (in_today as date);
    update survey set coumadin = 0 where coumadin = 9 and inserted_on = current_date;
    select count(*) into lcl_survey_records from survey s join import_scanned_surv_data i on s.barcode = i.barcode where s.inserted_on = cast (in_today as date) and i.barcode is not null;
    select count(*) into lcl_recs_loaded from import_scanned_surv_data where inserted_on = cast (in_today as date);
    select count(*) into lcl_no_barcode from import_scanned_surv_data where inserted_on = cast(in_today as date) and event_id is null;

    insert into upload (records_loaded,file_name,duplicates,survey_records,no_barcode) values (lcl_recs_loaded,in_file_name,in_dups,lcl_survey_records,lcl_no_barcode);

    --delete from import_scanned_surv_data;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.import_scanned_surv_data(varchar,varchar,integer) to NHCR2_rc; 


