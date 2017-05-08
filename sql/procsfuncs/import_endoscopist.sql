create function import_endoscopist()
returns void as 
$BODY$
begin

    update endoscopist_import set endo_dob = fix_dates_1899(endo_dob);
    update endoscopist_import set endo_status_date = fix_dates_1899(endo_status_date);

    update endoscopist_import set modify_date = current_date where modify_date is null;
    update endoscopist_import set modify_user = 'unknown' where modify_user is null;
    update endoscopist_import set create_date = current_date where create_date is null;
    update endoscopist_import set create_user = 'unknown' where create_user is null;

    insert into endoscopist (
        endoscopist_id,
        action_on,
        action_by,
        inserted_on,
        inserted_by,
        endo_initials,
        endo_first_name,
        endo_middle_name,
        endo_last_name,
        endo_name_suffix,
        endo_degree,
        salutation,
        mail_name,
        endo_organization,
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
        endo_specialty,
        endo_med_grad_year,
        endo_fellowship,
        endo_fellow_grad_year,
        endo_fellow_discipline,
        year_first_colo,
        comments,
        participating,
        main_site,
        report_handling,
        enroll_survey_done,
        steering_committee,
        endo_status,
        endo_status_date,
        endo_pseudo_name)
    select
        endo_code,
        modify_date,
        modify_user,
        create_date,
        create_user,
        endo_initials,
        endo_first_name,
        endo_middle_name,
        endo_last_name,
        endo_name_suffix,
        endo_degree,
        salutation,
        mail_name,
        endo_organization,
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
        convert_true_false(endo_gender_male),
        endo_specialty,
        endo_med_grad_year,
        convert_true_false(endo_fellowship),
        endo_fellow_grad_year,
        endo_fellow_discipline,
        year_first_colo,
        comments,
        convert_true_false(participating),
        main_site,
        report_handling,
        convert_true_false(enroll_survey_done),
        convert_true_false(steering_committee),
        endo_status,
        endo_status_date,
        endo_pseudo_name
    from 
        endoscopist_import;
end;
$BODY$
language plpgsql;