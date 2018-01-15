create or replace function set_endoscopist_e(
       in in_endoscopist_id integer,
       in in_endo_specialty character varying,
       in in_endo_med_grad_year character varying,
       in in_endo_fellowship character varying,
       in in_endo_fellow_grad_year character varying,
       in in_endo_fellow_discipline character varying,
       in in_year_first_colo character varying)
returns table (
    lcl_endoscopist_id integer, 
    lcl_message character varying) AS
$BODY$

begin

    if exists(select * from endoscopist where endoscopist_id = in_endoscopist_id) then
        update endoscopist set 
            endo_specialty = in_endo_specialty,
            endo_med_grad_year = in_endo_med_grad_year,
            endo_fellowship = cast(in_endo_fellowship as integer),
            endo_fellow_grad_year = in_endo_fellow_grad_year,
            endo_fellow_discipline = in_endo_fellow_discipline,
            year_first_colo = in_year_first_colo
        where endoscopist_id = in_endoscopist_id;
    else insert into endoscopist (
        endo_specialty,
        endo_med_grad_year,
        endo_fellowship,
        endo_fellow_grad_year,
        endo_fellow_discipline,
        year_first_colo
        )
    values (
        in_endo_specialty,
        in_endo_med_grad_year,
        cast (in_endo_fellowship as integer),
        in_endo_fellow_grad_year,
        in_endo_fellow_discipline,
        in_year_first_colo);
    end if;

    if (in_endoscopist_id = -9) then
        select currval('endoscopist_endoscopist_id_seq') into lcl_endoscopist_id;
    else
        lcl_endoscopist_id = in_endoscopist_id;
    end if;

    select 'Record Updated' into lcl_message;

    return query select 
        in_endoscopist_id, lcl_message;

end;
$BODY$
language plpgsql
security definer;
grant execute on function public.set_endoscopist_e(integer, character varying, character varying, character varying, character varying, character varying, character varying) to NHCR2_rc; 
