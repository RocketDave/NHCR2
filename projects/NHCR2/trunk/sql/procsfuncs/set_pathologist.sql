create or replace function set_pathologist(
    in in_pathologist_id character varying,
    in in_pathologist_code character varying,
    in in_first_name character varying,
    in in_middle_name character varying,
    in in_last_name character varying,
    in in_suffix character varying,
    in in_degree character varying,
    in in_salutation character varying,
    in in_comments character varying


)
returns table (
    lcl_pathologist_id character varying, 
    lcl_message character varying) AS
$BODY$
    declare lcl_irb_review_date date;
    declare lcl_irb_approval_date date;
    declare lcl_irb_expiration_date date;

begin

    if exists(select * from pathologist where pathologist_id = in_pathologist_id) then
        update pathologist set 
            pathologist_id = in_pathologist_id,
            pathologist_code = in_pathologist_code,
            first_name = in_first_name,
            middle_name = in_middle_name,
            last_name = in_last_name,
            suffix = in_suffix,
            degree = in_degree,
            salutation = in_salutation,
            comments = in_comments
        where pathologist_id = in_pathologist_id;
    else 
        insert into pathologist (
            pathologist_id,
            pathologist_code,
            first_name,
            middle_name,
            last_name,
            suffix,
            degree,
            salutation,
            comments
        )
        values (
            in_pathologist_id,
            in_pathologist_code,
            in_first_name,
            in_middle_name,
            in_last_name,
            in_suffix,
            in_degree,
            in_salutation,
            in_comments
        );
    end if;

    select in_pathologist_id into lcl_pathologist_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_pathologist_id, lcl_message;
end;
$BODY$
language plpgsql
