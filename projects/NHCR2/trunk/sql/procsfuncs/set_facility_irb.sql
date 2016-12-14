create or replace function set_facility_irb(
    in in_facility_id character varying,
    in in_irb_of_record character varying,
    in in_irb_review_date character varying,
    in in_irb_consent_form character varying,
    in in_irb_active_consent_version character varying,
    in in_irb_approval_date character varying,
    in in_irb_expiration_date character varying,
    in in_irb_contact_name character varying,
    in in_irb_contact_phone character varying,
    in in_irb_contact_email character varying
)
returns table (
    lcl_facility_id character varying, 
    lcl_message character varying) AS
$BODY$
    declare lcl_irb_review_date date;
    declare lcl_irb_approval_date date;
    declare lcl_irb_expiration_date date;

begin

    if (in_irb_review_date = '') then
        lcl_irb_review_date = null;
    else
        lcl_irb_review_date = cast (in_irb_review_date as date);
    end if;

    if (in_irb_approval_date = '') then
        lcl_irb_approval_date = null;
    else
        lcl_irb_approval_date = cast (in_irb_approval_date as date);
    end if;

    if (in_irb_expiration_date = '') then
        lcl_irb_expiration_date = null;
    else
        lcl_irb_expiration_date = cast (in_irb_expiration_date as date);
    end if;

    if exists(select * from facility where facility_id = in_facility_id) then
        update facility set 
            irb_of_record = in_irb_of_record,
            irb_review_date = lcl_irb_review_date,
            irb_consent_form = in_irb_consent_form,
            irb_active_consent_version = in_irb_active_consent_version,
            irb_approval_date = lcl_irb_approval_date,
            irb_expiration_date = lcl_irb_expiration_date,
            irb_contact_name = in_irb_contact_name,
            irb_contact_phone = in_irb_contact_phone,
            irb_contact_email = in_irb_contact_email
            where facility_id = in_facility_id;
    else 
        insert into facility (
        facility_id,
        irb_of_record,
        irb_review_date,
        irb_consent_form,
        irb_active_consent_version,
        irb_approval_date,
        irb_expiration_date,
        irb_contact_name,
        irb_contact_phone,
        irb_contact_email
        )
        values (
        in_facility_id,
        in_irb_of_record,
        lcl_irb_review_date,
        in_irb_consent_form,
        in_irb_active_consent_version,
        lcl_irb_approval_date,
        lcl_irb_expiration_date,
        in_irb_contact_name,
        in_irb_contact_phone,
        in_irb_contact_email
        );
    end if;

    select in_facility_id into lcl_facility_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_facility_id, lcl_message;
end;
$BODY$
language plpgsql
