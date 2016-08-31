create or replace function set_endoscopist_fg(
       in in_endoscopist_id integer,
       in in_mail_name varchar,
       in in_participating integer,
       in in_main_site varchar,
       in in_report_handling character varying,
       in in_enroll_survey_done integer,
       in in_steering_committee integer)
returns table (
    lcl_endoscopist_id integer, 
    lcl_message varchar)
AS $$
begin

    if exists(select * from endoscopist where endoscopist_id = in_endoscopist_id) then
        update endoscopist set 
            endoscopist_id = in_endoscopist_id,
            mail_name = in_mail_name,
            participating = in_participating,
            main_site = in_main_site,
            report_handling = in_report_handling,
            enroll_survey_done = in_enroll_survey_done,
            steering_committee = in_steering_committee
        where endoscopist_id = in_endoscopist_id;
    else insert into endoscopist (
        endoscopist_id,
        mail_name,
        participating,
        main_site,
        report_handling,
        enroll_survey_done,
        steering_committee
        )
    values (
        endoscopist_id,
        mail_name,
        participating,
        main_site,
        report_handling,
        enroll_survey_done,
        steering_committee);
    RETURN QUERY
    select in_endoscopist_id as lcl_endoscopist_id, 'record updated' as lcl_message;
end;
$$ LANGUAGE plpgsql;
grant execute on set_endoscopist_fg to NHCR2_rc; 
