create function public.get_find_calc_cancer(in in_colo_id bigint)
returns smallint AS
$BODY$
declare lcl_return smallint;
begin
    if exists (select * from colo where colo_id = in_colo_id and barcode = 'PathLink') then
        select 0 into lcl_return;
    elseif exists (select * from colo where susp_ca != 1 and susp_ca_loc = '99' and (susp_ca_siz = '99' or susp_ca_siz is null) and susp_ca_trt_cb != 1 and 
    susp_ca_trt_hb != 1 and susp_ca_trt_hs != 1 and susp_ca_trt_cs != 1 and susp_ca_trt_pme != 1 and susp_ca_trt_pe != 1 and 
    susp_ca_trt_nr != 1 and susp_ca_trt_lo != 1 and susp_ca_trt_o != 1 and 
    colo_id = in_colo_id) then
        select 0 into lcl_return;
    else
        select 1 into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql