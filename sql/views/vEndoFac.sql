create view vEndoFac as select 
     endoscopist_id,
     f.facility_id,
     endo_last_name,
     facility_name,
     mail_name,
     endo_initials,
     endo_status 
     from endo_fac ef join endoscopist on endo_code = endoscopist_id  join
     facility f on ef.facility_id = f.facility_id;
grant select on vEndoFac to NHCR2_rc;