create function import_polyp2()
returns void as 
$BODY$
begin

insert into polyp2 (
    polyp2_id,
    action_on,
    action_by,
    inserted_on,
    inserted_by,
    event_id,
    old_polyp_id,
    p_loc,
    p_siz,
    pt_cb,
    pt_hb,
    pt_hs,
    pt_cs,
    pt_pme,
    pt_pe,
    pt_nr,
    pt_lo,
    pt_o,
    pt_sn,
    pt_te,
    notes,
    p_flat)
select
    polyp_ii_key_id,
    mod_rec_date,
    mod_rec_user,
    new_rec_date,
    new_rec_user,
    visit_id,
    old_polyp_id,
    p_loc,
    p_siz,
    convert_true_false(pt_cb),
    convert_true_false(pt_hb),
    convert_true_false(pt_hs),
    convert_true_false(pt_cs),
    convert_true_false(pt_pme),
    convert_true_false(pt_pe),
    convert_true_false(pt_nr),
    convert_true_false(pt_lo),
    convert_true_false(pt_o),
    convert_true_false(pt_sn),
    convert_true_false(pt_te),
    notes,
    convert_true_false(p_flat)
from polyp2_import
order by polyp_ii_key_id;
end;
$BODY$
language plpgsql;