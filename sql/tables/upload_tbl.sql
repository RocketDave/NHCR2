create table upload (
    upload_id serial not null,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar default current_user,
    import_form varchar,
    file_name varchar,
    records_loaded integer,
    duplicates integer,
    colo_records integer,
    polyp2_records integer,
    survey_records integer,
    no_barcode integer,
    constraint upload_id_pkey PRIMARY KEY (upload_id)
);
alter table public.upload
    owner TO informatics;
grant all on table public.upload to nhcr2_rc, nhcr2_staff;
GRANT USAGE, SELECT ON SEQUENCE upload_upload_id_seq TO nhcr2_rc, nhcr2_staff;