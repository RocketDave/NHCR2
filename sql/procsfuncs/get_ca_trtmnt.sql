create function get_ca_trtmnt(in in_colo_id bigint)
returns smallint as
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and
    (susp_ca_trt_cb=1 or susp_ca_trt_hb=1 or susp_ca_trt_hs=1 or susp_ca_trt_cs=1 or 
        susp_ca_trt_pme=1 or susp_ca_trt_pe=1 or susp_ca_trt_nr=1 or susp_ca_trt_lo=1 or susp_ca_trt_o=1 or susp_ca_trt_sn=1 or susp_ca_trt_te=1)) then
            return 1;
    else
            return 0;
    end if;
end;
$BODY$
language plpgsql
