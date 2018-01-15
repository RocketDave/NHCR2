create function get_plp_trtmnt(in in_colo_id bigint)
returns smallint as
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and
   (pt_cb_a=1 or pt_hb_a=1 or pt_hs_a=1 or pt_cs_a=1 or pt_pme_a=1 or pt_pe_a=1 or pt_nr_a=1 or pt_lo_a=1 or pt_o_a=1 or pt_sn_a=1 or pt_te_a=1 or
    pt_cb_b=1 or pt_hb_b=1 or pt_hs_b=1 or pt_cs_b=1 or pt_pme_b=1 or pt_pe_b=1 or pt_nr_b=1 or pt_lo_b=1 or pt_o_b=1 or pt_sn_b=1 or pt_te_b=1 or
    pt_cb_c=1 or pt_hb_c=1 or pt_hs_c=1 or pt_cs_c=1 or pt_pme_c=1 or pt_pe_c=1 or pt_nr_c=1 or pt_lo_c=1 or pt_o_c=1 or pt_sn_c=1 or pt_te_c=1 or
    pt_cb_d=1 or pt_hb_d=1 or pt_hs_d=1 or pt_cs_d=1 or pt_pme_d=1 or pt_pe_d=1 or pt_nr_d=1 or pt_lo_d=1 or pt_o_d=1 or pt_sn_d=1 or pt_te_d=1 or
    pt_cb_e=1 or pt_hb_e=1 or pt_hs_e=1 or pt_cs_e=1 or pt_pme_e=1 or pt_pe_e=1 or pt_nr_e=1 or pt_lo_e=1 or pt_o_e=1 or pt_sn_e=1 or pt_te_e=1 or
    pt_cb_f=1 or pt_hb_f=1 or pt_hs_f=1 or pt_cs_f=1 or pt_pme_f=1 or pt_pe_f=1 or pt_nr_f=1 or pt_lo_f=1 or pt_o_f=1 or pt_sn_f=1 or pt_te_f=1 or
    pt_cb_g=1 or pt_hb_g=1 or pt_hs_g=1 or pt_cs_g=1 or pt_pme_g=1 or pt_pe_g=1 or pt_nr_g=1 or pt_lo_g=1 or pt_o_g=1 or pt_sn_g=1 or pt_te_g=1 )) then
            return 1;
    else
            return 0;
    end if;
end;
$BODY$
language plpgsql
