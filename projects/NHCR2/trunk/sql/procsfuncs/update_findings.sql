update findings set proximal_serrated = get_proximal_serrated(event_id) where id < 50000;
update findings set proximal_serrated = get_proximal_serrated(event_id) where id >= 50000;

update findings set clinically_serrated = get_clinically_serrated(event_id) where id < 50000;
update findings set clinically_serrated = get_clinically_serrated(event_id) where id >= 50000;

update findings set adenoma_detected = get_adenoma_detected(event_id) where id < 50000;
update findings set adenoma_detected = get_adenoma_detected(event_id) where id >= 50000;

update findings set mydx = get_indication(colo_id) where id < 50000;
update findings set mydx = get_indication(colo_id) where id >= 50000;

update findings set screening = get_screening(colo_id) where id < 50000;
update findings set screening = get_screening(colo_id) where id >= 50000;

update findings set surveillance = get_surveillance(colo_id) where id < 50000;
update findings set surveillance = get_surveillance(colo_id) where id >= 50000;

update findings set diagnostic = get_diagnostic(colo_id) where id < 50000;
update findings set diagnostic = get_diagnostic(colo_id) where id >= 50000;

update findings set eligible = get_eligible(colo_id) where id < 50000;
update findings set eligible = get_eligible(colo_id) where id >= 50000;
