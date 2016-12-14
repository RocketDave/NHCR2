create or replace function check_date(
    in in_date character varying
)
returns bool as
$BODY$
begin
  perform in_date::date;
  return true;
exception when others then
  return false;
end;
$BODY$
language plpgsql;