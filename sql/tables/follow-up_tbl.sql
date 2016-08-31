 create table follow_up (
    follow_up_id character varying,
    action_on timestamp without time zone not null,
    action_by character varying not null,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    fu_quality character varying,
    fu_plp_rem character varying,
    fu_plp_ltr character varying,
    fu_plp_ltr_info character varying,
    fu_colo_rec character varying,
    fu_pstcmp_gas character varying,
    fu_pstcmp_perf character varying,
    fu_pstcmp_react character varying,
    fu_pstcmp_bleed character varying,
    fu_pstcmp_oth character varying,
    fu_pstcmp_none character varying,
    fu_explain character varying,
    fu_feelgood character varying,
    fu_noworry character varying,
    fu_lschncdy character varying,
    fu_docrecfut character varying,
    fu_scrn character varying,
    fu_docrecscrn character varying,
    fu_embarss character varying,
    fu_toolong character varying,
    fu_pain character varying,
    fu_prep character varying,
    fu_nrvs character varying,
    fu_event_id bigint,
    fu_date date,
    fu_person_id bigint,
    fu_teleform_formid character varying,
    id_not_found smallint,
    teleform_batch_no bigint,
    constraint follow_up_pkey PRIMARY KEY (follow_up_id)
);
ALTER TABLE follow_up
    OWNER TO informatics;
GRANT ALL ON TABLE follow_up TO informatics;