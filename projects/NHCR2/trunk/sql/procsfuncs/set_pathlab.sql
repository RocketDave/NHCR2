create or replace function set_pathlab(
    in in_path_lab_id integer,
    in in_lab_code varchar,
    in in_lab_name varchar,
    in in_address1 varchar,
    in in_address2 varchar,
    in in_city varchar,
    in in_state varchar,
    in in_zip varchar,
    in in_fax varchar,
    in in_status varchar,
    in in_status_date varchar,
    in in_comments varchar,
    in in_contact1_name varchar,
    in in_contact1_phone varchar,
    in in_contact1_email varchar,
    in in_contact1_type varchar,
    in in_contact2_name varchar,
    in in_contact2_phone varchar,
    in in_contact2_email varchar,
    in in_contact2_type varchar
)
returns table (
    lcl_path_lab_id varchar, 
    lcl_message varchar) AS
$BODY$
    declare lcl_status_date date;
begin

    if (in_status_date = '') then
        lcl_status_date = null;
    else
        lcl_status_date = cast (in_status_date as date);
    end if;

    if exists(select * from path_lab where path_lab_id = in_path_lab_id) then
        update path_lab set 
        lab_code = in_lab_code,
        lab_name = in_lab_name,
        address1 = in_address1,
        address2 = in_address2,
        city = in_city,
        state = in_state,
        zip = in_zip,
        fax = in_fax,
        status = in_status,
        status_date = lcl_status_date,
        comments = in_comments,
        contact1_name = in_contact1_name,
        contact1_phone = in_contact1_phone,
        contact1_email = in_contact1_email,
        contact1_type = in_contact1_type,
        contact2_name = in_contact2_name,
        contact2_phone = in_contact2_phone,
        contact2_email = in_contact2_email,
        contact2_type = in_contact2_type
            where path_lab_id = in_path_lab_id;
    else 
        insert into path_lab (
        lab_code,
        lab_name,
        address1,
        address2,
        city,
        state,
        zip,
        fax,
        status,
        status_date,
        comments,
        contact1_name,
        contact1_phone,
        contact1_email,
        contact1_type,
        contact2_name,
        contact2_phone,
        contact2_email,
        contact2_type
        )
        values (
        in_lab_code,
        in_lab_name,
        in_address1,
        in_address2,
        in_city,
        in_state,
        in_zip,
        in_fax,
        in_status,
        lcl_status_date,
        in_comments,
        in_contact1_name,
        in_contact1_phone,
        in_contact1_email,
        in_contact1_type,
        in_contact2_name,
        in_contact2_phone,
        in_contact2_email,
        in_contact2_type
        );
    end if;

    if (in_path_lab_id = -9) then
        select  currval('path_lab_path_lab_id_seq') into lcl_path_lab_id;
    else
        lcl_path_lab_id = in_path_lab_id;
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        lcl_path_lab_id, lcl_message;
end;
$BODY$
language plpgsql
