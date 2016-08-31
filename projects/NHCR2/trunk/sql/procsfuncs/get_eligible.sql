create function get_eligible(in in_colo_id integer)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and 
        (end_proc_stat_rr = '1' or end_proc_stat_rr = '2' or  end_proc_stat_rr = '10') and get_diagnostic(in_colo_id) = 0 and ind_sur_fhnpcc != '1' and ind_sur_ibd != '1' and
            ibdtyp_uc != '1' and ibdtyp_crohn != '1'  and ibdtyp_ind != '1' and (prep = '1' or prep = '2' or prep = '3') and indication_calculated != 'No indication'
        ) then 
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql