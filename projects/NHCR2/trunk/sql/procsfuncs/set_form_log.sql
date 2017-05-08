create or replace function set_form_log(
    in in_form_log_id integer,
    in in_facility_id varchar,
    in in_form_is_patient smallint,
    in in_start_barcode varchar,
    in in_end_barcode varchar,
    in in_num_forms integer,
    in in_ship_date varchar)
returns table (
    lcl_form_log_id integer, 
    lcl_message varchar) AS
$BODY$

begin

    if (in_ship_date = '') then select null into in_ship_date; end if;

    if exists(select * from form_log where form_log_id =  in_form_log_id) then
        update form_log set 
            facility_id = in_facility_id,
            form_is_patient = in_form_is_patient,
            start_barcode = in_start_barcode,
            end_barcode = in_end_barcode,
            num_forms = in_num_forms,
            ship_date = cast(in_ship_date as date)
            where form_log_id = in_form_log_id;
        else insert into form_log (
            facility_id,
            form_is_patient,
            start_barcode,
            end_barcode,
            num_forms,
            ship_date
        )
        values(
            in_facility_id,
            in_form_is_patient,
            in_start_barcode,
            in_end_barcode,
	    in_num_forms,
            cast(in_ship_date as date)
        );
    end if;

    select 'Record Updated' into lcl_message;

    if (in_form_log_id = -9) then
        select  currval('form_log_form_log_id_seq') into lcl_form_log_id;
    else
        lcl_form_log_id = in_form_log_id;
    end if;

    return query 
        select lcl_form_log_id, lcl_message;
end;
$BODY$
language plpgsql
