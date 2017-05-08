create view vpathrequests as select 
    path_request.path_request_id, path_request.event_id,
    to_char(path_request.print_date::timestamp with time zone, 'yyyy-mm-dd'::text) AS print_date, 
    to_char(path_request.recvd_date::timestamp with time zone, 'yyyy-mm-dd'::text) AS recvd_date
    from path_request;

GRANT ALL ON TABLE vpathrequests TO nhcr2_rc;
