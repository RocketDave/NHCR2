create table path_request (
    path_request_id serial,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    event_id bigint,
    print_date date,
    recvd_date date,
    n_a_reason character varying,
    notes character varying,
    med_rec_num character varying(24),
    no_path_report smallint,
    path_report_id bigint,
    temp_last_name character varying,
    temp_dob character varying,
    temp_endo_info character varying,
    fac_requires_request smallint,
    constraint path_request_pkey PRIMARY KEY (path_request_id)
);
ALTER TABLE path_request
    OWNER TO informatics;
GRANT ALL ON TABLE path_request TO nhcr2_rc;