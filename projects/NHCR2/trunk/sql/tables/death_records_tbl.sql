create table death_records (
    id serial,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    patient_id bigint,
    dob date,
    death_date date,
    last_fu date,
    ICD_rev character varying,
    cause_of_death character varying,
    underlying_BC character varying,
    source character varying,
    icd_code character varying,
    util_bool boolean,
    constraint death_record_pkey PRIMARY KEY (id)
);
ALTER TABLE death_records
    OWNER TO informatics;
GRANT ALL ON TABLE death_records TO informatics;
