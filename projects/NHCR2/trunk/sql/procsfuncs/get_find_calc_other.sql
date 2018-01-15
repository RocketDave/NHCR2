create function public.get_find_calc_other(in in_colo_id bigint)
returns smallint AS
$BODY$
declare lcl_return smallint;
begin
    if exists (select * from colo where colo_id = in_colo_id and barcode = 'PathLink') then
        select 0 into lcl_return;
    elseif exists (select * from colo where susp_crohns != '1' and susp_UC != '1' and su_cr_loc_ti = 0 and
        su_cr_loc_ce  = 0 and su_cr_loc_ac  = 0 and su_cr_loc_hf  = 0 and su_cr_loc_tc  = 0 and 
        su_cr_loc_sf  = 0 and su_cr_loc_dc  = 0 and su_cr_loc_sg  = 0 and su_cr_loc_re  = 0 and
        su_cr_loc_u  = 0 and su_uc_loc_ti  = 0 and su_uc_loc_ce  = 0 and su_uc_loc_ac  = 0 and 
        su_uc_loc_hf  = 0 and su_uc_loc_tc  = 0 and su_uc_loc_sf  = 0 and su_uc_loc_dc  = 0 and 
        su_uc_loc_sg  = 0 and su_uc_loc_re  = 0 and su_uc_loc_u  = 0 and find_other != 1 and
        find_oth_bmc = 0 and find_oth_ibd = 0 and find_oth_biop = 0 and find_oth_other = 0 and
        colo_id = in_colo_id) then
        select 0 into lcl_return;
    else
        select 1 into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql