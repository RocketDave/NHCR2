create table associate_facility (
    associate_facility_id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    parent_facility_id character varying(10),
    assoc_fac_id character varying(10),
    assoc_facility_name character varying(46),
    notes smallint
)