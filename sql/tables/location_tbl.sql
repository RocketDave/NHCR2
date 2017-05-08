create table public.location (
    location_id serial,
    action_on timestamp without time zone default current_timestamp,
    action_by varchar default current_user,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar DEFAULT current_user,
    location_text varchar,
    
    constraint location_id_pkey PRIMARY KEY (location_id)
);
ALTER TABLE location
    OWNER TO informatics;
GRANT ALL ON TABLE location TO nhcr2_rc;