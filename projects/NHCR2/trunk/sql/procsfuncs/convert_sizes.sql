create function public.convert_sizes (in in_today varchar)
    returns void as 
$BODY$
begin
    update colo set p_siz_a = '1' where p_siz_a = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_a = '2' where p_siz_a = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_a = '3' where p_siz_a = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_a = '4' where p_siz_a = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_a = '5' where p_siz_a = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_b = '1' where p_siz_b = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_b = '2' where p_siz_b = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_b = '3' where p_siz_b = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_b = '4' where p_siz_b = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_b = '5' where p_siz_b = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_c = '1' where p_siz_c = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_c = '2' where p_siz_c = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_c = '3' where p_siz_c = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_c = '4' where p_siz_c = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_c = '5' where p_siz_c = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_d = '1' where p_siz_d = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_d = '2' where p_siz_d = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_d = '3' where p_siz_d = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_d = '4' where p_siz_d = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_d = '5' where p_siz_d = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_e = '1' where p_siz_e = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_e = '2' where p_siz_e = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_e = '3' where p_siz_e = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_e = '4' where p_siz_e = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_e = '5' where p_siz_e = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_f = '1' where p_siz_f = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_f = '2' where p_siz_f = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_f = '3' where p_siz_f = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_f = '4' where p_siz_f = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_f = '5' where p_siz_f = '05' and inserted_on = cast (in_today as date);
    
    update colo set p_siz_g = '1' where p_siz_g = '01' and inserted_on = cast (in_today as date);
    update colo set p_siz_g = '2' where p_siz_g = '02' and inserted_on = cast (in_today as date);
    update colo set p_siz_g = '3' where p_siz_g = '03' and inserted_on = cast (in_today as date);
    update colo set p_siz_g = '4' where p_siz_g = '04' and inserted_on = cast (in_today as date);
    update colo set p_siz_g = '5' where p_siz_g = '05';
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.convert_sizes(varchar) to NHCR2_rc; 