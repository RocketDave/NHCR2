create table path_lab (
    path_lab_id serial,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    lab_name varchar,
    lab_code varchar unique not null,
    contact1_name varchar,
    contact1_phone varchar,
    contact1_email varchar,
    contact1_type varchar,
    contact2_name varchar,
    contact2_phone varchar,
    contact2_email varchar,
    contact2_type varchar,
    address1 varchar,
    address2 varchar,
    address3 varchar,
    city varchar,
    state varchar(2),
    zip varchar,
    fax varchar,
    request_procedure varchar,
    status varchar,
    status_date date,
    path_report_trigger varchar,
    comments varchar,
    constraint path_lab_pkey primary key (path_lab_id)
);

alter table path_lab
    owner TO informatics;
grant all on table path_lab to nhcr2_rc, nhcr2_staff;
GRANT USAGE, SELECT ON SEQUENCE path_lab_path_lab_id_seq TO nhcr2_rc, nhcr2_staff;