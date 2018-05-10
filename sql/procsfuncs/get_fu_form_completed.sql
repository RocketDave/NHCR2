create or replace function public.get_fu_form_completed(in in_colo_id bigint)
returns smallint AS
$BODY$
declare lcl_return smallint;
begin
    if exists (select * from colo where colo_id = in_colo_id and barcode = 'PathLink') then
        select 1 into lcl_return;
    elseif exists (select * from colo where colo_id = in_colo_id and
        (fup_10='1' or
        fup_1t3='1' or
        fup_2t3='1' or
        fup_4t5='1' or
        fup_6t10='1' or
        fup_6t9='1' or
        fup_baren='1' or
        fup_ctc='1' or
        fup_gt10='1' or
        fup_lt1='1' or
        fup_nfsi='1' or
        fup_othproc='1' or
        fup_pcp='1' or
        fup_pp='1' or
        fup_rwp='1' or
        fup_surgcons='1')) then
        select 1 into lcl_return;
    else
        select 0 into lcl_return;
    end if;
    return lcl_return;
end;
$BODY$
language plpgsql