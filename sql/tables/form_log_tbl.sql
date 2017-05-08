create table public.form_log
(
    form_log_id serial,
    action_on timestamp without time zone default current_timestamp,
    action_by varchar default current_user,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar default current_user,
    facility_id varchar,
    form_is_patient smallint,
    start_barcode varchar,
    end_barcode varchar,
    num_forms integer,
    ship_date date,
    constraint form_log_pkey primary key (form_log_id)
);

alter table public.form_log
    owner TO informatics;
grant all on table public.form_log to nhcr2_rc, nhcr2_staff;
GRANT USAGE, SELECT ON SEQUENCE form_log_form_log_id_seq TO nhcr2_rc, nhcr2_staff;
