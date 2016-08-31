create function get_diagnostic(in in_colo_id integer)
returns smallint AS
$BODY$
begin

    if exists (select * from colo where colo_id = in_colo_id and (
        ind_diag_exam = '1' or
        dex_bleed = '1' or
        dex_cbh_diar = '1' or
        dex_cbh_cons = '1' or
        dex_elim_ibd = '1' or
        dex_biop = '1' or
        dex_fobt = '1' or 
        dex_abn_test = '1' or 
        dex_abn_tst_ctc = '1' or 
        dex_abn_tst_bar_en = '1' or 
        dex_abn_tst_oth = '1' or
        dex_plpect_plp = '1' or 
        dex_ida = '1' or
        dex_oth = '1' or
        dex_cbh_diarcons = '1' or
        dex_abd_pain = '1'
        )) then
        return 1;
    else
        return 0;
    end if;

end;
$BODY$
language plpgsql