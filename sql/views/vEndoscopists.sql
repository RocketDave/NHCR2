create view vEndoscopists as select 
     endoscopist_id,
     mail_name,
     endo_initials,
     endo_status 
     from endo_fac join endoscopist on endo_code = endoscopist_id  
     order by endo_last_name;
grant select on vEndoscopists to NHCR2_rc;