create table batch (
    batch_id serial,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    facility_id varchar,
    arrival_date date,
    comments varchar,
    path_link smallint,
    entry_completed smallint,
    entry_completed_on date
    refusals_with_r integer,
    refusals_without_r integer,
    unsigned_with_r integer,
    unsigned_without_r integer,
    orphans integer
    constraint batch_id_pkey PRIMARY KEY (batch_id)
);
ALTER TABLE batch
    OWNER TO informatics;
GRANT ALL ON TABLE batch TO nhcr2_rc;