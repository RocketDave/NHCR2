create function import_follow_up ()
returns void as 
$BODY$
begin
    insert into follow_up (
        fu_barcode,
        action_on,
        action_by,
        inserted_on,
        inserted_by,
        fu_quality,
        fu_plp_rem,
        fu_plp_ltr,
        fu_plp_ltr_info,
        fu_colo_rec,
        fu_pstcmp_gas,
        fu_pstcmp_perf,
        fu_pstcmp_react,
        fu_pstcmp_bleed,
        fu_pstcmp_oth,
        fu_pstcmp_none,
        fu_explain,
        fu_feelgood,
        fu_noworry,
        fu_lschncdy,
        fu_docrecfut,
        fu_scrn,
        fu_docrecscrn,
        fu_embarss,
        fu_toolong,
        fu_pain,
        fu_prep,
        fu_nrvs,
        fu_event_id,
        fu_date,
        fu_person_id,
        fu_teleform_formid,
        id_not_found,
        teleform_batch_no)
    select
        fu_barcode,
        fix_dates_1899(mod_rec_date),
        mod_rec_user,
        fix_dates_1899(new_rec_date),
        new_rec_user,
        fu_quality,
        fu_plp_rem,
        fu_plp_ltr,
        fu_plp_ltr_info,
        fu_colo_rec,
        fu_pstcmp_gas,
        fu_pstcmp_perf,
        fu_pstcmp_react,
        fu_pstcmp_bleed,
        fu_pstcmp_oth,
        fu_pstcmp_none,
        fu_explain,
        fu_feelgood,
        fu_noworry,
        fu_lschncdy,
        fu_docrecfut,
        fu_scrn,
        fu_docrecscrn,
        fu_embarss,
        fu_toolong,
        fu_pain,
        fu_prep,
        fu_nrvs,
        fu_event_id,
        fix_dates_1899(fu_date),
        fu_person_id,
        fu_teleform_formid,
        convert_true_false(id_not_found),
        teleform_batch_no
    from
        follow_up_import
    order by fu_barcode;
    perform setval('follow_up_id_seq', max(id)) from follow_up;
end;
$BODY$
language plpgsql;