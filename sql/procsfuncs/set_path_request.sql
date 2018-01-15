create or replace function set_path_request(
    in_path_request_id integer,
    in_n_a_reason character varying,
    in_no_path_report integer,
    in_recvd_date character varying,
    in_notes character varying)
returns table (
    lcl_path_request_id integer, 
    lcl_message character varying) AS
$BODY$

begin


    if exists(select * from path_request where path_request_id = in_path_request_id) then
        update path_request set 
            n_a_reason = in_n_a_reason,
            no_path_report = in_no_path_report,
            recvd_date = safe_cast (in_recvd_date,null::date),
            notes = in_notes
        where path_request_id = in_path_request_id;
    else insert into path_request (
            n_a_reason,
            no_path_report,
            recvd_date,
            notes
        )
    values (
            in_n_a_reason,
            in_no_path_report,
            in_recvd_date,
            in_notes);
    end if;

    if (in_path_request_id = -9) then
        select currval('path_request_path_request_id_seq') into lcl_path_request_id;
    else
        lcl_path_request_id = in_path_request_id;
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        in_path_request_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_path_request(integer, character varying, integer, character varying, character varying) to NHCR2_rc; 
