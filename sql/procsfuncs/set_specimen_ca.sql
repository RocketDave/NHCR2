﻿create or replace function set_specimen_ca(
in in_specimen_id integer,
in in_path_report_id integer,
in in_path_polyp_loc varchar,
in in_polyp_num varchar,
in in_discrepnote varchar,
in in_container varchar,
in in_other_dx_specify varchar,
in in_site_location_cm varchar,
in in_size_mm integer,
in in_ptype_carcinoid integer,
in in_ptype_ganglio integer,
in in_ptype_hamart integer,
in in_ptype_hp integer,
in in_ptype_inflam integer,
in in_ptype_juvenile integer,
in in_ptype_lelomyoma integer,
in in_ptype_lipoma integer,
in in_ptype_mp integer,
in in_ptype_norm_muc integer,
in in_ptype_not_polyp integer,
in in_ptype_other integer,
in in_ptype_pautzjeg integer,
in in_ptype_sa integer,
in in_ptype_ssp integer,
in in_ptype_mixed integer,
in in_ptype_ta integer,
in in_ptype_tva integer,
in in_ptype_va integer,
in in_hgd integer,
in in_ibd_ibd integer,
in in_ibd_actcol integer,
in in_ibd_chroncol integer,
in in_ibd_coloth integer,
in in_ibd_inactcol integer,
in in_ibd_lgdysp integer,
in in_n_inv_ca integer,
in in_n_cancer integer,
in in_ptype_fibroblast integer,
in in_ptype_lymphoid integer,
in in_t_class varchar,
in in_n_class varchar,
in in_y_prefix integer,
in in_record_complete integer,
in in_flg_size_discrep integer,
in in_aggregate_size integer,
in in_unspec_no_fragments integer)

returns table (
    lcl_specimen_id bigint, 
    lcl_message varchar) AS
$BODY$

begin


    if (in_site_location_cm = '') then select null into in_site_location_cm; end if;

    if exists(select * from specimen where specimen_id =  in_specimen_id) then
        update specimen set 
            path_report_id = in_path_report_id,
            path_polyp_loc = upper(in_path_polyp_loc),
            polyp_num = upper(in_polyp_num),
            discrepnote = in_discrepnote,
            container = upper(in_container),
            other_dx_specify = in_other_dx_specify,
            site_location_cm = cast(in_site_location_cm as integer),
            size_mm = in_size_mm,
            ptype_carcinoid = in_ptype_carcinoid,
            ptype_ganglio = in_ptype_ganglio,
            ptype_hamart = in_ptype_hamart,
            ptype_hp = in_ptype_hp,
            ptype_inflam = in_ptype_inflam,
            ptype_juvenile = in_ptype_juvenile,
            ptype_lelomyoma = in_ptype_lelomyoma,
            ptype_lipoma = in_ptype_lipoma,
            ptype_mp = in_ptype_mp,
            ptype_norm_muc = in_ptype_norm_muc,
            ptype_not_polyp = in_ptype_not_polyp,
            ptype_other = in_ptype_other,
            ptype_pautzjeg = in_ptype_pautzjeg,
            ptype_sa = in_ptype_sa,
            ptype_ssp = in_ptype_ssp,
            ptype_mixed = in_ptype_mixed,
            ptype_ta = in_ptype_ta,
            ptype_tva = in_ptype_tva,
            ptype_va = in_ptype_va,
            hgd = in_hgd,
            ibd_ibd = in_ibd_ibd,
            ibd_actcol = in_ibd_actcol,
            ibd_chroncol = in_ibd_chroncol,
            ibd_coloth = in_ibd_coloth,
            ibd_inactcol = in_ibd_inactcol,
            ibd_lgdysp = in_ibd_lgdysp,
            n_inv_ca = in_n_inv_ca,
            n_cancer = in_n_cancer,
            ptype_fibroblast = in_ptype_fibroblast,
            ptype_lymphoid = in_ptype_lymphoid,
            t_class = in_t_class,
            n_class = in_n_class,
            y_prefix = in_y_prefix,
            record_complete = in_record_complete,
            flg_size_discrep = in_flg_size_discrep,
            aggregate_size = in_aggregate_size,
            unspec_no_fragments = in_unspec_no_fragments
            where specimen_id = in_specimen_id;
        else insert into specimen (
            path_report_id,
            path_polyp_loc,
            polyp_num,
            discrepnote,
            container,
            other_dx_specify,
            site_location_cm,
            size_mm,
            ptype_carcinoid,
            ptype_ganglio,
            ptype_hamart,
            ptype_hp,
            ptype_inflam,
            ptype_juvenile,
            ptype_lelomyoma,
            ptype_lipoma,
            ptype_mp,
            ptype_norm_muc,
            ptype_not_polyp,
            ptype_other,
            ptype_pautzjeg,
            ptype_sa,
            ptype_ssp,
            ptype_mixed,
            ptype_ta,
            ptype_tva,
            ptype_va,
            hgd,
            ibd_ibd,
            ibd_actcol,
            ibd_chroncol,
            ibd_coloth,
            ibd_inactcol,
            ibd_lgdysp,
            n_inv_ca,
            n_cancer,
            ptype_fibroblast,
            ptype_lymphoid,
            t_class,
            n_class,
            y_prefix,
            record_complete,
            flg_size_discrep,
            aggregate_size,
            unspec_no_fragments,
            specimen_type
        )
        values (
            in_path_report_id,
            upper(in_path_polyp_loc),
            upper(in_polyp_num),
            in_discrepnote,
            upper(in_container),
            in_other_dx_specify,
            cast(in_site_location_cm as integer),
            in_size_mm,
            in_ptype_carcinoid,
            in_ptype_ganglio,
            in_ptype_hamart,
            in_ptype_hp,
            in_ptype_inflam,
            in_ptype_juvenile,
            in_ptype_lelomyoma,
            in_ptype_lipoma,
            in_ptype_mp,
            in_ptype_norm_muc,
            in_ptype_not_polyp,
            in_ptype_other,
            in_ptype_pautzjeg,
            in_ptype_sa,
            in_ptype_ssp,
            in_ptype_mixed,
            in_ptype_ta,
            in_ptype_tva,
            in_ptype_va,
            in_hgd,
            in_ibd_ibd,
            in_ibd_actcol,
            in_ibd_chroncol,
            in_ibd_coloth,
            in_ibd_inactcol,
            in_ibd_lgdysp,
            in_n_inv_ca,
            in_n_cancer,
            in_ptype_fibroblast,
            in_ptype_lymphoid,
            in_t_class,
            in_n_class,
            in_y_prefix,
            in_record_complete,
            in_flg_size_discrep,
            in_aggregate_size,
            in_unspec_no_fragments,
            'Suspected Cancer'
        );
    end if;

    select 'Record Updated' into lcl_message;

    if (in_specimen_id = -9) then
        select  currval('specimen_specimen_id_seq') into lcl_specimen_id;
    else
        lcl_specimen_id = in_specimen_id;
    end if;

    return query 
        select lcl_specimen_id, lcl_message;
end;
$BODY$
language plpgsql

