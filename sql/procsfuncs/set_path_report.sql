create or replace function public.set_path_report(
    in in_path_report_id integer,
    in in_person_id integer,
    in in_gender_calcd varchar,
    in in_dob varchar,
    in in_endoscopist_id varchar,
    in in_procedure_type varchar,
    in in_apc integer,
    in in_pathologist_code_cprs varchar,
    in in_lab_code varchar,
    in in_pathology_date varchar,
    in in_case_no varchar,
    in in_amended_path_report integer,
    in in_consult integer,
    in in_consult_date varchar,
    in in_date_discrepancy integer,
    in in_crohns_only integer,
    in in_u_colitis_only integer,
    in in_path_report_complete integer,
    in in_notes varchar)

returns table (
    lcl_path_report_id integer, 
    lcl_message varchar) AS
$BODY$
    declare lcl_date_of_birth date;
    declare lcl_pathology_date date;
    declare lcl_consult_date date;
    declare lcl_gender_person varchar;
begin

    select gender_calcd into lcl_gender_person from person where person_id = in_person_id;

    if (in_pathology_date = '') then 
        select null into in_pathology_date;
    else
        in_pathology_date = cast(in_pathology_date as date);
    end if;
    if (in_dob = '') then 
        select null into lcl_date_of_birth;
    else
        lcl_date_of_birth = cast(in_dob as date);
    end if;
    if (in_consult_date = '') then 
        select null into lcl_consult_date;
    else
        lcl_consult_date = cast(in_consult_date as date);
    end if;
    if (in_endoscopist_id = '') then
        select null into in_endoscopist_id;
    end if;
    if (in_gender_calcd = '') then
        select null into in_gender_calcd;
    end if;

    if exists(select * from path_report where path_report_id = in_path_report_id) then
        update path_report set 
            gender_calcd = in_gender_calcd,
            date_of_birth = lcl_date_of_birth,
            endoscopist_id = cast(in_endoscopist_id as integer),
            procedure_type = in_procedure_type,
            apc = in_apc,
            pathologist_code_cprs = in_pathologist_code_cprs,
            lab_code = in_lab_code,
            pathology_date = lcl_pathology_date,
            case_no = in_case_no,
            amended_path_report = in_amended_path_report,
            consult = in_consult,
            consult_date = lcl_consult_date,
            date_discrepancy = in_date_discrepancy,
            crohns_only = in_crohns_only,
            u_colitis_only = in_u_colitis_only,
            path_report_complete = in_path_report_complete,
            notes = in_notes
        where path_report_id = in_path_report_id;
    else insert into path_report (
            path_report_id,
            gender_calcd,
            date_of_birth,
            endoscopist_id,
            procedure_type,
            apc,
            pathologist_code_cprs,
            lab_code,
            pathology_date,
            case_no,
            amended_path_report,
            consult,
            consult_date,
            date_discrepancy,
            crohns_only,
            u_colitis_only,
            path_report_complete,
            notes
        )
        values (
            in_path_report_id,
            in_gender_calcd,
            lcl_date_of_birth,
            cast(in_endoscopist_id as integer),
            in_procedure_type,
            in_apc,
            in_pathologist_code_cprs,
            in_lab_code,
            lcl_pathology_date,
            in_case_no,
            in_amended_path_report,
            in_consult,
            lcl_consult_date,
            in_date_discrepancy,
            in_crohns_only,
            in_u_colitis_only,
            in_path_report_complete,
            in_notes
        );
    end if;

    if ((lcl_gender_person is null or lcl_gender_person = 'U') and in_gender_calcd is not null) then
        update person set gender_calcd = in_gender_calcd, source_gender_calcd = 'PathReport' where person_id = in_person_id;
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        in_path_report_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_path_report 
    (integer,integer,varchar,varchar,varchar,varchar,integer,varchar,varchar,varchar,varchar,integer,integer,varchar,integer,integer,integer,integer,varchar) to nhcr2_rc, nhcr2_staff; 
