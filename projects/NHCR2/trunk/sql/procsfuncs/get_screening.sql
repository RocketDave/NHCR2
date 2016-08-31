create function get_screening(in in_colo_id integer)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and (
        ind_scr_nosym = '1' or 
        ind_scr_fhxcc = '1' or 
        ind_scr_fhxplp = '1' or 
        ind_scr_fhxcc_fdr = '1')) then 
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql
