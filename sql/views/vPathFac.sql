create view vPathFac as select 
     pathlab_facility_id,
     facility_id,
     p.lab_code,
     p.lab_name,
     p.status
     from pathlab_facility pf join path_lab p on pf.lab_code = p.lab_code  
     order by pathlab_facility_id;
grant select on vPathFac to NHCR2_rc;