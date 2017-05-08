create or replace function public.set_pathologist(
    in in_pathologist_id integer,
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
    lcl_pathologist_id integer, 
    lcl_message character varying) AS
$BODY$

begin

    if exists (select * from pathologist where pathologist_code = in_pathologist_code and pathologist_id != in_pathologist_id) then
        select 'That code has already been used' into lcl_message;
    elseif exists(select * from pathologist where pathologist_id = in_pathologist_id) then
        update pathologist set 
            pathologist_code = in_pathologist_code,
            first_name = initcap(lower(in_first_name)),
            middle_name = initcap(lower(in_middle_name)),
            last_name = initcap(lower(in_last_name)),
            suffix = initcap(lower(in_suffix)),
            degree = upper(in_degree),
            salutation = initcap(lower(in_salutation)),
            comments = in_comments
        where pathologist_id = in_pathologist_id;
        select 'Record Updated' into lcl_message; 
    else 
        insert into pathologist (
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
            in_pathologist_code,
            initcap(lower(in_first_name)),
            initcap(lower(in_middle_name)),
            initcap(lower(in_last_name)),
            initcap(lower(in_suffix)),
            upper(in_degree),
            initcap(lower(in_salutation)),
            in_comments
        );
        select 'Record Updated' into lcl_message;
    end if;

    if (in_pathologist_id = -9) then
        select currval('pathologist_pathologist_id_seq') into lcl_pathologist_id;
    else
        lcl_pathologist_id = in_pathologist_id;
    end if;

    return query 
        select lcl_pathologist_id, lcl_message;
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_pathologist(integer, varchar, varchar, varchar, varchar, varchar, varchar, varchar, varchar) to nhcr2_rc, nhcr2_staff; 


