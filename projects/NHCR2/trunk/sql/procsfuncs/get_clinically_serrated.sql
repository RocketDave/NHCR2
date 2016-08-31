create function get_clinically_serrated(in in_event_id bigint)
returns smallint AS
$BODY$
declare lcl_cssp integer;
begin

    if exists 
        (select * from vPolypSpecimen where c_event_id = in_event_id and 
            (
                ptype_ssp = 1 or 
                lower(other_dx_specify) like '%hp polyp with features of sa%' or 
                ptype_sa = 1 or
                ptype_mixed = 1 or
                ((ptype_hp = 1 or 
                    lower(other_dx_specify) like '%crypt hyperplasia%' or 
                    lower(other_dx_specify) like '%hyperplastic changes%' or 
                    lower(other_dx_specify) like '%hyperplastic glands%' or
                    lower(other_dx_specify) like '%hyperplastic mucosa%' or
                    lower(other_dx_specify) like '%hyperplastic-type polyp%' or
                    lower(other_dx_specify) like '%polypoid mucosa w/hp change%') and
                        (((p_siz = '3' or p_siz = '4') and p_loc != 'RE' and p_loc != 'SG' and p_loc != '99' and p_loc is not null) or
                             p_siz = '5'))
            )
        ) then
            lcl_cssp = 1;
    else
            lcl_cssp = 0;
    end if;

    return lcl_cssp;
end;
$BODY$
language plpgsql