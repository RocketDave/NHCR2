create function get_adenoma_detected(in in_event_id bigint)
returns smallint aS
$BODY$
declare lcl_adenoma integer;
        lcl_dex_biop integer;
        lcl_fnd_plp integer;
        lcl_susp_ca integer;
begin

    select 
        dex_biop,
        fnd_plp,
        susp_ca
    into
        lcl_dex_biop,
        lcl_fnd_plp,
        lcl_susp_ca
    from colo where event_id = in_event_id;

    lcl_adenoma = 0;

    if (lcl_dex_biop = 1 or lcl_fnd_plp = 1 or lcl_susp_ca = 1) then -- biopsy, polyp or suspected cancer
        if exists (select * from vpolypSpecimen where c_event_id = in_event_id and
            (ptype_ta = 1 or
            ptype_tva = 1 or
            ptype_va = 1 or
            (hgd = 1 and (lcl_fnd_plp = 1 or lcl_susp_ca = 1)) or
            n_cancer = 1 or
            n_intra_ca = 1 or
            n_inv_ca = 1 or
            lower(other_dx_specify) like 'tubulovillous dysplastic epithelium' or 
            lower(other_dx_specify) like 'adenomatous changes' or 
            lower(other_dx_specify) like 'adenomatous epithelium')) then
                lcl_adenoma = 1;
        else
            lcl_adenoma = 0;
        end if;
    end if;

    return lcl_adenoma;
end;
$BODY$
language plpgsql