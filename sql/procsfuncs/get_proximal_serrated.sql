create function get_proximal_serrated(in in_event_id bigint)
returns smallint AS
$BODY$
declare lcl_pssp integer;
begin

    if exists (select * from vPolypSpecimen where c_event_id = in_event_id and p_loc != 'RE' and p_loc != 'SG' and p_loc != '99' and p_loc is not null and (
        ptype_ssp = 1 or
        ptype_sa = 1 or
        ptype_mixed = 1 or
        ptype_hp = 1 or
        lower(other_dx_specify) like '%hp polyp with features of sa%' or 
        lower(other_dx_specify) like '%crypt hyperplasia%' or 
        lower(other_dx_specify) like '%focal serration%' or 
        lower(other_dx_specify) like '%hyperplastic changes%' or 
        lower(other_dx_specify) like '%hyperplastic glands%' or
        lower(other_dx_specify) like '%hyperplastic mucosa%' or
        lower(other_dx_specify) like '%hyperplastic-type polyp%' or
        lower(other_dx_specify) like '%polypoid mucosa w/hp change%')
        ) then
            lcl_pssp = 1;
    else
            lcl_pssp = 0;
    end if;

    return lcl_pssp;
end;
$BODY$
language plpgsql