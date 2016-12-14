create or replace function set_pathlab(
    in in_pathlab_id character varying,
    in in_pathlab_name character varying,
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
    in in_pathlab_type character varying
)
returns table (
    lcl_pathlab_id character varying, 
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

    if exists(select * from pathlab where pathlab_id = in_pathlab_id) then
        update pathlab set 
        pathlab_name = in_pathlab_name,
        pathlab_pseudo_name = in_pathlab_pseudo_name,
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
        pathlab_type  = in_pathlab_type 
            where pathlab_id = in_pathlab_id;
    else 
        insert into pathlab (
        pathlab_id ,
        pathlab_name,
        pathlab_pseudo_name,
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
        pathlab_type
        )
        values (
        in_pathlab_id,
        in_pathlab_name,
        in_pathlab_pseudo_name,
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
        in_pathlab_type
        );
    end if;

    select in_pathlab_id into lcl_pathlab_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_pathlab_id, lcl_message;
end;
$BODY$
language plpgsql
