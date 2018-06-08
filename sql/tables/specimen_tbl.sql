create table specimen(
    specimen_id serial not null,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    path_report_id bigint not null,
    path_polyp_loc character varying,
    polyp_num character varying,
    discrepnote character varying,
    container character varying,
    fragment character varying,
    other_dx_specify character varying,
    site_location_cm bigint,
    site_desc character varying,
    size_mm bigint,
    flg_no_path_spec smallint,
    Ptype_Carcinoid smallint,
    Ptype_Ganglio smallint,
    Ptype_Hamart smallint,
    Ptype_HP smallint,
    Ptype_Inflam smallint,
    Ptype_Juvenile smallint,
    Ptype_Lelomyoma smallint,
    Ptype_Lipoma smallint,
    Ptype_MP smallint,
    Ptype_Norm_Muc smallint,
    Ptype_Not_Polyp smallint,
    Ptype_Other smallint,
    Ptype_Pautzjeg smallint,
    Ptype_SA smallint,
    Ptype_SSP smallint,
    Ptype_Mixed smallint,
    Ptype_TA smallint,
    Ptype_TVA smallint,
    Ptype_VA smallint,
    flg_dx smallint,
    flg_no_discrep smallint,
    flg_no_Q_spec smallint,
    flg_num_polyps smallint,
    flg_site_discrep smallint,
    flg_site_uncert smallint,
    flg_path_sites smallint,
    flg_review smallint,
    HGD smallint,
    ibd_ibd smallint,
    ibd_actcol smallint,
    ibd_chroncol smallint,
    ibd_coloth smallint,
    ibd_inactcol smallint,
    ibd_lgdysp smallint,
    n_intra_ca smallint,
    n_inv_ca smallint,
    n_cancer smallint,
    Ptype_Fibroblast smallint,
    Ptype_Lymphoid smallint,
    flg_assump smallint,
    flg_multis smallint,
    flg_multisites smallint,
    flg_residual smallint,
    flg_assump_numpolyps smallint,
    flg_dx_size smallint,
    flg_dx_site smallint,
    flg_dx_multis smallint,
    specimen_type character varying,
    T_Class character varying,
    N_Class character varying,
    y_prefix smallint,
    record_complete smallint,
    flg_size_discrep smallint,
    SAS_key_id bigint,
    aggregate_size smallint,
    unspec_no_fragments smallint,
    flat_polyp smallint,
    constraint specimen_id_pkey primary key (specimen_id),
    CONSTRAINT specimen_path_fk FOREIGN KEY (path_report_id)
        REFERENCES public.path_report (path_report_id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
);
alter table specimen
    owner TO informatics;
grant all on table specimen to informatics;
grant select on table specimen to NHCR2_data;
-- Index: specimen_path_id_index

-- DROP INDEX specimen_path_id_index;

CREATE INDEX specimen_path_id_index
  ON specimen
  USING btree
  (path_id);