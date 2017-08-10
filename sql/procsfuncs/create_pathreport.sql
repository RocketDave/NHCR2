create or replace function public.create_path_report(
    in_event_id integer)
returns table (
    lcl_path_report_id integer,
    lcl_message character varying
) AS
$BODY$
declare
    lcl_person_id integer;
    lcl_event_date date;
    lcl_date_of_birth date;
    lcl_gender_calcd varchar;
    lcl_endo_code integer;
    lcl_event_type varchar;
    lcl_refused integer;
    lcl_p_loc_a varchar;
    lcl_p_siz_a varchar;
    lcl_p_flat_a varchar;
    lcl_p_loc_b varchar;
    lcl_p_siz_b varchar;
    lcl_p_flat_b varchar;
    lcl_p_loc_c varchar;
    lcl_p_siz_c varchar;
    lcl_p_flat_c varchar;
    lcl_p_loc_d varchar;
    lcl_p_siz_d varchar;
    lcl_p_flat_d varchar;
    lcl_p_loc_e varchar;
    lcl_p_siz_e varchar;
    lcl_p_flat_e varchar;
    lcl_p_loc_f varchar;
    lcl_p_siz_f varchar;
    lcl_p_flat_f varchar;
    lcl_p_loc_g varchar;
    lcl_p_siz_g varchar;
    lcl_p_flat_g varchar;
    lcl_susp_ca_loc varchar;
    lcl_susp_ca_siz varchar;
    lcl_fnd_plp integer;
    lcl_no_q smallint;
    lcl_q_form_incomplete smallint;

begin
    select 
        person_id, 
        refused,
        event_date, 
        endo_code,
        dob, 
        gender_calcd,
        event_type
    into
        lcl_person_id, 
        lcl_refused,
        lcl_event_date, 
        lcl_endo_code,
        lcl_date_of_birth, 
        lcl_gender_calcd,
        lcl_event_type
    from vPathReportSrch where event_id = in_event_id;

    if (lcl_event_type = 'LINK') then
        lcl_no_q = 1;
    else
        lcl_no_q = 0;
    end if;

    select fnd_plp,
        p_loc_a, p_siz_a,p_flat_a,
        p_loc_b, p_siz_b,p_flat_b,
        p_loc_c, p_siz_c,p_flat_c,
        p_loc_d, p_siz_d,p_flat_d,
        p_loc_e, p_siz_e,p_flat_e,
        p_loc_f, p_siz_f,p_flat_f, 
        p_loc_g, p_siz_g,p_flat_g into
        lcl_fnd_plp,
        lcl_p_loc_a, lcl_p_siz_a,lcl_p_flat_a,
        lcl_p_loc_b, lcl_p_siz_b,lcl_p_flat_b,
        lcl_p_loc_c, lcl_p_siz_c,lcl_p_flat_c,
        lcl_p_loc_d, lcl_p_siz_d,lcl_p_flat_d,
        lcl_p_loc_e, lcl_p_siz_e,lcl_p_flat_e,
        lcl_p_loc_f, lcl_p_siz_f,lcl_p_flat_f,
        lcl_p_loc_g, lcl_p_siz_g,lcl_p_flat_g
        from colo where event_id = in_event_id;
    
    if (lcl_fnd_plp = 1 and (lcl_p_loc_a = '' or lcl_p_loc_a = '99' or  lcl_p_siz_a = '' or lcl_p_siz_a = '99')) then
        lcl_q_form_incomplete = 1;
    else
        lcl_q_form_incomplete = 0;
    end if;

    select susp_ca_loc, susp_ca_siz into lcl_susp_ca_loc, lcl_susp_ca_siz from colo where event_id = in_event_id;

    select 1+max(path_report_id) into lcl_path_report_id from path_report;

    insert into public.path_report (
        path_report_id,
        event_id,
        person_id,
        date_of_birth,
        gender_calcd,
        endoscopist_id,
        no_q_form,
        q_form_incomplete,
        procedure_type)
    values (
        lcl_path_report_id,
        in_event_id,
        lcl_person_id,
        lcl_date_of_birth,
        lcl_gender_calcd,
        lcl_endo_code,
        lcl_no_q,
        lcl_q_form_incomplete,
        'Colonoscopy');

    if  (lcl_p_loc_a != '' and lcl_p_loc_a != '99' and  lcl_p_siz_a != '' and lcl_p_siz_a != '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_a, 'A',1,0,cast(lcl_p_flat_a as integer)) ;
    end if;
    if  (lcl_p_loc_b != '' and lcl_p_loc_b != '99' and  lcl_p_siz_b != '' and lcl_p_siz_b != '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_b, 'B',1,0,cast(lcl_p_flat_b as integer)) ;
    end if;
    if  (lcl_p_loc_a != '' and lcl_p_loc_c != '99' and  lcl_p_siz_c != '' and lcl_p_siz_c != '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_c, 'C',1,0,cast(lcl_p_flat_c as integer)) ;
    end if;
    if  (lcl_p_loc_d!= '' and lcl_p_loc_d!= '99' and  lcl_p_siz_d!= '' and lcl_p_siz_d!= '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_d, 'D',1,0,cast(lcl_p_flat_d as integer)) ;
    end if;
    if  (lcl_p_loc_e!= '' and lcl_p_loc_e!= '99' and  lcl_p_siz_e!= '' and lcl_p_siz_e!= '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_e, 'E',1,0,cast(lcl_p_flat_e as integer)) ;
    end if;
    if  (lcl_p_loc_f!= '' and lcl_p_loc_f!= '99' and  lcl_p_siz_f!= '' and lcl_p_siz_f!= '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_f, 'F',1,0,cast(lcl_p_flat_f as integer)) ;
    end if;
    if  (lcl_p_loc_g!= '' and lcl_p_loc_g!= '99' and  lcl_p_siz_g!= '' and lcl_p_siz_g!= '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump,flat_polyp)
                values (lcl_path_report_id,'Polyp',lcl_p_loc_g, 'G',1,0,cast(lcl_p_flat_g as integer)) ;
    end if;


    if  (lcl_susp_ca_loc != '' and lcl_susp_ca_loc != '99' and  lcl_susp_ca_siz != '' and lcl_susp_ca_siz != '99') then 
        insert into specimen (path_report_id,specimen_type,path_polyp_loc,polyp_num,flg_no_discrep,flg_assump)
                values (lcl_path_report_id,'Suspected Cancer',lcl_susp_ca_loc, 'A',1,0) ;
    end if;

    select 'New Path ID - ' || lcl_path_report_id into lcl_message;

    return query select 
        lcl_path_report_id, lcl_message;


end;
$BODY$
language plpgsql
security definer;
grant execute on function public.create_path_report(integer) to NHCR2_rc; 