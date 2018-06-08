create table dup_events (
    event_id serial not null,
    person_id integer,
    event_date date,
    patient_barcode varchar,
    endo_barcode varchar,
    event_id2 serial not null,
    person_id2 integer,
    event_date2 date,
    patient_barcode2 varchar,
    endo_barcode2 varchar)
)
