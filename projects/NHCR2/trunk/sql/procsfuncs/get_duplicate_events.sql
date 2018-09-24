insert into dup_events select * from (select event_id,person_id,event_date,patient_barcode,endo_barcode from event where patient_barcode is null order by person_id) as no_patient join
(select event_id as event_id2,person_id as person_id2,event_date as event_date2,patient_barcode as patient_barcode2,endo_barcode as endo_barcode2 from event where endo_barcode is null order by person_id2) as no_endo 
on no_patient.person_id = no_endo.person_id2 and  no_patient.event_date = no_endo.event_date2 