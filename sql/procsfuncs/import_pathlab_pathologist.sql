create function import_pathlab_pathologist()
returns void as 
$BODY$
begin
    insert into pathlab_pathologist(
    record_comment,
    pathlab_code,
    pathologist_code)
    select
    'import from 4D',
    path_lab_code,
    pathologist_code
    from 
        pathlab_pathologist_import
    order by path_lab_code;
end;
$BODY$
language plpgsql;