-- View: vpathreportsrch

-- DROP VIEW vpathreportsrch;

CREATE OR REPLACE VIEW vpathreportsrch AS 
 SELECT p.person_id,
    p.refused,
    e.event_date,
    e.event_id,
    e.event_type,
    e.medical_record_number,
    e.endo_code,
    p.last_name,
    p.first_name,
    p.middle_name,
    p.dob,
    p.gender_calcd,
    b.facility_id,
    f.facility_name
   FROM event e
     JOIN person p ON e.person_id = p.person_id
     LEFT JOIN batch b ON e.batch_id = b.batch_id
     LEFT JOIN facility f ON b.facility_id::text = f.facility_id::text;

ALTER TABLE vpathreportsrch
  OWNER TO informatics;
GRANT ALL ON TABLE vpathreportsrch TO informatics;
GRANT SELECT ON TABLE vpathreportsrch TO nhcr2_rc;

