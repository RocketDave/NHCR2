--need this because Stat transfer does not see materialized viuews
create view vExport_may2018_e as select * from mvExport_may2018_e;