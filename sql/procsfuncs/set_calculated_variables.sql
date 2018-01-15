create function set_calculated_variables (in in_colo_id bigint)
returns void as 
$BODY$
    declare lcl_ca_loc integer;
    declare lcl_ca_siz integer;
    declare lcl_ca_tx integer;

begin

    update colo set computed_normal_exam = get_normal_exam (in_colo_id) where colo_id = in_colo_id;
    update colo set computed_plp_trtmnt = get_plp_trtmnt (in_colo_id) where colo_id = in_colo_id;
    update colo set computed_fnd_siz = get_find_siz (in_colo_id) where colo_id = in_colo_id;

    select susp_ca_loc into lcl_ca_loc from colo where colo_id = in_colo_id;
    if (lcl_ca_loc < 99) then
        update colo set computed_susp_ca_loc = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_ca_loc = 0 where colo_id = in_colo_id;
    end if;

    select susp_ca_siz into lcl_ca_siz from colo where colo_id = in_colo_id;
    if (lcl_ca_siz < 99 and lcl_ca_siz > 0 ) then
        update colo set computed_susp_ca_siz = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_ca_siz = 0 where colo_id = in_colo_id;
    end if;

    select susp_ca_siz into lcl_ca_siz from colo where colo_id = in_colo_id;
    if (lcl_ca_siz < 99 and lcl_ca_siz > 0 ) then
        update colo set computed_susp_ca_siz = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_ca_siz = 0 where colo_id = in_colo_id;
    end if;

    update colo set computed_susp_ca_trtmnt = get_ca_trtmnt (in_colo_id) where colo_id = in_colo_id;

    if exists (select * from colo where colo_id = in_colo_id and susp_crohns = '1' ) then
        update colo set computed_susp_crohn = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_crohn = 0 where colo_id = in_colo_id;
    end if;

    if exists (select * from colo where colo_id = in_colo_id and 
        ((find_other = 1) or (find_oth_bmc = 1) or (find_oth_biop = 1) or (find_oth_ibd = 1) or (find_oth_other = 1))) then
        update colo set computed_susp_other = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_other = 0 where colo_id = in_colo_id;
    end if;

    if exists (select * from colo where colo_id = in_colo_id and susp_UC = '1' ) then
        update colo set computed_susp_uc = 1 where colo_id = in_colo_id;
    else
        update colo set computed_susp_uc = 0 where colo_id = in_colo_id;
    end if;
end;
$BODY$
language plpgsql