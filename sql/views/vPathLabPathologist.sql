create view vPathLabPathologist as select 
     p.pathologist_code,
     pl.lab_code,
     lab_name,
     p.last_name || ', ' || p.first_name as pathologist_name
     from pathlab_pathologist pp join pathologist p on p.pathologist_code = pp.pathologist_code  join
     path_lab pl on pp.pathlab_code = pl.lab_code order by pathologist_name;
grant select on vPathLabPathologist to NHCR2_rc;