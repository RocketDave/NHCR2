create function get_endo_feedback(
    in in_endo_pseudo_name integer, 
    in in_facility_pseudo_name varchar, 
    in in_start_dt date, 
    in in_end_dt date,
    in in_end_dt2 date)
returns table(
        lcl_your_first_colo date,
        lcl_site_first_colo date,
        lcl_nhcr_first_colo date,
        lcl_your_exams integer,
        lcl_your_exams_cum integer,
        lcl_site_exams integer,
        lcl_nhcr_exams integer,
        lcl_your_exams_comp integer,
        lcl_your_exams_comp_cum integer,
        lcl_site_exams_comp integer,
        lcl_nhcr_exams_comp integer,
        lcl_your_exams_comp_denom integer,
        lcl_your_exams_comp_denom_cum integer,
        lcl_site_exams_comp_denom integer,
        lcl_nhcr_exams_comp_denom integer,
        lcl_your_exams_rec integer,
        lcl_your_exams_rec_cum integer,
        lcl_site_exams_rec integer,
        lcl_nhcr_exams_rec integer,
        lcl_your_exams_rec_denom integer,
        lcl_your_exams_rec_denom_cum integer,
        lcl_site_exams_rec_denom integer,
        lcl_nhcr_exams_rec_denom integer,
        lcl_your_minutes real,
        lcl_your_minutes_low real,
        lcl_your_minutes_high real,
        lcl_your_minutes_cum real,
        lcl_your_minutes_low_cum real,
        lcl_your_minutes_high_cum real,
        lcl_site_minutes real,
        lcl_site_minutes_low real,
        lcl_site_minutes_high real,
        lcl_nhcr_minutes real,
        lcl_nhcr_minutes_low real,
        lcl_nhcr_minutes_high real,
        lcl_your_adr_male integer,
        lcl_your_adr_female integer,
        lcl_your_adr_all integer,
        lcl_your_adr_male_cum integer,
        lcl_your_adr_female_cum integer,
        lcl_your_adr_all_cum integer,
        lcl_site_adr_male integer,
        lcl_site_adr_female integer,
        lcl_site_adr_all integer,
        lcl_nhcr_adr_male integer,
        lcl_nhcr_adr_female integer,
        lcl_nhcr_adr_all integer,
        lcl_your_eligible_male integer,
        lcl_your_eligible_female integer,
        lcl_your_eligible_all integer,
        lcl_your_eligible_male_cum integer,
        lcl_your_eligible_female_cum integer,
        lcl_your_eligible_all_cum integer,
        lcl_site_eligible_male integer,
        lcl_site_eligible_female integer,
        lcl_site_eligible_all integer,
        lcl_nhcr_eligible_male integer,
        lcl_nhcr_eligible_female integer,
        lcl_nhcr_eligible_all integer,
        lcl_your_eligible_male_scr integer,
        lcl_your_eligible_female_scr integer,
        lcl_your_eligible_all_scr integer,
        lcl_your_eligible_male_scr_cum integer,
        lcl_your_eligible_female_scr_cum integer,
        lcl_your_eligible_all_scr_cum integer,
        lcl_site_eligible_male_scr integer,
        lcl_site_eligible_female_scr integer,
        lcl_site_eligible_all_scr integer,
        lcl_nhcr_eligible_male_scr integer,
        lcl_nhcr_eligible_female_scr integer,
        lcl_nhcr_eligible_all_scr integer,
        lcl_your_eligible_male_sur integer,
        lcl_your_eligible_female_sur integer,
        lcl_your_eligible_all_sur integer,
        lcl_your_eligible_male_sur_cum integer,
        lcl_your_eligible_female_sur_cum integer,
        lcl_your_eligible_all_sur_cum integer,
        lcl_site_eligible_male_sur integer,
        lcl_site_eligible_female_sur integer,
        lcl_site_eligible_all_sur integer,
        lcl_nhcr_eligible_male_sur integer,
        lcl_nhcr_eligible_female_sur integer,
        lcl_nhcr_eligible_all_sur integer,
        lcl_your_adr_scr_male integer,
        lcl_your_adr_scr_female integer,
        lcl_your_adr_scr_all integer,
        lcl_your_adr_scr_male_cum integer,
        lcl_your_adr_scr_female_cum integer,
        lcl_your_adr_scr_all_cum integer,
        lcl_site_adr_scr_male integer,
        lcl_site_adr_scr_female integer,
        lcl_site_adr_scr_all integer,
        lcl_nhcr_adr_scr_male integer,
        lcl_nhcr_adr_scr_female integer,
        lcl_nhcr_adr_scr_all integer,
        lcl_your_adr_sur_male integer,
        lcl_your_adr_sur_female integer,
        lcl_your_adr_sur_all integer,
        lcl_your_adr_sur_male_cum integer,
        lcl_your_adr_sur_female_cum integer,
        lcl_your_adr_sur_all_cum integer,
        lcl_site_adr_sur_male integer,
        lcl_site_adr_sur_female integer,
        lcl_site_adr_sur_all integer,
        lcl_nhcr_adr_sur_male integer,
        lcl_nhcr_adr_sur_female integer,
        lcl_nhcr_adr_sur_all integer,
        lcl_your_cssp_male integer,
        lcl_your_cssp_female integer,
        lcl_your_cssp_all integer,
        lcl_your_cssp_male_cum integer,
        lcl_your_cssp_female_cum integer,
        lcl_your_cssp_all_cum integer,
        lcl_site_cssp_male integer,
        lcl_site_cssp_female integer,
        lcl_site_cssp_all integer,
        lcl_nhcr_cssp_male integer,
        lcl_nhcr_cssp_female integer,
        lcl_nhcr_cssp_all integer,
        lcl_your_psp_male integer,
        lcl_your_psp_female integer,
        lcl_your_psp_all integer,
        lcl_your_psp_male_cum integer,
        lcl_your_psp_female_cum integer,
        lcl_your_psp_all_cum integer,
        lcl_site_psp_male integer,
        lcl_site_psp_female integer,
        lcl_site_psp_all integer,
        lcl_nhcr_psp_male integer,
        lcl_nhcr_psp_female integer,
        lcl_nhcr_psp_all integer
)
AS
$BODY$
    declare lcl_endoscopist_id integer;
    declare lcl_facility_id varchar;
    declare lcl_your_first_colo date;
    declare lcl_site_first_colo date;
    declare lcl_nhcr_first_colo date;
begin

    select cast('2009-04-06' as date) into lcl_nhcr_first_colo;

    select endoscopist_id into lcl_endoscopist_id from endoscopist where endo_pseudo_name = in_endo_pseudo_name;
    select facility_id into lcl_facility_id from facility where facility_pseudo_name = in_facility_pseudo_name;
    select min(exam_date) from findings into lcl_your_first_colo where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id;
    select min(exam_date) from findings into lcl_site_first_colo where facility_id = lcl_facility_id;

    --total exams
    -- you
    select count(*) into lcl_your_exams from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt;
    -- your cumulative
    select count(*) into lcl_your_exams_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id and 
        exam_date <= in_end_dt;
    -- your site
    select count(*) into lcl_site_exams from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt;
    -- NHCR
    select count(*) into lcl_nhcr_exams from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2;

    --completetion rates
    -- you
    select count(*) into lcl_your_exams_comp from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and completed = 1;
    -- your cumulative
    select count(*) into lcl_your_exams_comp_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1;
    -- your site
    select count(*) into lcl_site_exams_comp from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1;
    -- NHCR
    select count(*) into lcl_nhcr_exams_comp from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and completed = 1;

    --completetion rates denominator
    select count(*) into lcl_your_exams_comp_denom from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt;
    select count(*) into lcl_your_exams_comp_denom_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt;
    select count(*) into lcl_site_exams_comp_denom from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt;
    select count(*) into lcl_nhcr_exams_comp_denom from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2;

    --recommended exam
    -- you
    select count(*) into lcl_your_exams_rec from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1 and (fup_10 = '1' or fup_gt10 = '1');
    -- your cumulative
    select count(*) into lcl_your_exams_rec_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1 and (fup_10 = '1' or fup_gt10 = '1');
    -- your site
    select count(*) into lcl_site_exams_rec from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1 and (fup_10 = '1' or fup_gt10 = '1');
    -- NHCR
    select count(*) into lcl_nhcr_exams_rec from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1 and (fup_10 = '1' or fup_gt10 = '1');

    --recommended exam denominator
    -- you
    select count(*) into lcl_your_exams_rec_denom from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1;
    -- your cumulative
    select count(*) into lcl_your_exams_rec_denom_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1;
    -- your site
    select count(*) into lcl_site_exams_rec_denom from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1;
    -- NHCR
    select count(*) into lcl_nhcr_exams_rec_denom from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and age_exam >= 50 and ind_scr_nosym = '1' and fnd_norm_ex = 1
        and fu_form_completed = '1' and (prep = '1' or prep = '2' or prep = '3') 
        and completed = 1;

    --withdrawal time yours
    select median(cast (wthdrwl_time as integer)) into lcl_your_minutes from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select median(cast (wthdrwl_time as integer)) into lcl_your_minutes_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select min(cast (wthdrwl_time as integer)) into lcl_your_minutes_low from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select min(cast (wthdrwl_time as integer)) into lcl_your_minutes_low_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select max(cast (wthdrwl_time as integer)) into lcl_your_minutes_high from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select max(cast (wthdrwl_time as integer)) into lcl_your_minutes_high_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';

    --withdrawal time site
    select median(cast (wthdrwl_time as integer)) into lcl_site_minutes from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select min(cast (wthdrwl_time as integer)) into lcl_site_minutes_low from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select max(cast (wthdrwl_time as integer)) into lcl_site_minutes_high from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';

    -- withdrawal time NHCR
    select median(cast (wthdrwl_time as integer)) into lcl_nhcr_minutes from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select min(cast (wthdrwl_time as integer)) into lcl_nhcr_minutes_low from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';
    select max(cast (wthdrwl_time as integer)) into lcl_nhcr_minutes_high from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and completed = 1 and (prep = '1' or prep = '2' or prep = '3') 
        and wthdrwl_time != '99' and wthdrwl_time != '88' and wthdrwl_time != '' 
        and find_calc_normal = 1 
        and end_proc_stat_rr != '10';

    -- adenoma detection rate
    -- you
    select count(*) into lcl_your_adr_male from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'M' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_your_adr_female from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'F' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_your_adr_all from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 
        and eligible=1 and path_report_complete = 1;
    -- your cumulative
    select count(*) into lcl_your_adr_male_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'M' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_your_adr_female_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'F' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_your_adr_all_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 
        and eligible=1 and path_report_complete = 1;
    --your site
    select count(*) into lcl_site_adr_male from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'M' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_site_adr_female from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and gender_calcd = 'F' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_site_adr_all from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 
        and eligible=1 and path_report_complete = 1;
    -- NHCR
    select count(*) into lcl_nhcr_adr_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and gender_calcd = 'M' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and gender_calcd = 'F' 
        and eligible=1 and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 
        and eligible=1 and path_report_complete = 1;

    -- adenoma detection rate screening only
    -- you
    select count(*) into lcl_your_adr_scr_male from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_your_adr_scr_female from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_your_adr_scr_all from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    -- your cumulative
    select count(*) into lcl_your_adr_scr_male_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_your_adr_scr_female_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_your_adr_scr_all_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    -- your site
    select count(*) into lcl_site_adr_scr_male from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_site_adr_scr_female from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and  adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_site_adr_scr_all from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and  adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    -- NHCR
    select count(*) into lcl_nhcr_adr_scr_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_scr_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and  adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Screening' and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_scr_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and  adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Screening' and path_report_complete = 1;

    -- adenoma detection rate surveillance only
    -- you
    select count(*) into lcl_your_adr_sur_male from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_your_adr_sur_female from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_your_adr_sur_all from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Surveillance' and path_report_complete = 1;
    -- your cumulative
    select count(*) into lcl_your_adr_sur_male_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_your_adr_sur_female_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_your_adr_sur_all_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    --- your site
    select count(*) into lcl_site_adr_sur_male from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_site_adr_sur_female from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_site_adr_sur_all from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    --- NHCR
    select count(*) into lcl_nhcr_adr_sur_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'M' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_sur_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and eligible = 1 and gender_calcd = 'F' 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_adr_sur_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and adenoma_detected = 1 and eligible = 1 
        and indication_calculated = 'Surveillance'  and path_report_complete = 1;

    -- eligible exams
    -- you
    select count(*) into lcl_your_eligible_male from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your cumulative
    select count(*) into lcl_your_eligible_male_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your site
    select count(*) into lcl_site_eligible_male from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_female from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_all from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- NHCR
    select count(*) into lcl_nhcr_eligible_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'M' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'F' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));

    ---eligible screening
    -- you
    select count(*) into lcl_your_eligible_male_scr from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female_scr from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F'and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all_scr from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your cumulative
    select count(*) into lcl_your_eligible_male_scr_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female_scr_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F'and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all_scr_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your site
    select count(*) into lcl_site_eligible_male_scr from Findings where facility_id = lcl_facility_id  
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_female_scr from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_all_scr from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- NHCR
    select count(*) into lcl_nhcr_eligible_male_scr from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_female_scr from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_all_scr from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and indication_calculated = 'Screening' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));

    ---eligible surveillance
    -- you
    select count(*) into lcl_your_eligible_male_sur from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female_sur from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all_sur from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your cumulative
    select count(*) into lcl_your_eligible_male_sur_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_female_sur_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_your_eligible_all_sur_cum from Findings where endoscopist_id = lcl_endoscopist_id  and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    -- your site
    select count(*) into lcl_site_eligible_male_sur from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_female_sur from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_site_eligible_all_sur from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and eligible = 1 and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    --- NHCR
    select count(*) into lcl_nhcr_eligible_male_sur from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'M' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_female_sur from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and gender_calcd = 'F' and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));
    select count(*) into lcl_nhcr_eligible_all_sur from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and eligible = 1 and indication_calculated = 'Surveillance' 
        and not((find_calc_polyp = 1  or find_calc_cancer = 1 or find_calc_other = 1) and (pr_event_id is null or path_report_complete != 1));

    -- clinically significant serrated polyp detection rate
    -- you
    select count(*) into lcl_your_cssp_male from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'M' and path_report_complete = 1;
    select count(*) into lcl_your_cssp_female from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'F' and path_report_complete = 1;
    select count(*) into lcl_your_cssp_all from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- your cumulative
    select count(*) into lcl_your_cssp_male_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'M' and path_report_complete = 1;
    select count(*) into lcl_your_cssp_female_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_your_cssp_all_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- your site
    select count(*) into lcl_site_cssp_male from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'M'  and path_report_complete = 1;
    select count(*) into lcl_site_cssp_female from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_site_cssp_all from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and clinically_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- NHCR
    select count(*) into lcl_nhcr_cssp_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'M'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_cssp_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and clinically_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_cssp_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and clinically_serrated = 1 and eligible = 1 and path_report_complete = 1;

    -- proximal serrated polyp detection rate
    -- you
    select count(*) into lcl_your_psp_male from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'M' and path_report_complete = 1;
    select count(*) into lcl_your_psp_female from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'F' and path_report_complete = 1;
    select count(*) into lcl_your_psp_all from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date >= in_start_dt and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- your cumulative
    select count(*) into lcl_your_psp_male_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'M' and path_report_complete = 1;
    select count(*) into lcl_your_psp_female_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_your_psp_all_cum from Findings where endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- your site
    select count(*) into lcl_site_psp_male from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'M'  and path_report_complete = 1;
    select count(*) into lcl_site_psp_female from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_site_psp_all from Findings where facility_id = lcl_facility_id 
        and exam_date <= in_end_dt 
        and proximal_serrated = 1 and eligible = 1  and path_report_complete = 1;
    -- NHCR
    select count(*) into lcl_nhcr_psp_male from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'M'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_psp_female from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and proximal_serrated = 1 and eligible = 1 and gender_calcd = 'F'  and path_report_complete = 1;
    select count(*) into lcl_nhcr_psp_all from Findings where 
        exam_date >= lcl_nhcr_first_colo and exam_date <= in_end_dt2 
        and proximal_serrated = 1 and eligible = 1  and path_report_complete = 1;

return query select 
        lcl_your_first_colo,
        lcl_site_first_colo,
        lcl_nhcr_first_colo,
        lcl_your_exams,
        lcl_your_exams_cum,
        lcl_site_exams,
        lcl_nhcr_exams,
        lcl_your_exams_comp,
        lcl_your_exams_comp_cum,
        lcl_site_exams_comp,
        lcl_nhcr_exams_comp,
        lcl_your_exams_comp_denom,
        lcl_your_exams_comp_denom_cum,
        lcl_site_exams_comp_denom,
        lcl_nhcr_exams_comp_denom,
        lcl_your_exams_rec,
        lcl_your_exams_rec_cum,
        lcl_site_exams_rec,
        lcl_nhcr_exams_rec,
        lcl_your_exams_rec_denom,
        lcl_your_exams_rec_denom_cum,
        lcl_site_exams_rec_denom,
        lcl_nhcr_exams_rec_denom,
        lcl_your_minutes,
        lcl_your_minutes_low,
        lcl_your_minutes_high,
        lcl_your_minutes_cum,
        lcl_your_minutes_low_cum,
        lcl_your_minutes_high_cum,
        lcl_site_minutes,
        lcl_site_minutes_low,
        lcl_site_minutes_high,
        lcl_nhcr_minutes,
        lcl_nhcr_minutes_low,
        lcl_nhcr_minutes_high,
        lcl_your_adr_male,
        lcl_your_adr_female,
        lcl_your_adr_all,
        lcl_your_adr_male_cum,
        lcl_your_adr_female_cum,
        lcl_your_adr_all_cum,
        lcl_site_adr_male,
        lcl_site_adr_female,
        lcl_site_adr_all,
        lcl_nhcr_adr_male,
        lcl_nhcr_adr_female,
        lcl_nhcr_adr_all,
        lcl_your_eligible_male,
        lcl_your_eligible_female,
        lcl_your_eligible_all,
        lcl_your_eligible_male_cum,
        lcl_your_eligible_female_cum,
        lcl_your_eligible_all_cum,
        lcl_site_eligible_male,
        lcl_site_eligible_female,
        lcl_site_eligible_all,
        lcl_nhcr_eligible_male,
        lcl_nhcr_eligible_female,
        lcl_nhcr_eligible_all,
        lcl_your_eligible_male_scr,
        lcl_your_eligible_female_scr,
        lcl_your_eligible_all_scr,
        lcl_your_eligible_male_scr_cum,
        lcl_your_eligible_female_scr_cum,
        lcl_your_eligible_all_scr_cum,
        lcl_site_eligible_male_scr,
        lcl_site_eligible_female_scr,
        lcl_site_eligible_all_scr,
        lcl_nhcr_eligible_male_scr,
        lcl_nhcr_eligible_female_scr,
        lcl_nhcr_eligible_all_scr,
        lcl_your_eligible_male_sur,
        lcl_your_eligible_female_sur,
        lcl_your_eligible_all_sur,
        lcl_your_eligible_male_sur_cum,
        lcl_your_eligible_female_sur_cum,
        lcl_your_eligible_all_sur_cum,
        lcl_site_eligible_male_sur,
        lcl_site_eligible_female_sur,
        lcl_site_eligible_all_sur,
        lcl_nhcr_eligible_male_sur,
        lcl_nhcr_eligible_female_sur,
        lcl_nhcr_eligible_all_sur,
        lcl_your_adr_scr_male,
        lcl_your_adr_scr_female,
        lcl_your_adr_scr_all,
        lcl_your_adr_scr_male_cum,
        lcl_your_adr_scr_female_cum,
        lcl_your_adr_scr_all_cum,
        lcl_site_adr_scr_male,
        lcl_site_adr_scr_female,
        lcl_site_adr_scr_all,
        lcl_nhcr_adr_scr_male,
        lcl_nhcr_adr_scr_female,
        lcl_nhcr_adr_scr_all,
        lcl_your_adr_sur_male,
        lcl_your_adr_sur_female,
        lcl_your_adr_sur_all,
        lcl_your_adr_sur_male_cum,
        lcl_your_adr_sur_female_cum,
        lcl_your_adr_sur_all_cum,
        lcl_site_adr_sur_male,
        lcl_site_adr_sur_female,
        lcl_site_adr_sur_all,
        lcl_nhcr_adr_sur_male,
        lcl_nhcr_adr_sur_female,
        lcl_nhcr_adr_sur_all,
        lcl_your_cssp_male,
        lcl_your_cssp_female,
        lcl_your_cssp_all,
        lcl_your_cssp_male_cum,
        lcl_your_cssp_female_cum,
        lcl_your_cssp_all_cum,
        lcl_site_cssp_male,
        lcl_site_cssp_female,
        lcl_site_cssp_all,
        lcl_nhcr_cssp_male,
        lcl_nhcr_cssp_female,
        lcl_nhcr_cssp_all,
        lcl_your_psp_male,
        lcl_your_psp_female,
        lcl_your_psp_all,
        lcl_your_psp_male_cum,
        lcl_your_psp_female_cum,
        lcl_your_psp_all_cum,
        lcl_site_psp_male,
        lcl_site_psp_female,
        lcl_site_psp_all,
        lcl_nhcr_psp_male,
        lcl_nhcr_psp_female,
        lcl_nhcr_psp_all;
end;
$BODY$
language plpgsql
