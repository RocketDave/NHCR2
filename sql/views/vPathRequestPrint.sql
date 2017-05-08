create view public.vPathRequestPrint as select 
    print_date,med_rec_num,pr.last_name,pr.first_name,pr.middle_name,pr.dob,exam_date, pth_consent_form_reqd, facility_name
    from path_request p join event e on p.event_id = e.event_id join 
        colo c on c.event_id = e.event_id join 
        person pr on e.person_id = pr.person_id join 
        batch b on e.batch_id = b.batch_id join 
        facility f on b.facility_id = f.facility_id;
grant select on public.vPathRequestPrint to nhcr2_rc;