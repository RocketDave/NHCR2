create table irb_dates(
    facility_id character varying,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    approval_date date,
    expiration_date date,
    constraint irb_facility_pkey PRIMARY KEY (facility_id)
);
grant all on irb_dates to NHCR2_rc;