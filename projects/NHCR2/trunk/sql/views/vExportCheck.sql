create view vExportCheck as select
s.specimen_id,
c.event_id as c_event_id,
s.event_id as s_event_id,
e.event_id as e_event_id,

from event e
left outer join SpecimenPolyp2 s on e.event_id = s.event_id
full join vColo c on s.event_id = c.event_id and s.specimen_type = 'Polyp' and s.polyp_num = c.old_polyp_id 
where (refused = 0 or refused is null) and (fu_teleform_formid = '16475' or fu_teleform_formid is null);