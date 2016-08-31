create  table scan_forms (
    id serial,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    create_date date,
    form_id character varying,
    short_name character varying,
    description character varying,
    import_script character varying,
    constraint scan_forms_pkey PRIMARY KEY (id)
);
ALTER TABLE scan_forms
    OWNER TO informatics;
GRANT ALL ON TABLE scan_forms TO informatics;