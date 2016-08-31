create function get_surveillance(in in_colo_id integer)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and (
        ind_sur_phxcc = '1' or 
        ind_sur_phxplp = '1' or 
        ind_sur_phxplpcca= '1' or
        ind_sur_fhnpcc = '1' or 
        ind_scr_phxcca = '1' or 
        ind_sur_ibd = '1' or
        ibdtyp_uc = '1' or
        ibdtyp_crohn = '1' or
        ibdtyp_ind = '1')) then 
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql
