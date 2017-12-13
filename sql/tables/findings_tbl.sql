-- Table: findings

-- DROP TABLE findings;

CREATE TABLE findings
(
  id serial NOT NULL,
  action_on timestamp without time zone,
  action_by character varying,
  record_comment character varying,
  inserted_on date DEFAULT ('now'::text)::date,
  inserted_by character varying,
  colo_id integer,
  event_id bigint,
  pr_event_id bigint,
  event_type character varying,
  path_report_complete integer,
  age_exam integer,
  exam_date date,
  endoscopist_id integer,
  facility_id character varying,
  facility_type character varying,
  gender_calcd character varying,
  end_proc_stat_rr character varying,
  prep character varying,
  adenoma_detected integer,
  clinically_serrated integer,
  proximal_serrated integer,
  screening integer,
  surveillance integer,
  diagnostic integer,
  eligible integer,
  indication_calculated character varying,
  ind_scr_nosym character varying,
  ind_scr_fhxcc character varying,
  ind_scr_fhxplp character varying,
  ind_sur_phxcc character varying,
  ind_sur_phxplp character varying,
  ind_sur_phxplpcca character varying,
  ind_sur_fhnpcc character varying,
  ind_scr_phxcca character varying,
  ind_sur_ibd character varying,
  ibdtyp_uc character varying,
  ibdtyp_crohn character varying,
  ibdtyp_ind character varying,
  ind_diag_exam character varying,
  dex_bleed character varying,
  dex_cbh_diar character varying,
  dex_cbh_cons character varying,
  dex_cbh_diarcons character varying,
  dex_elim_ibd character varying,
  dex_biop character varying,
  dex_fobt character varying,
  dex_abn_test character varying,
  dex_abn_tst_ctc character varying,
  dex_abn_tst_bar_en character varying,
  dex_abn_tst_oth character varying,
  dex_plpect_plp character varying,
  dex_ida character varying,
  dex_oth character varying,
  find_calc_normal integer,
  find_calc_polyp integer,
  find_calc_cancer integer,
  find_calc_other integer,
  find_calc_nodata integer,
  fnd_norm_ex integer,
  fnd_plp integer,
  find_other integer,
  find_oth_bmc integer,
  find_oth_ibd integer,
  find_oth_biop integer,
  find_oth_other integer,
  completed integer,
  abort_reas_pp character varying,
  abort_reas_obs character varying,
  abort_reas_sedprob character varying,
  abort_reas_tc character varying,
  abort_reas_oth character varying,
  wthdrwl_time character varying,
  adenoma_detected_old integer,
  serrated_detected_old integer,
  fup_10 character varying,
  fu_form_completed character varying,
  fup_gt10 character varying,
  CONSTRAINT findings_id_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE findings
  OWNER TO informatics;
GRANT ALL ON TABLE findings TO informatics;
GRANT ALL ON TABLE findings TO nhcr2_rc;

-- Index: findings_colo_id_index

-- DROP INDEX findings_colo_id_index;

CREATE INDEX findings_colo_id_index
  ON findings
  USING btree
  (colo_id);

-- Index: findings_event_id_index

-- DROP INDEX findings_event_id_index;

CREATE INDEX findings_event_id_index
  ON findings
  USING btree
  (event_id);

