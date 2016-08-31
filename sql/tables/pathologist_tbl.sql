create table pathologist(
    pathologist_id varchar,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    pathologist_code varchar,
    salutation varchar,
    first_name varchar,
    middle_name varchar,
    last_name varchar,
    suffix varchar,
    degree varchar,
    comments varchar
)