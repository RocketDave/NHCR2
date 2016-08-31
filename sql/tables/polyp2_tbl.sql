create table polyp2 (
    polyp2_id serial not null,
    action_on timestamp without time zone,
    action_by character varying,
    record_comment character varying,
    inserted_on date DEFAULT ('now'::text)::date,
    inserted_by character varying,
    event_id integer,
    old_polyp_id character varying,
    p_loc character varying,
    p_siz character varying,
    pt_cb smallint,
    pt_hb smallint,
    pt_hs smallint,
    pt_cs smallint,
    pt_pme smallint,
    pt_pe smallint,
    pt_nr smallint,
    pt_lo smallint,
    pt_o smallint,
    pt_sn smallint,
    pt_te smallint,
    notes character varying,
    p_flat smallint,
    constraint polyp2_pkey primary key (polyp2_id)
);
alter table polyp2
    owner to informatics;
grant all on table specimen to informatics;