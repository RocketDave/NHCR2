-- FUNCTION: public.has_survey(integer)

-- DROP FUNCTION public.has_survey(integer);

CREATE OR REPLACE FUNCTION public.has_survey(
	in_event_id integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$

declare lcl_return varchar;
begin

if not exists (select * from survey where event_id = in_event_id) then 
	select 'no' into lcl_return;
elseif exists (select * from survey where event_id = in_event_id and 
	(vr_nosymp  is null or vr_nosymp  = 0 or vr_nosymp  = 9) and
	(vr_phxp  is null or vr_phxp  = 0 or vr_phxp  = 88 or vr_phxp  = 9) and
	(vr_phxcca  is null or vr_phxcca  = 0 or vr_phxcca  = 9) and
	(vr_fhxp  is null or vr_fhxp  = 0 or vr_fhxp  = 88 or vr_fhxp  = 9) and
	(vr_fhxcca  is null or vr_fhxcca  = 0 or vr_fhxcca  = 9) and
	(vr_bleed  is null or vr_bleed  = 0 or vr_bleed  = 9) and
	(vr_phx_uc  is null or vr_phx_uc  = 0 or vr_phx_uc  = 88 or vr_phx_uc  = 9) and
	(vr_uc_age_dx  is null or vr_uc_age_dx  = 0 or vr_uc_age_dx  = 888 or vr_uc_age_dx  = 99 or vr_uc_age_dx  = 999) and
	(vr_phx_crohn  is null or vr_phx_crohn  = 0 or vr_phx_crohn  = 88 or vr_phx_crohn  = 9) and
	(vr_crohn_age_dx  is null or vr_crohn_age_dx  = 0 or vr_crohn_age_dx  = 888 or vr_crohn_age_dx  = 999 or vr_crohn_age_dx  = 99) and
	(vr_other  is null or vr_other  = 0 or vr_other  = 9) and
	(prep_type_nul  is null or prep_type_nul  = 0 or prep_type_nul  = 8 or prep_type_nul  = 9) and
	(prep_type_hal  is null or prep_type_hal  = 0 or prep_type_hal  = 8 or prep_type_hal  = 9) and
	(prep_type_fleet  is null or prep_type_fleet  = 0 or prep_type_fleet  = 8 or prep_type_fleet  = 9) and
	(prep_type_osmo  is null or prep_type_osmo  = 0 or prep_type_osmo  = 8 or prep_type_osmo  = 9 or prep_type_osmo  = 88) and
	(prep_type_oth  is null or prep_type_oth  = 0 or prep_type_oth  = 8 or prep_type_oth  = 9) and
	(prev_colo  is null or prev_colo  = 0 or prev_colo  = 8 or prev_colo  = 9) and
	(pcr_nofind  is null or pcr_nofind  = 0 or pcr_nofind  = 88 or pcr_nofind  = 9) and
	(pcr_plp  is null or pcr_plp  = 0 or pcr_plp  = 88 or pcr_plp  = 9) and
	(pcr_colon_ca  is null or pcr_colon_ca  = 0 or pcr_colon_ca  = 88 or pcr_colon_ca  = 9) and
	(pcr_rectal_ca  is null or pcr_rectal_ca  = 0 or pcr_rectal_ca  = 88 or pcr_rectal_ca  = 9) and
	(pcr_roids  is null or pcr_roids  = 0 or pcr_roids  = 88 or pcr_roids  = 9) and
	(pcr_dvt  is null or pcr_dvt  = 0 or pcr_dvt  = 88 or pcr_dvt  = 9) and
	(pcr_oth  is null or pcr_oth  = 0 or pcr_oth  = 88 or pcr_oth  = 9) and
	(psr_nofind  is null or psr_nofind  = 0 or psr_nofind  = 88 or psr_nofind  = 9) and
	(psr_plp  is null or psr_plp  = 0 or psr_plp  = 88 or psr_plp  = 9) and
	(psr_colon_ca  is null or psr_colon_ca  = 0 or psr_colon_ca  = 88 or psr_colon_ca  = 9) and
	(psr_rectal_ca  is null or psr_rectal_ca  = 0 or psr_rectal_ca  = 88 or psr_rectal_ca  = 9) and
	(psr_roids  is null or psr_roids  = 0 or psr_roids  = 88 or psr_roids  = 9) and
	(psr_dvt  is null or psr_dvt  = 0 or psr_dvt  = 88 or psr_dvt  = 9) and
	(psr_oth  is null or psr_oth  = 0 or psr_oth  = 88 or psr_oth  = 9) and
	(relca_mom  is null or relca_mom  = 0 or relca_mom  = 9) and
	(relca_dad  is null or relca_dad  = 0 or relca_dad  = 9) and
	(relca_sis  is null or relca_sis  = 0 or relca_sis  = 9) and
	(relca_bro  is null or relca_bro  = 0 or relca_bro  = 9) and
	(relca_kid  is null or relca_kid  = 0 or relca_kid  = 9) and
	(relcab450_mom  is null or relcab450_mom  = 0 or relcab450_mom  = 8 or relcab450_mom  = 9) and
	(relcab450_dad  is null or relcab450_dad  = 0 or relcab450_dad  = 8 or relcab450_dad  = 9) and
	(relcab450_sis  is null or relcab450_sis  = 0 or relcab450_sis  = 8 or relcab450_sis  = 9) and
	(relcab450_bro  is null or relcab450_bro  = 0 or relcab450_bro  = 8 or relcab450_bro  = 9) and
	(relcab450_kid  is null or relcab450_kid  = 0 or relcab450_kid  = 8 or relcab450_kid  = 9) and
	(relcab450_dk  is null or relcab450_dk  = 0 or relcab450_dk  = 8 or relcab450_dk  = 88) and
	(relcagt50_mom  is null or relcagt50_mom  = 0 or relcagt50_mom  = 8 or relcagt50_mom  = 9) and
	(relcagt50_dad  is null or relcagt50_dad  = 0 or relcagt50_dad  = 8 or relcagt50_dad  = 9) and
	(relcagt50_sis  is null or relcagt50_sis  = 0 or relcagt50_sis  = 8 or relcagt50_sis  = 9) and
	(relcagt50_bro  is null or relcagt50_bro  = 0 or relcagt50_bro  = 8 or relcagt50_bro  = 9) and
	(relcagt50_kid  is null or relcagt50_kid  = 0 or relcagt50_kid  = 8 or relcagt50_kid  = 9) and
	(relcagt50_dk  is null or relcagt50_dk  = 0 or relcagt50_dk  = 8 or relcagt50_dk  = 88) and
	(ever_cplp  is null or ever_cplp  = 0 or ever_cplp  = 88 or ever_cplp  = 9) and
	(ever_cplp_fam  is null or ever_cplp_fam  = 0 or ever_cplp_fam  = 9) and
	(ever_fap  is null or ever_fap  = 0 or ever_fap  = 9) and
	(ever_hnpcc  is null or ever_hnpcc  = 0 or ever_hnpcc  = 9) and
	(ever_ibs  is null or ever_ibs  = 0 or ever_ibs  = 8 or ever_ibs  = 9) and
	(other_ca  is null or other_ca  = 0 or other_ca  = 8 or other_ca  = 9) and
	(other_ca_fam  is null or other_ca_fam  = 0 or other_ca_fam  = 8 or other_ca_fam  = 9) and
	(aspirin  is null or aspirin  = 0 or aspirin  = 9) and
	(aspirin_duration  is null or aspirin_duration  = 0 or aspirin_duration  = 8 or aspirin_duration  = 9) and
	(vitamins_pilot  is null or vitamins_pilot  = 0 or vitamins_pilot  = 8 or vitamins_pilot  = 9 or vitamins_pilot  = 88) and
	(nsaids  is null or nsaids  = 0 or nsaids  = 8 or nsaids  = 9) and
	(nsaids_duration  is null or nsaids_duration  = 0 or nsaids_duration  = 8 or nsaids_duration  = 9) and
	(health  is null or health  = 0 or health  = 9) and
	(smoker  is null or smoker  = 0 or smoker  = 9) and
	(yrs_smoke  is null or yrs_smoke  = 0 or yrs_smoke  = 99) and
	(qty_smoke  is null or qty_smoke  = 0 or qty_smoke  = 9) and
	(alcohol  is null or alcohol  = 0 or alcohol  = 9) and
	(exercise  is null or exercise  = 0 or exercise  = 9) and
	(curr_ht_ft  is null or curr_ht_ft  = 0 or curr_ht_ft  = 9 or curr_ht_ft = 8) and
	(curr_ht_in  is null or curr_ht_in  = 0 or curr_ht_in  = 99) and
	(curr_wt  is null or curr_wt  = 0 or curr_wt  = 999) and
	(wt_20  is null or wt_20  = 0 or wt_20  = 999) and
	(ins_mcare  is null or ins_mcare  = 0) and
	(ins_mcaid  is null or ins_mcaid  = 0) and
	(ins_priv  is null or ins_priv  = 0) and
	(ins_hmo  is null or ins_hmo  = 0) and
	(ins_oth  is null or ins_oth  = 0) and
	(ins_unsure  is null or ins_unsure  = 0) and
	(ins_none  is null or ins_none  = 0) and
	(hispanic  is null or hispanic  = 0 or hispanic  = 9 or hispanic = -9) and
	(race_white  is null or race_white  = 0) and
	(race_black  is null or race_black  = 0) and
	(race_asian  is null or race_asian  = 0) and
	(race_pacisl  is null or race_pacisl  = 0) and
	(race_amind  is null or race_amind  = 0 ) and
	(race_oth  is null or race_oth  = 0) and
	(education  is null or education  = 0 or education  = 9) and
	(marital_status  is null or marital_status  = 0 or marital_status  = 9) and
	(comp_race  is null or comp_race  = 0 or comp_race  = 88 or comp_race  = 9) and
	(coumadin  is null or coumadin  = 0 or coumadin  = 88 or coumadin  = 9) and
	(prev_sigcolo  is null or prev_sigcolo  = 0 or prev_sigcolo  = 8 or prev_sigcolo  = 88) and
	(pscr_neg  is null or pscr_neg  = 0 or pscr_neg  = 88 or pscr_neg  = 9) and
	(pscr_bplp  is null or pscr_bplp  = 0 or pscr_bplp  = 88 or pscr_bplp  = 9) and
	(pscr_cca  is null or pscr_cca  = 0 or pscr_cca  = 88 or pscr_cca  = 9) and
	(pscr_roids  is null or pscr_roids  = 0 or pscr_roids  = 88 or pscr_roids  = 9) and
	(pscr_dvt  is null or pscr_dvt  = 0 or pscr_dvt  = 88 or pscr_dvt  = 9) and
	(pscr_oth  is null or pscr_oth  = 0 or pscr_oth  = 88 or pscr_oth  = 9) and
	(vitamin_duration  is null or vitamin_duration  = 0 or vitamin_duration  = 8) and
	(ext_calcium  is null or ext_calcium  = 0 or ext_calcium  = 88) and
	(ext_calcium_daration  is null or ext_calcium_daration  = 0 or ext_calcium_daration  = 8 or ext_calcium_daration  = 88) and
	(oth_fam_poly  is null or oth_fam_poly  = 0 or oth_fam_poly  = 8 or oth_fam_poly  = 88) and
	(vr_uccrohn  is null or vr_uccrohn  = 0 or vr_uccrohn  = 88) and
	(relb450_mom_pilot  is null or relb450_mom_pilot  = 0 or relb450_mom_pilot  = 88 or relb450_mom_pilot  = 8) and
	(relb450_dad_pilot  is null or relb450_dad_pilot  = 0 or relb450_dad_pilot  = 88 or relb450_dad_pilot  = 8) and
	(relb450_sis_pilot  is null or relb450_sis_pilot  = 0 or relb450_sis_pilot  = 88 or relb450_sis_pilot  = 8) and
	(relb450_bro_pilot  is null or relb450_bro_pilot  = 0 or relb450_bro_pilot  = 88 or relb450_bro_pilot  = 8) and
	(relb450_kid_pilot  is null or relb450_kid_pilot  = 0 or relb450_kid_pilot  = 88 or relb450_kid_pilot  = 8) and
	(vitamins  is null or vitamins  = 8 or vitamins  = 9) and 
	(prep_type  is null or prep_type  = 0 or prep_type  = 8 or prep_type  = 9) and
	(foreign_born  is null or foreign_born  = 8 or foreign_born  = 9) and
	(vr_none_tab  is null or vr_none_tab  = 0 or vr_none_tab  = 8 or vr_none_tab  = 9) and
	(vr_dk_tab  is null or vr_dk_tab  = 0 or vr_dk_tab  = 8 or vr_dk_tab  = 9) and
	(pcr_dk_tab  is null or pcr_dk_tab  = 0 or pcr_dk_tab  = 8 or pcr_dk_tab  = 9) and
	(psr_never_tab  is null or psr_never_tab  = 0 or psr_never_tab  = 8 or psr_never_tab  = 9) and
	(psr_dk_tab  is null or psr_dk_tab  = 0 or psr_dk_tab  = 8 or psr_dk_tab  = 9) and
	(relca_mom_gt60_tab  is null or relca_mom_gt60_tab  = 0 or relca_mom_gt60_tab  = 88 or relca_mom_gt60_tab  = 9) and
	(relca_mom_dk_tab  is null or relca_mom_dk_tab  = 0 or relca_mom_dk_tab  = 88 or relca_mom_dk_tab  = 9) and
	(relca_dad_gt60_tab  is null or relca_dad_gt60_tab  = 0 or relca_dad_gt60_tab  = 88 or relca_dad_gt60_tab  = 9) and
	(relca_dad_dk_tab  is null or relca_dad_dk_tab  = 0 or relca_dad_dk_tab  = 88 or relca_dad_dk_tab  = 9) and
	(relca_sis_gt60_tab  is null or relca_sis_gt60_tab  = 0 or relca_sis_gt60_tab  = 88 or relca_sis_gt60_tab  = 9) and
	(relca_bro_gt60_tab  is null or relca_bro_gt60_tab  = 0 or relca_bro_gt60_tab  = 88 or relca_bro_gt60_tab  = 9) and
	(relca_kid_gt60_tab  is null or relca_kid_gt60_tab  = 0 or relca_kid_gt60_tab  = 88 or relca_kid_gt60_tab  = 9) and
	(relca_sis_dk_tab  is null or relca_sis_dk_tab  = 0 or relca_sis_dk_tab  = 88 or relca_sis_dk_tab  = 9) and
	(relca_bro_dk_tab  is null or relca_bro_dk_tab  = 0 or relca_bro_dk_tab  = 88 or relca_bro_dk_tab  = 9) and
	(relca_kid_dk_tab  is null or relca_kid_dk_tab  = 0 or relca_kid_dk_tab  = 88 or relca_kid_dk_tab  = 9) and
	(evr_crc_tab  is null or evr_crc_tab  = 0 or evr_crc_tab  = 88 or evr_crc_tab  = 9) and
	(relca_age_mom_tab  is null or relca_age_mom_tab  = 0 or relca_age_mom_tab  = 88 or relca_age_mom_tab  = 9) and 
	(relca_age_dad_tab is null or relca_age_dad_tab = 0 or relca_age_dad_tab = 88 or relca_age_dad_tab = 9)) then 
        select 'empty' into lcl_return;
    else
        select 'yes' into lcl_return;
    end if;
    return lcl_return;
end;

$BODY$;

ALTER FUNCTION public.has_survey(integer)
    OWNER TO informatics;
