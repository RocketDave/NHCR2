create function insert_pathlab_pathologist (in in_lab_code character varying, in in_pathologist_code character varying)
returns void as 
$BODY$
begin
    if not exists (select * from pathlab_pathologist where pathlab_code = in_lab_code and pathologist_code = in_pathologist_code) then
        insert into pathlab_pathologist (pathlab_code, pathologist_code) values (in_lab_code,in_pathologist_code);
    end if;
end;
$BODY$
language plpgsql