create table public.pathologist(
    pathologist_id serial,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    pathologist_code varchar unique not null,
    salutation varchar,
    first_name varchar,
    middle_name varchar,
    last_name varchar,
    suffix varchar,
    degree varchar,
    comments varchar,
    constraint pathologist_id_pkey PRIMARY KEY (pathologist_id)
);
ALTER TABLE public.pathologist
    OWNER TO informatics;
GRANT ALL ON TABLE pathologist TO nhcr2_rc, nhcr2_staff;
GRANT USAGE, SELECT ON SEQUENCE pathologist_pathologist_id_seq TO nhcr2_rc, nhcr2_staff;