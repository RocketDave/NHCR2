create function get_indication(in in_colo_id integer)
returns varchar AS
$BODY$
    declare lcl_barcode character varying;
            lcl_indication character varying;
            lcl_noindication integer;
            lcl_cbh integer;
            lcl_ind_scr_nosym character varying;
            lcl_ind_scr_fhxcc character varying;
            lcl_ind_scr_fhxplp character varying;
            lcl_ind_scr_fhxcc_fdr character varying;
            lcl_ind_sur_phxcc character varying;
            lcl_ind_sur_phxplp character varying;
            lcl_ind_sur_phxplpcca character varying;
            lcl_ind_sur_fhnpcc character varying;
            lcl_ind_scr_phxcca character varying;
            lcl_ind_sur_ibd character varying;
            lcl_ibdtyp_uc character varying;
            lcl_ibdtyp_crohn character varying;
            lcl_ibdtyp_ind character varying;
            lcl_ind_diag_exam character varying;
            lcl_dex_bleed character varying;
            lcl_dex_cbh_diar character varying;
            lcl_dex_cbh_cons character varying;
            lcl_dex_cbh_diarcons character varying;
            lcl_dex_elim_ibd character varying;
            lcl_dex_biop character varying;
            lcl_dex_fobt character varying;
            lcl_dex_abd_pain character varying;
            lcl_dex_abn_test character varying;
            lcl_dex_abn_tst_ctc character varying;
            lcl_dex_abn_tst_bar_en character varying;
            lcl_dex_abn_tst_oth character varying;
            lcl_dex_plpect_plp character varying;
            lcl_dex_ida character varying;
            lcl_dex_oth character varying;
            lcl_dx integer;
            lcl_sur integer;
            lcl_scr integer;
            lcl_dx_calc integer;
            lcl_sur_calc integer;
            lcl_scr_calc integer;
begin

    select 
        barcode,
        ind_scr_nosym ,
        ind_scr_fhxcc ,
        ind_scr_fhxplp ,
        ind_scr_fhxcc_fdr,
        ind_sur_phxcc ,
        ind_sur_phxplp ,
        ind_sur_phxplpcca,
        ind_sur_fhnpcc ,
        ind_scr_phxcca,
        ind_sur_ibd ,
        ibdtyp_uc ,
        ibdtyp_crohn ,
        ibdtyp_ind ,
        ind_diag_exam ,
        dex_bleed ,
        dex_cbh_diar ,
        dex_cbh_cons ,
        dex_cbh_diarcons,
        dex_elim_ibd ,
        dex_biop ,
        dex_fobt ,
        dex_abd_pain,
        dex_abn_test ,
        dex_abn_tst_ctc ,
        dex_abn_tst_bar_en ,
        dex_abn_tst_oth ,
        dex_plpect_plp ,
        dex_ida ,
        dex_oth
    into
        lcl_barcode,
        lcl_ind_scr_nosym ,
        lcl_ind_scr_fhxcc ,
        lcl_ind_scr_fhxplp ,
        lcl_ind_scr_fhxcc_fdr,
        lcl_ind_sur_phxcc ,
        lcl_ind_sur_phxplp ,
        lcl_ind_sur_phxplpcca,
        lcl_ind_sur_fhnpcc ,
        lcl_ind_scr_phxcca,
        lcl_ind_sur_ibd ,
        lcl_ibdtyp_uc ,
        lcl_ibdtyp_crohn ,
        lcl_ibdtyp_ind ,
        lcl_ind_diag_exam ,
        lcl_dex_bleed ,
        lcl_dex_cbh_diar ,
        lcl_dex_cbh_cons ,
        lcl_dex_cbh_diarcons,
        lcl_dex_elim_ibd ,
        lcl_dex_biop ,
        lcl_dex_fobt ,
        lcl_dex_abd_pain,
        lcl_dex_abn_test ,
        lcl_dex_abn_tst_ctc ,
        lcl_dex_abn_tst_bar_en ,
        lcl_dex_abn_tst_oth ,
        lcl_dex_plpect_plp ,
        lcl_dex_ida ,
        lcl_dex_oth
    from colo where colo_id = in_colo_id;

    if (lcl_ind_diag_exam = '1' or
        lcl_dex_bleed = '1' or
        lcl_dex_cbh_diar = '1' or
        lcl_dex_cbh_cons = '1' or
        lcl_dex_elim_ibd = '1' or
        lcl_dex_biop = '1' or
        lcl_dex_fobt = '1' or 
        lcl_dex_abn_test = '1' or 
        lcl_dex_abn_tst_ctc = '1' or 
        lcl_dex_abn_tst_bar_en = '1' or 
        lcl_dex_abn_tst_oth = '1' or
        lcl_dex_plpect_plp = '1' or 
        lcl_dex_ida = '1' or
        lcl_dex_oth = '1' or
        lcl_dex_cbh_diarcons = '1' or
        lcl_dex_abd_pain = '1') then
        lcl_dx = 1;
    else
        lcl_dx = 0; -- diagnosis
    end if;

    if (lcl_ind_scr_nosym = '1' or 
        lcl_ind_scr_fhxcc = '1' or 
        lcl_ind_scr_fhxplp = '1' or 
        lcl_ind_scr_fhxcc_fdr = '1') then
        lcl_scr = 1;
    else
        lcl_scr = 0; -- screening
    end if;

    if (lcl_ind_sur_phxcc = '1' or 
        lcl_ind_sur_phxplp = '1' or 
        lcl_ind_sur_phxplpcca= '1' or
        lcl_ind_sur_fhnpcc = '1' or 
        lcl_ind_scr_phxcca = '1' or 
        lcl_ind_sur_ibd = '1' or
        lcl_ibdtyp_uc = '1' or
        lcl_ibdtyp_crohn = '1' or
        lcl_ibdtyp_ind = '1') then
        lcl_sur = 1;
    else
        lcl_sur = 0; -- surveillance
    end if;

    if ((lcl_dex_cbh_diar = '1' or lcl_dex_cbh_cons = '1' or lcl_dex_cbh_diarcons = '1') and (
            lcl_dex_bleed = '0' and lcl_dex_elim_ibd = '0' and lcl_dex_biop = '0' and lcl_dex_fobt = '0' and 
            lcl_dex_abn_test = '0' and lcl_dex_abn_tst_ctc = '0' and lcl_dex_abn_tst_bar_en = '0' and 
            lcl_dex_abn_tst_oth = '0' and lcl_dex_plpect_plp = '0' and lcl_dex_ida = '0' and 
            lcl_dex_oth = '0' and lcl_dex_abd_pain = '0')) then
        lcl_cbh = 1;
    else 
        lcl_cbh = 0;
    end if;

    lcl_dx_calc = lcl_dx;
    lcl_sur_calc = lcl_sur;
    lcl_scr_calc = lcl_scr;

    if (lcl_scr = 1 and lcl_sur = 1) then
        lcl_sur_calc = 1; -- calculated Indication: Surveillance
        lcl_scr_calc = 0; -- calculated Indication: Screening
    end if;
    if (lcl_scr = 1 and lcl_dx = 1) then
        lcl_dx_calc = 1;  --calculated Indication: Diagnostic
        lcl_scr_calc = 0; --calculated Indication: Screening
    end if;
    if (lcl_sur = 1 and  lcl_dx = 1) then
        lcl_dx_calc = 1;  --calculated Indication: Diagnostic
        lcl_sur_calc = 0; --calculated Indication: Surveillance
    end if;
    if (lcl_scr = 1 and  lcl_dx = 1 and  lcl_sur = 1) then
        lcl_dx_calc = 1;  --calculated Indication: Diagnostic
        lcl_scr_calc = 0; --calculated Indication: Screening
        lcl_sur_calc = 0; --calculated Indication: Surveillance
    end if;

  --Now, possibly modify the calculated values, intoducing the CBH factor

    if (lcl_scr = 1 and lcl_cbh = 1 and lcl_sur = 0) then
        lcl_dx_calc = 0;
        lcl_scr_calc = 1;  --calculated Indication: Screening
    end if; 
    if (lcl_sur = 1 and lcl_cbh = 1) then
        lcl_dx_calc = 0;
        lcl_sur_calc = 1;  --calculated Indication: Surveillance
    end if; 
    if (lcl_sur = 1 and lcl_scr = 1 and lcl_cbh = 1) then
        lcl_sur_calc = 1;  --calculated Indication: Surveillance
        lcl_scr_calc = 0;
        lcl_dx_calc = 0;
    end if; 
    if (lcl_scr_calc = 0 and lcl_sur_calc = 0 and lcl_dx_calc = 0) then
        lcl_noindication = 1;  --calculated Indication: No indication
    end if; 

  --Finally, take care of any conflict amongst the calculated values

    if (lcl_scr_calc = 1) then
        lcl_indication:='Screening';
    end if; 
    if (lcl_sur_calc = 1) then
        lcl_indication:='Surveillance';
    end if; 
    if (lcl_dx_calc = 1) then
        lcl_indication:='Diagnostic';
    end if; 
    if (lcl_noindication = 1) then
        lcl_indication:='No indication';
    end if; 

    return lcl_indication;
end;
$BODY$
language plpgsql