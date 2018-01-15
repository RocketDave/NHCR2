CREATE OR REPLACE VIEW vperson_p AS 
 SELECT person.person_id,
    person.action_on,
    person.action_by,
    person.inserted_on,
    person.inserted_by,
    person.ssn,
    person.first_name,
    person.middle_name,
    person.last_name,
    person.suffix,
    person.address1,
    person.address2,
    person.city,
    person.state,
    person.zip,
    person.dob,
    person.deceased,
    to_char(person.deceased_date::timestamp with time zone, 'mm/dd/yyyy'::text) AS deceased_date,
    person.refused,
    to_char(person.refused_date::timestamp with time zone, 'mm/dd/yyyy'::text) AS refused_date,
    person.gender_calcd,
    person.source_gender_calcd,
    person.sex_male,
    person.bad_address,
    to_char(person.bad_address_date::timestamp with time zone, 'mm/dd/yyyy'::text) AS bad_address_date,
    person.sex_female,
    person.comments
   FROM person;

ALTER TABLE vperson_p
  OWNER TO informatics;
GRANT ALL ON TABLE vperson_p TO informatics;
GRANT SELECT ON TABLE vperson_p TO nhcr2_rc;
