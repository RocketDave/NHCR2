create function public.get_find_calc_polyp(in in_colo_id bigint)
returns smallint AS
$BODY$
declare lcl_return smallint;
begin
    if exists (select * from colo where colo_id = in_colo_id and barcode = 'PathLink') then
        select 0 into lcl_return;
    elseif exists (select * from colo where fnd_plp = 0 and addl_polyp != '1' and all_plps_rem != '1' and 
        p_loc_a = '99' and p_loc_b = '99' and p_loc_c = '99' and p_loc_d = '99' and p_loc_e = '99' and p_loc_f = '99' and p_loc_g = '99' and
        p_siz_a = '99' and p_siz_b = '99' and p_siz_c = '99' and p_siz_d = '99' and p_siz_e = '99' and p_siz_f = '99' and p_siz_g = '99' and
        pt_cb_a = 0 and pt_hb_a = 0 and pt_hs_a = 0 and pt_cs_a= 0  and pt_pme_a= 0 and pt_pe_a= 0  and pt_nr_a= 0 and 
        pt_lo_a = 0 and pt_o_a= 0 and
        pt_cb_b = 0 and pt_hb_b = 0 and pt_hs_b = 0 and pt_cs_b= 0  and pt_pme_b= 0 and pt_pe_b= 0  and pt_nr_b= 0 and 
        pt_lo_b = 0 and pt_o_b= 0 and
        pt_cb_c = 0 and pt_hb_c = 0 and pt_hs_c = 0 and pt_cs_c= 0  and pt_pme_c= 0 and pt_pe_c= 0  and pt_nr_c= 0 and 
        pt_lo_c = 0 and pt_o_c= 0 and
        pt_cb_d = 0 and pt_hb_d = 0 and pt_hs_d = 0 and pt_cs_d= 0  and pt_pme_d= 0 and pt_pe_d= 0  and pt_nr_d= 0 and 
        pt_lo_d = 0 and pt_o_d= 0 and
        pt_cb_e = 0 and pt_hb_e = 0 and pt_hs_e = 0 and pt_cs_e= 0  and pt_pme_e= 0 and pt_pe_e= 0  and pt_nr_e= 0 and 
        pt_lo_e = 0 and pt_o_e= 0 and
        pt_cb_f = 0 and pt_hb_f = 0 and pt_hs_f = 0 and pt_cs_f= 0  and pt_pme_f= 0 and pt_pe_f= 0  and pt_nr_f= 0 and 
        pt_lo_f = 0 and pt_o_f= 0 and
        pt_cb_g = 0 and pt_hb_g = 0 and pt_hs_g = 0 and pt_cs_g= 0  and pt_pme_g= 0 and pt_pe_g= 0  and pt_nr_g= 0 and 
        pt_lo_g = 0 and pt_o_g= 0 and colo_id = in_colo_id) then
        select 0 into lcl_return;
    else
        select 1 into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql