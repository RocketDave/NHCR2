create function public.insert_scanned_survey (
    in in_barcode varchar
)
returns void as 
$BODY$

begin

    if not exists (select * from survey where barcode = in_barcode) then
        insert into survey(
            alcohol,aspirin,aspirin_duration,barcode,coumadin,scan_batch,curr_ht_ft,
            curr_ht_in,curr_wt,education,ever_cplp,ever_cplp_fam,ever_fap,ever_hnpcc,ever_ibs,exercise,ext_calcium,ext_calcium_daration,
            health,hispanic,ins_hmo,ins_mcaid,ins_mcare,ins_none,ins_oth,ins_priv,ins_unsure,marital_status,nsaids,nsaids_duration,other_ca,
            other_ca_fam,oth_fam_poly,pcr_colon_ca,pcr_dvt,pcr_nofind,pcr_oth,pcr_plp,pcr_rectal_ca,pcr_roids,prep_type,
            prep_type_fleet,prep_type_hal,prep_type_nul,prep_type_osmo,prep_type_oth,prev_colo,prev_sigcolo,pscr_bplp,pscr_cca,pscr_dvt,
            pscr_neg,pscr_oth,pscr_roids,psr_colon_ca,psr_dvt,psr_nofind,psr_oth,psr_plp,psr_rectal_ca,psr_roids,qty_smoke,race_amind,
            race_asian,race_black,race_oth,race_pacisl,race_white,relb450_bro_pilot,relb450_dad_pilot,relb450_kid_pilot,relb450_mom_pilot,
            relb450_sis_pilot,relcab450_bro,relcab450_dad,relcab450_dk,relcab450_kid,relcab450_mom,relcab450_sis,relcagt50_bro,relcagt50_dad,
            relcagt50_dk,relcagt50_kid,relcagt50_mom,relcagt50_sis,relca_bro,relca_dad,relca_kid,relca_mom,relca_sis,smoker,state_born,teleform_formid,
            vitamins,vitamins_pilot,vitamin_duration,vr_bleed,vr_crohn_age_dx,vr_fhxcca,vr_fhxp,vr_nosymp,vr_other,vr_phxcca,vr_phxp,vr_phx_crohn,
            vr_phx_uc,vr_uccrohn,vr_uc_age_dx,wt_20,yrs_smoke,foreign_born)
        select cast(alconum as integer),
            cast(aspirin as integer),
            cast(asp_duration as integer),
            barcode,
            cast(coumadin as integer),
            cast(batch_num as integer),
            cast(height_ft as integer),
            cast(height_in as integer),
            cast(weight_now as integer),
            cast(education as integer),
            cast(colon_plp as integer),
            cast(fam_colon_plp as integer),
            cast(fap as integer),
            cast(lynch_synd as integer),
            cast(ibs as integer),
            cast(exercise as integer),
            88,
            8,
            cast(health as integer),
            cast(hispanic as integer),
            cast(ins_hmo as integer),
            cast(ins_mcaid as integer),
            cast(ins_mcare as integer),
            cast(ins_none as integer),
            cast(ins_oth as integer),
            cast(ins_priv as integer),
            cast(ins_unsure as integer),
            cast(marital_status as integer),
            cast(otc_anti_infl as integer),
            cast(otc_ai_duration as integer),
            cast(oth_ca as integer),
            cast(oth_ca_fam as integer),
            88,
            cast(pcr_cca as integer),
            cast(pcr_dvt as integer),
            cast(pcr_allneg as integer),
            cast(pcr_oth as integer),
            cast(pcr_polyp as integer),
            cast(pcr_rectalca as integer),
            cast(pcr_roids as integer),
            cast(prep_typ as integer),
            8,
            8,
            8,
            8,
            8,
            cast(prev_colo as integer),
            8,
            0,
            0,
            0,
            0,
            0,
            0,
            cast(ps_cca as integer),
            cast(ps_dvt as integer),
            cast(ps_allneg as integer),
            cast(ps_oth as integer),
            cast(ps_polyp as integer),
            cast(ps_rectalca as integer),
            cast(ps_roids as integer),
            cast(smoknum as integer),
            cast(race_amind as integer),
            cast(race_asain as integer),
            cast(race_black as integer),
            cast(race_oth as integer),
            cast(race_pac_isl as integer),
            cast(race_white as integer),
            8,
            8,
            8,
            8,
            8,
            cast(rb450_bro as integer),
            cast(rb450_dad as integer),
            cast(rb450_dk as integer),
            cast(rb450_kid as integer),
            cast(rb450_mom as integer),
            cast(rb450_sis as integer),
            cast(rgt50_bro as integer),
            cast(rgt50_dad as integer),
            cast(rgt50_dk as integer),
            cast(rgt50_child as integer),
            cast(rgt50_mom as integer),
            cast(rgt50_sis as integer),
            cast(ca_bro as integer),
            cast(ca_dad as integer),
            cast(ca_kid as integer),
            cast(ca_mom as integer),
            cast(ca_sis as integer),
            cast(smokev as integer),
            birth_state ,
            cast(form_id as integer),
            cast(vitamins as integer),
            8,
            8,
            cast(ex_sympt as integer),
            cast(crohn_age_dx  as integer),
            cast(ex_fhx_cca as integer),
            cast(ex_fhx_plp as integer),
            cast(ex_rtn_scrn as integer),
            cast(ex_oth as integer),
            cast(ex_phx_cca as integer),
            cast(ex_phx_plp as integer),
            cast(ex_phc_crohn as integer),
            cast(ex_phx_uc as integer),
            88,
            cast(uc_age_dx  as integer),
            cast(weight_20  as integer),
            cast(smokyrs  as integer),
            cast(foriegn_born as integer)
            from import_scanned_surv_data
            where barcode = in_barcode;
    end if;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.insert_scanned_survey(varchar) to NHCR2_rc; 