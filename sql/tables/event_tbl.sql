﻿create table event (
    event_id serial not null,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    person_id integer,
    event_type varchar,
    event_date date,
    event_desc varchar,
    comments text,
    batch_id integer,
    second_batch integer,
    patient_barcode varchar,
    endo_barcode varchar,
    ref_phys_last varchar,
    ref_phys_first varchar,
    medical_record_number varchar,
    endo_code integer,
    est_exam_date smallint,
    chase_trace smallint,
    patient_form_double_entered smallint,
    signature_present smallint,
    not_approached smallint,
    disabled smallint,
    report_group_code varchar,
    endo_form_double_entered smallint,
    constraint event_id_pkey PRIMARY KEY (event_id)
)

-- Index: event_person_id_index

-- DROP INDEX event_person_id_index;

CREATE INDEX event_person_id_index
  ON event
  USING btree
  (person_id);