create function get_eligible(in in_colo_id integer)
returns smallint AS
$BODY$
begin

    if exists (select * from findings where colo_id = in_colo_id 
        and completed = '1'  
        and indication_calculated != 'Diagnostic' 
        and indication_calculated != 'No indication'
        and ind_sur_fhnpcc != '1' and ind_sur_ibd != '1' and
            ibdtyp_uc != '1' and ibdtyp_crohn != '1'  and ibdtyp_ind != '1' and (prep = '1' or prep = '2' or prep = '3')
        ) then 
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql