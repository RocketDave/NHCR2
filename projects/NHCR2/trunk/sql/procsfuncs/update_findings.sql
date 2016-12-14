create function update_findings()
returns void as 
$BODY$
begin

update findings set proximal_serrated = get_proximal_serrated(event_id);

update findings set clinically_serrated = get_clinically_serrated(event_id);

update findings set adenoma_detected = get_adenoma_detected(event_id);

update findings set indication_calculated = get_indication(colo_id);

update findings set screening = 1 where indication_calculated = 'Screening';
update findings set surveillance = 1 where indication_calculated = 'Surveillance';
update findings set diagnostic = 1 where indication_calculated = 'Diagnostic';

update findings set eligible = get_eligible(colo_id);

end;
$BODY$
language plpgsql;