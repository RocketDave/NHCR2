create table patient (
    id serial,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    patient_id bigint,
    birth_date date,
    sex_male boolean,
    sex_female boolean,
    refused boolean,
    refused_date date,
    zip character varying,
    death_date date,
    ever_cancer boolean,
    create_datetime timestamp without time zone,
    update_date date,
    util_bool boolean,
    dead boolean,
    constraint patient_pkey PRIMARY KEY (id)
);
ALTER TABLE patient
    OWNER TO informatics;
GRANT ALL ON TABLE patient TO informatics;