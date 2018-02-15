create function set_calculated_variables2 (in in_colo_id bigint)
returns void as 
$BODY$

begin

    update colo set find_calc_polyp = get_find_calc_polyp (in_colo_id) where colo_id = in_colo_id;
    update colo set find_calc_cancer = get_find_calc_cancer (in_colo_id) where colo_id = in_colo_id;
    update colo set find_calc_other = get_find_calc_other (in_colo_id) where colo_id = in_colo_id;
    update colo set find_calc_normal = get_find_calc_normal (in_colo_id) where colo_id = in_colo_id;
    update colo set fu_form_completed = get_fu_form_completed (in_colo_id) where colo_id = in_colo_id;

end;
$BODY$
language plpgsql