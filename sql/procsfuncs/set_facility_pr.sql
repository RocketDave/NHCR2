create or replace function set_facility_pr(
    in in_facility_id character varying,
    in in_pth_reports_contact_name character varying,
    in in_pth_reports_contact_phone character varying,
    in in_pth_reports_contact_email character varying,
    in in_pth_consent_form_reqd integer,
    in in_pth_req_required integer,
    in in_pth_req_sort_col character varying,
    in in_pth_req_instructions character varying 
)
returns table (
    lcl_facility_id character varying, 
    lcl_message character varying) AS
$BODY$


begin

    if exists(select * from facility where facility_id = in_facility_id) then
        update facility set
            pth_reports_contact_name =  in_pth_reports_contact_name,
            pth_reports_contact_phone = in_pth_reports_contact_phone,
            pth_reports_contact_email = in_pth_reports_contact_email,
            pth_consent_form_reqd = in_pth_consent_form_reqd,
            pth_req_required = in_pth_req_required,
            pth_req_sort_col = in_pth_req_sort_col,
            pth_req_instructions = in_pth_req_instructions 
        where facility_id = in_facility_id;
    end if;

    select in_facility_id into lcl_facility_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_facility_id, lcl_message;
end;
$BODY$
language plpgsql
