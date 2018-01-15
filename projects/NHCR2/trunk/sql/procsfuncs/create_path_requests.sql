create or replace function public.create_path_requests(
)
returns table (
    lcl_message varchar) AS
$BODY$

    declare lcl_new_recs integer;

begin
    insert into path_request (event_id,med_rec_num,print_date) select e.event_id,medical_record_number,current_date from 
        colo c join event e on c.event_id = e.event_id join person p on e.person_id = p.person_id where
        (find_oth_bmc = 1 or find_oth_biop = 1 or find_oth_ibd = 1 or
        computed_normal_exam=0 or computed_plp_trtmnt=1 or computed_fnd_siz=1 or computed_susp_ca_loc=1
        or computed_susp_ca_siz=1 or computed_susp_ca_trtmnt=1 or computed_susp_crohn=1 or computed_susp_uc=1) and
        p.refused_date is null and (pth_req_id = 0 or pth_req_id is null) and event_date > '12/31/2009'; --changed from 3/20/2009 (JH 11/20/2017)

    update colo set pth_req_id = p.path_request_id from path_request p where colo.event_id = p.event_id and p.print_date = current_date; 

    select count(*) into lcl_new_recs from path_request where print_date = current_date;

    select lcl_new_recs || ' new path requests' into lcl_message;

    return query select lcl_message;

end;
$BODY$
language plpgsql