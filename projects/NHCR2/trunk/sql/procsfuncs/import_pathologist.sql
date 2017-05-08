create function import_pathologist()
returns void as 
$BODY$
begin
    insert into pathologist (
        pathologist_id,
        action_on,
        action_by,
        inserted_on,
        inserted_by,
        first_name,
        last_name ,
        pathologist_code,
        comments,
        salutation ,
        middle_name,
        suffix,
        degree)
    select
        pathologist_id,
        mod_rec_date,
        mod_rec_user,
        new_rec_date,
        new_rec_user,
        first_name,
        last_name ,
        pathologist_code,
        note,
        salutation ,
        middle_name,
        suffix,
        degree
    from 
        pathologist_import
    order by pathologist_id;
    perform setval('pathologist_pathologist_id_seq', (select max(pathologist_id) from pathologist));
end;
$BODY$
language plpgsql;