create or replace function set_endoscopist(
    in in_endoscopist_id integer,
    in in_endo_first_name character varying,
    in in_endo_middle_name character varying,
    in in_endo_last_name character varying,
    in in_endo_name_suffix character varying,
    in in_endo_initials character varying,
    in in_endo_pseudo_name character varying,
    in in_endo_degree character varying,
    in in_salutation character varying,
    in in_mail_name character varying,
    in in_endo_address1 character varying,
    in in_endo_address2 character varying,
    in in_endo_address3 character varying,
    in in_endo_city character varying,
    in in_endo_state character varying,
    in in_endo_zip character varying,
    in in_endo_direct_phone character varying,
    in in_endo_pager character varying,
    in in_endo_other_phone character varying,
    in in_endo_email character varying,
    in in_endo_dob character varying,
    in in_endo_gender_male character varying,
    in in_endo_speciality character varying,
    in in_comments character varying,
    in in_endo_status character varying,
    in in_endo_status_date character varying)
returns table (
    lcl_endoscopist_id integer, 
    lcl_message character varying) AS
$BODY$

begin

    if (in_endo_pseudo_name = '') then
        in_endo_pseudo_name = null;
    end if;

    if (in_endo_dob = '') then
        in_endo_dob = null;
    end if;

    if (in_endo_dob = '') then
        in_endo_dob = null;
    end if;

    if (in_endo_status_date = '') then
       in_endo_status_date = null;
    end if;

    if (in_endo_gender_male = '') then
       in_endo_gender_male = null;
    end if;

    if (in_endoscopist_id = -9) then
        select 1 + max(endoscopist_id) from endoscopist into in_endoscopist_id where endoscopist_id != 8888 and endoscopist_id != 9999;
    end if;

    if exists(select * from endoscopist where endoscopist_id =  in_endoscopist_id) then
        update endoscopist set 
            endo_first_name = in_endo_first_name,
            endo_middle_name = in_endo_middle_name,
            endo_last_name = in_endo_last_name,
            endo_name_suffix = in_endo_name_suffix,
            endo_initials = in_endo_initials,
            endo_pseudo_name = cast (in_endo_pseudo_name as integer),
            endo_degree = in_endo_degree,
            salutation = in_salutation,
            mail_name = in_mail_name,
            endo_address1 = in_endo_address1,
            endo_address2 = in_endo_address2,
            endo_address3 = in_endo_address3,
            endo_city = in_endo_city,
            endo_state = in_endo_state,
            endo_zip = in_endo_zip,
            endo_direct_phone = in_endo_direct_phone,
            endo_pager = in_endo_pager,
            endo_other_phone = in_endo_other_phone,
            endo_email = in_endo_email,
            endo_dob = cast(in_endo_dob as date),
            endo_gender_male = cast (in_endo_gender_male as integer),
            endo_speciality = in_endo_speciality,
            comments = in_comments,
            endo_status = in_endo_status,
            endo_status_date = cast(in_endo_status_date as date) 
            where endoscopist_id = cast (in_endoscopist_id as integer);
        else insert into endoscopist (
            endoscopist_id,
            endo_first_name,
            endo_middle_name,
            endo_last_name,
            endo_name_suffix,
            endo_initials,
            endo_pseudo_name,
            endo_degree,
            salutation,
            mail_name,
            endo_address1,
            endo_address2,
            endo_address3,
            endo_city,
            endo_state,
            endo_zip,
            endo_direct_phone,
            endo_pager,
            endo_other_phone,
            endo_email,
            endo_dob,
            endo_gender_male,
            endo_speciality,
            comments,
            endo_status,
            endo_status_date
        )
        values (
            in_endoscopist_id,
            in_endo_first_name ,
            in_endo_middle_name,
            in_endo_last_name,
            in_endo_name_suffix,
            in_endo_initials,
            cast(in_endo_pseudo_name as integer),
            in_endo_degree,
            in_salutation,
            in_mail_name,
            in_endo_address1,
            in_endo_address2,
            in_endo_address3,
            in_endo_city,
            in_endo_state,
            in_endo_zip,
            in_endo_direct_phone,
            in_endo_pager,
            in_endo_other_phone,
            in_endo_email,
            cast(in_endo_dob as date),
            cast(in_endo_gender_male as integer),
            in_endo_speciality,
            in_comments,
            in_endo_status,
            cast(in_endo_status_date as date) 
        );
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        in_endoscopist_id, lcl_message;
end;
$BODY$
language plpgsql
