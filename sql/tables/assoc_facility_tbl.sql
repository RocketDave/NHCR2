create table assoc_facility (
    id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    parent_facility_id character varying(10),
    assoc_fac_id character varying(10),
    assoc_facility_name character varying(100),
    notes smallint,
    CONSTRAINT assoc_facility_pkey PRIMARY KEY (id)
);

GRANT USAGE, SELECT ON SEQUENCE assoc_facility_id_seq TO nhcr2_rc;
GRANT ALL ON TABLE assoc_facility TO nhcr2_rc;