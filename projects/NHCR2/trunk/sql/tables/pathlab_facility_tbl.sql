create table pathlab_facility (
    pathlab_facility_id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    facility_id character varying(10),
    lab_code character varying(25)
);

GRANT ALL ON TABLE pathlab_facility TO nhcr2_rc;