create function public.get_find_calc_normal(in in_colo_id bigint)
returns smallint AS
$BODY$
declare lcl_return smallint;
begin
    if exists (select * from colo where colo_id = in_colo_id and barcode = 'PathLink') then
        select 0 into lcl_return;
    elseif exists (select * from colo where find_calc_polyp = 0 and find_calc_cancer = 0 and find_calc_other = 0 and
    colo_id = in_colo_id) then
        select 1 into lcl_return;
    else
        select 0 into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql