create view vcombined_data as select
	e.event_id,
	e.person_id,
	e.event_type,
	e.event_date,
	e.batch_id,
	e.second_batch,
	e.inserted_on as e_inserted_on,
	e.action_on as e_action_on,
	pr.path_report_id,
	pr.inserted_on as pr_inserted_on,
	pr.action_on as pr_action_on,
	pr.path_report_complete,
	get_specimen_count(pr.path_report_id) as specimen_count,
	refusals_with_r,
	refusals_without_r,
	unsigned_with_r,
	unsigned_without_r,
	orphans,
	e.patient_barcode,
	e.endo_barcode,
	en.endoscopist_id,
	en.mail_name,
	p.dob,
	p.refused,
	p.refused_date,
	p.deceased,
	p.deceased_date,
	p.gender_calcd,
	s.hispanic,
	race_white,
	race_black,
	race_asian,
	race_pacisl,
	race_amind,
	race_oth,
	f.facility_id,
	f.facility_name,
	case when pr.event_id is not null then 'yes' else 'no' end as has_path,
	case when c.event_id is not null then 'yes' else 'no' end as has_colo,
	c.prep,
	c.comp_bleed,
	c.comp_cardio,
	c.comp_none,
	c.comp_oth,
	c.comp_perf,
	c.comp_resparr,
	c.indication_calculated,
	c.find_calc_polyp
	from event e left outer join person p on e.person_id = p.person_id 
	left outer join survey s on s.event_id = e.event_id
	left outer join colo c on e.event_id = c.event_id
	left outer join endoscopist en on e.endo_code = en.endoscopist_id
	left outer join batch b on e.batch_id = b.batch_id
	left outer join facility f on b.facility_id = f.facility_id
	left outer join path_report pr on e.event_id = pr.event_id
	order by e.person_id, e.event_date;
grant select on vcombined_data to nhcr2_data;

