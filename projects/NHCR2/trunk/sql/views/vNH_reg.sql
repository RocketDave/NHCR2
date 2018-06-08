create view vNH_reg as select 
person_id,
refused,
refused_date,
SSN,
get_valid_ssn(person_id) as valid_ssn,
last_name,
first_name,
initcap(middle_name) as middle_name,
address1,
address2,
city,
state,
zip,
dob,
deceased,
deceased_date,
gender_calcd,
source_gender_calcd
from person order by person_id;
grant select on vNH_reg to NHCR2_data
