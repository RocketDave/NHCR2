create view vpathrequests as select 
    path_request.path_request_id, path_request.event_id,
    print_date, 
    recvd_date
    from path_request;

GRANT ALL ON TABLE vpathrequests TO nhcr2_rc;
