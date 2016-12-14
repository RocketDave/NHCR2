create table person_addr (
    person_addr_id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    person_id integer,
    address1 character varying,
    address2 character varying,
    city character varying,
    state character varying,
    zip character varying,
    address_date date,
    constraint person_addr_pkey PRIMARY KEY (person_addr_id)
);
ALTER TABLE person_addr
    OWNER TO informatics;
GRANT ALL ON TABLE person_addr TO informatics;