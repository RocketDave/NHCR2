create table pathlab_pathologist (
    id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    pathlab_code character varying(10),
    pathologist_code character varying(10),
    CONSTRAINT pathlab_pathologist_pkey PRIMARY KEY (id)
);

GRANT USAGE, SELECT ON SEQUENCE pathlab_pathologist_id_seq TO nhcr2_rc;
GRANT ALL ON TABLE pathlab_pathologist TO nhcr2_rc;