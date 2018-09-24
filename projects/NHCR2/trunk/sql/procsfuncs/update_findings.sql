create or replace function public.update_findings()
returns table (
    lcl_message varchar) AS
$BODY$
begin

perform initialize_findings();

update findings set proximal_serrated = get_proximal_serrated(event_id);

update findings set clinically_serrated = get_clinically_serrated(event_id);

update findings set adenoma_detected = get_adenoma_detected(event_id);

--update findings set indication_calculated = get_indication(colo_id); is now calculated in data import

update findings set screening = 1 where indication_calculated = 'Screening';
update findings set surveillance = 1 where indication_calculated = 'Surveillance';
update findings set diagnostic = 1 where indication_calculated = 'Diagnostic';

update findings set eligible = get_eligible(colo_id);


lcl_message = 'FINDINGS table has been updated';
return query select lcl_message;
end;
$BODY$
language plpgsql;

GRANT EXECUTE ON FUNCTION public.update_findings() TO nhcr2_rc;