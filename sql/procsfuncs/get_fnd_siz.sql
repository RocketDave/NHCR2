create function public.get_find_siz(in in_colo_id bigint)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and
        ((p_siz_a = '99' and p_siz_b = '99' and p_siz_c = '99' and p_siz_d = '99' and p_siz_e = '99' and 
        p_siz_f = '99' and p_siz_g = '99') or p_siz_a is null)) then
        return 0;
    else
        return 1;
    end if;
end;
$BODY$
language plpgsql