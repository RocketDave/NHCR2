create or replace function get_findings_screening(
    in in_endo_code integer,
    in in_facility_id character varying,
    in in_start_dt_nhcr date,
    in in_end_dt date,
    in in_end_dt2 date)
  returns table (finding varchar, you numeric, site numeric, nhcr numeric) AS
$BODY$

declare lcl_endoscopist_id integer;
declare lcl_facility_id varchar;
declare lcl_count_you numeric;
declare lcl_count_site numeric;
declare lcl_count_nhcr numeric;
declare lcl_total_you numeric;
declare lcl_total_site numeric;
declare lcl_total_nhcr numeric;

begin

    create temporary table lcl_table(
    finding varchar,
    you numeric,
    site numeric,
    nhcr numeric
    ) on commit drop;

    select endoscopist_id into lcl_endoscopist_id from endoscopist where endo_pseudo_name = in_endo_code;
    select facility_id into lcl_facility_id from facility where facility_pseudo_name = in_facility_id;

    select count(*) into lcl_total_you from Findings where screening = 1 and 
            endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1;
    select count(*) into lcl_total_site from Findings where screening = 1 and 
            facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1;
    select count(*) into lcl_total_nhcr from Findings where screening = 1 and 
            exam_date >= in_start_dt_nhcr and exam_date <= in_end_dt2 and completed = 1;

    select count(*) into lcl_count_you from Findings  where screening = 1 and 
            endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_normal = 1;
    select count(*) into lcl_count_site from Findings where screening = 1 and 
            facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_normal = 1;
    select count(*) into lcl_count_nhcr from Findings  where screening = 1 and 
            exam_date >= in_start_dt_nhcr and exam_date <= in_end_dt2 and completed = 1 and find_calc_normal = 1;
    insert into lcl_table select 'Normal', 100*lcl_count_you/lcl_total_you,100*lcl_count_site/lcl_total_site,100*lcl_count_nhcr/lcl_total_nhcr;

    select count(*) into lcl_count_you from Findings  where screening = 1 and 
            endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_polyp = 1;
    select count(*) into lcl_count_site from Findings  where screening = 1 and 
            facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_polyp = 1;
    select count(*) into lcl_count_nhcr from Findings  where screening = 1 and 
            exam_date >= in_start_dt_nhcr and exam_date <= in_end_dt2 and completed = 1 and find_calc_polyp = 1;
    insert into lcl_table select 'Polyp', 100*lcl_count_you/lcl_total_you,100*lcl_count_site/lcl_total_site,100*lcl_count_nhcr/lcl_total_nhcr;

    select count(*) into lcl_count_you from Findings  where screening = 1 and 
            endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_cancer = 1;
    select count(*) into lcl_count_site from Findings  where screening = 1 and 
            facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_cancer = 1;
    select count(*) into lcl_count_nhcr from Findings  where screening = 1 and 
            exam_date >= in_start_dt_nhcr and exam_date <= in_end_dt2 and completed = 1 and find_calc_cancer = 1;
    insert into lcl_table select 'Cancer', 100*lcl_count_you/lcl_total_you,100*lcl_count_site/lcl_total_site,100*lcl_count_nhcr/lcl_total_nhcr;

    select count(*) into lcl_count_you from Findings  where screening = 1 and 
            endoscopist_id = lcl_endoscopist_id and facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_other = 1;
    select count(*) into lcl_count_site from Findings  where screening = 1 and 
            facility_id = lcl_facility_id and 
            exam_date <= in_end_dt and completed = 1 and find_calc_other = 1;
    select count(*) into lcl_count_nhcr from Findings  where screening = 1 and 
            exam_date >= in_start_dt_nhcr and exam_date <= in_end_dt2 and completed = 1 and find_calc_other = 1;
    insert into lcl_table select 'Other', 100*lcl_count_you/lcl_total_you,100*lcl_count_site/lcl_total_site,100*lcl_count_nhcr/lcl_total_nhcr;

    return query select t.finding, t.you as "You",t.site as "Your Site", t.nhcr as "All NHCR Sites" from lcl_table t;
end;
$BODY$
LANGUAGE plpgsql 
