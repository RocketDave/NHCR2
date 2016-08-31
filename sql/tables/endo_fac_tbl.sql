create table endo_fac (
    id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    facility_id character varying,
    endo_code integer,
    CONSTRAINT endo_fac_pkey PRIMARY KEY (id)
);

GRANT USAGE, SELECT ON SEQUENCE endo_fac_id_seq TO nhcr2_rc;
GRANT ALL ON TABLE endo_fac TO nhcr2_rc;