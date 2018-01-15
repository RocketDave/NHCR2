create function public.get_normal_exam(in in_colo_id bigint)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and
        p_loc_a = '99' and
        p_loc_b = '99' and
        p_loc_c = '99' and
        p_loc_d = '99' and
        p_loc_e = '99' and
        p_loc_f = '99' and
        p_loc_g = '99') then 
        return 1;
    else
        return 0;
    end if;
end;
$BODY$
language plpgsql