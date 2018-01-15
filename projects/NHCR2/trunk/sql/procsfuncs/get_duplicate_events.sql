select * from (select event_id,person_id,event_date,endo_barcode,patient_barcode from event where patient_barcode is null order by person_id) as no_patient join
(select event_id,person_id,event_date,endo_barcode,patient_barcode from event where endo_barcode is null order by person_id) as no_endo 
on no_patient.person_id = no_endo.person_id and  no_patient.event_date = no_endo.event_date 