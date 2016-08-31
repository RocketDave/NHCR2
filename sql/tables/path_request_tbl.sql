create table path_request (
    id serial,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    request_id bigint,
    colo_visit_id bigint,
    print_date date,
    recvd_date date,
    n_a_reason character varying,
    notes character varying,
    new_rec_date date,
    new_rec_timestamp timestamp,
    new_rec_user character varying,
    mod_rec_date date,
    mod_rec_timestamp timestamp,
    mod_rec_user character varying,
    med_rec_num character varying,
    no_path_report boolean,
    path_report_id bigint,
    temp_last_name character varying,
    temp_dob character varying,
    temp_endo_info character varying,
    fac_requires_request boolean,
    constraint path_request_pkey PRIMARY KEY (id)
);
ALTER TABLE path_request
    OWNER TO informatics;
GRANT ALL ON TABLE path_request TO informatics;