create table path_search (
    path_search_id serial not null,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    person_id integer, 
    refused integer,
    event_id integer, 
    last_name character varying, 
    first_name character varying, 
    middle_name character varying, 
    dob date,
    constraint path_search_id_pkey PRIMARY KEY (path_search_id)
);
ALTER TABLE path_search
    OWNER TO informatics;
GRANT ALL ON TABLE path_search TO nhcr2_rc;
