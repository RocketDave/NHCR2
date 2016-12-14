CREATE OR REPLACE FUNCTION get_indication_site(
    IN in_facility_id character varying,
    IN in_end_dt date)
  RETURNS TABLE(indication character varying, total bigint) AS
$BODY$
declare lcl_facility_id varchar;
begin

    select facility_id into lcl_facility_id from facility where facility_pseudo_name = in_facility_id;

    return query select indication_calculated,count(*) as total  from Findings where completed = 1 and
            facility_id = lcl_facility_id and exam_date <= in_end_dt group by indication_calculated  
            order by 2 desc;
end;
$BODY$
LANGUAGE plpgsql 
