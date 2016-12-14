create view vFollow_up as select *
    from follow_up where fu_teleform_formid = '16475' or fu_teleform_formid is null;