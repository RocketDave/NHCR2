CREATE OR REPLACE FUNCTION get_indication_nhcr(
    IN in_start_dt date,
    IN in_end_dt date)
  RETURNS TABLE(indication character varying, total bigint) AS
$BODY$

begin
    return query select indication_calculated,count(*) as total  from Findings where completed = 1 and 
            exam_date >= in_start_dt and exam_date <= in_end_dt group by indication_calculated order by 2 desc;
end;
$BODY$
LANGUAGE plpgsql 
grant execute on set_endoscopist to NHCR2_rc; 