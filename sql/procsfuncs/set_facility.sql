create or replace function set_facility(
    in in_facility_id character varying,
    in in_facility_name character varying,
    in in_facility_pseudo_name character varying,
    in in_address1 character varying,
    in in_address2 character varying,
    in in_address3 character varying,
    in in_city character varying,
    in in_state character varying,
    in in_zip character varying,
    in in_fax character varying,
    in in_status character varying,
    in in_status_date character varying,
    in in_implementation_date character varying,
    in in_how_write_reports character varying,
    in in_ctc integer,
    in in_comments character varying,
    in in_contact1_name character varying,
    in in_contact1_phone character varying,
    in in_contact1_email character varying,
    in in_contact1_type character varying,
    in in_contact2_name character varying,
    in in_contact2_phone character varying,
    in in_contact2_email character varying,
    in in_contact2_type character varying,
    in in_contact3_name character varying,
    in in_contact3_phone character varying,
    in in_contact3_email character varying,
    in in_contact3_type character varying,
    in in_facility_type character varying
)
returns table (
    lcl_facility_id character varying, 
    lcl_message character varying) AS
$BODY$
    declare lcl_status_date date;
    declare lcl_implementation_date date;
begin

    if (in_status_date = '') then
        lcl_status_date = null;
    else
        lcl_status_date = cast (in_status_date as date);
    end if;

    if (in_implementation_date = '') then
        lcl_implementation_date = null;
    else
        lcl_implementation_date = cast (in_implementation_date as date);
    end if;

    if exists(select * from facility where facility_id = in_facility_id) then
        update facility set 
        facility_name = in_facility_name,
        facility_pseudo_name = in_facility_pseudo_name,
        address1 = in_address1,
        address2 = in_address2,
        address3 = in_address3,
        city = in_city,
        state = in_state,
        zip = in_zip,
        fax = in_fax,
        status = in_status,
        status_date = lcl_status_date,
        implementation_date = lcl_implementation_date,
        how_write_reports = in_how_write_reports,
        ctc = in_ctc,
        comments = in_comments,
        contact1_name = in_contact1_name,
        contact1_phone = in_contact1_phone,
        contact1_email = in_contact1_email,
        contact1_type = in_contact1_type,
        contact2_name = in_contact2_name,
        contact2_phone = in_contact2_phone,
        contact2_email = in_contact2_email,
        contact2_type = in_contact2_type,
        contact3_name = in_contact3_name,
        contact3_phone = in_contact3_phone,
        contact3_email = in_contact3_email,
        contact3_type = in_contact3_type,
        facility_type  = in_facility_type 
            where facility_id = in_facility_id;
    else 
        insert into facility (
        facility_id ,
        facility_name,
        facility_pseudo_name,
        address1,
        address2,
        address3,
        city,
        state,
        zip,
        fax,
        status,
        status_date,
        implementation_date,
        how_write_reports,
        ctc,
        comments,
        contact1_name,
        contact1_phone,
        contact1_email,
        contact1_type,
        contact2_name,
        contact2_phone,
        contact2_email,
        contact2_type,
        contact3_name,
        contact3_phone,
        contact3_email,
        contact3_type,
        facility_type
        )
        values (
        in_facility_id,
        in_facility_name,
        in_facility_pseudo_name,
        in_address1,
        in_address2,
        in_address3,
        in_city,
        in_state,
        in_zip,
        in_fax,
        in_status,
        lcl_status_date,
        lcl_implementation_date,
        in_how_write_reports,
        in_ctc,
        in_comments,
        in_contact1_name,
        in_contact1_phone,
        in_contact1_email,
        in_contact1_type,
        in_contact2_name,
        in_contact2_phone,
        in_contact2_email,
        in_contact2_type,
        in_contact3_name,
        in_contact3_phone,
        in_contact3_email,
        in_contact3_type,
        in_facility_type
        );
    end if;

    select in_facility_id into lcl_facility_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_facility_id, lcl_message;
end;
$BODY$
language plpgsql
