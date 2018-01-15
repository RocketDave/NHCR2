create or replace function set_endoscopist_fg(
       in in_endoscopist_id integer,
       in in_participating integer,
       in in_main_site character varying,
       in in_report_handling character varying,
       in in_enroll_survey_done integer,
       in in_steering_committee integer)
returns table (
    lcl_endoscopist_id integer, 
    lcl_message varchar) as 
$BODY$

begin

    if exists(select * from endoscopist where endoscopist_id = in_endoscopist_id) then
        update endoscopist set 
            participating = in_participating ,
            main_site = in_main_site,
            report_handling = in_report_handling,
            enroll_survey_done = in_enroll_survey_done,
            steering_committee = in_steering_committee
        where endoscopist_id = in_endoscopist_id;
    else insert into endoscopist (
        participating,
        main_site,
        report_handling,
        enroll_survey_done,
        steering_committee
        )
    values (
        in_participating,
        in_main_site,
        in_report_handling,
        in_enroll_survey_done,
        in_steering_committee);
    end if;

    if (in_endoscopist_id = -9) then
        select currval('endoscopist_endoscopist_id_seq') into lcl_endoscopist_id;
    else
        lcl_endoscopist_id = in_endoscopist_id;
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        in_endoscopist_id, lcl_message;
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_endoscopist_fg(integer, integer, character varying, character varying,integer,integer) to NHCR2_rc; 

