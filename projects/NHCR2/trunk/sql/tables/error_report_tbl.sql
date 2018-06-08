create table public.error_report (
    error_report_id serial not null,
    action_on timestamp without time zone,
    action_by varchar DEFAULT "current_user"(),
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar DEFAULT "current_user"(),
    report_name varchar,
    report_sql varchar,
    report_form varchar,
    report_form_key varchar,
    constraint error_report_pkey PRIMARY KEY (error_report_id)
);
grant select on public.error_report to nhcr2_rc;