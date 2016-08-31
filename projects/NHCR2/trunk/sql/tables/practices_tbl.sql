create table practices (
    id serial,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    practice_id bigint,
    practice_name character varying,
    SCC_practice_num character varying(2),
    constraint practices_record_pkey PRIMARY KEY (id)
);
ALTER TABLE practices
    OWNER TO informatics;
GRANT ALL ON TABLE practices TO informatics;