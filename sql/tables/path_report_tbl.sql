create table path_report ( 
    path_report_id serial not null,
    action_on timestamp without time zone,
    action_by varchar,
    record_comment varchar,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by varchar,
    event_id bigint,
    path_report_complete smallint,
    person_id bigint,
    date_of_birth date,
    gender smallint,
    case_no varchar,
    procedure_type varchar,
    consult smallint,
    consult_date date,
    endoscopist_id integer,
    amended_path_report smallint,
    pathologist_code_cprs varchar,
    pathology_date date,
    lab_code varchar,
    no_Q_form smallint,
    Q_form_incomplete smallint,
    apc smallint,
    SAS_import_notes varchar,
    pseudo_patient_id varchar,
    source varchar,
    study_site varchar,
    rec_type varchar,
    Notes varchar,
    sas_key_id bigint,
    pth_req_id bigint,
    adenoma_detected smallint,
    ad_det_manual smallint,
    px_gender_male smallint,
    px_gender_female smallint,
    serrated_detected smallint,
    serr_det_manual smallint,
    gender_calcd varchar,
    crohns_only smallint,
    u_colitis_only smallint,
    date_discrepancy smallint
    constraint path_pkey PRIMARY KEY (path_report_id)
);
ALTER TABLE colo
    OWNER TO informatics;
GRANT ALL ON TABLE path_report TO informatics;

-- Index: path_report_event_id_index

-- DROP INDEX path_report_event_id_index;

CREATE INDEX path_report_event_id_index
  ON path_report
  USING btree
  (event_id);
