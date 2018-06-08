create or replace function set_other_name(
       in in_person_id integer,
       in in_last_name varchar,
       in in_maiden_flag integer)
returns table (
    lcl_other_name_id integer, 
    lcl_message varchar) as 
$BODY$

begin


    insert into other_name (
        person_id,
        last_name,
        maiden_flag
        )
    values (
        in_person_id,
        in_last_name,
        in_maiden_flag);

    select currval('other_name_other_name_id_seq') into lcl_other_name_id;
    select 'Record Updated' into lcl_message;

    return query select 
        lcl_other_name_id, lcl_message;
end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_other_name(integer, character varying, integer) to NHCR2_rc; 

