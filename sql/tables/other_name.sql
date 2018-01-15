create table other_name (
    other_name_id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    person_id integer,
    last_name character varying,
    maiden_flag smallint,
    constraint other_name_id_pkey PRIMARY KEY (other_name_id)
);
alter table other_name
    owner TO informatics;
grant all on table other_name to nhcr2_rc;
   