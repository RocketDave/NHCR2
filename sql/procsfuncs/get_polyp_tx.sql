create function public.get_polyp_tx (
    in in_pt_cb integer,
    in in_pt_hb integer,
    in in_pt_hs integer,
    in in_pt_cs integer,
    in in_pt_pme integer,
    in in_pt_pe integer,
    in in_pt_nr integer,
    in in_pt_lo integer,
    in in_pt_o integer)
returns varchar as
$BODY$
declare
    in_tx varchar;
begin
    select '' into in_tx;

    if in_pt_cb = 1 then 
        in_tx = 'CB';
    end if;

    if in_pt_hb = 1 then 
        in_tx =  in_tx || ',HB';
    end if;

    if in_pt_hs = 1 then 
        in_tx =  in_tx || ',HS';
    end if;

        if in_pt_cs = 1 then 
        in_tx =  in_tx || ',CS';
    end if;

        if in_pt_pme = 1 then 
        in_tx =  in_tx || ',PME';
    end if;

        if in_pt_pe = 1 then 
        in_tx =  in_tx || ',PE';
    end if;

        if in_pt_nr = 1 then 
        in_tx =  in_tx || ',NR';
    end if;

        if in_pt_lo = 1 then 
        in_tx =  in_tx || ',LO';
    end if;

        if in_pt_o = 1 then 
        in_tx =  in_tx || ',O';
    end if;

    if (substr(in_tx,1,1) = ',') then
        in_tx = substr(in_tx,2);
    end if;

    return in_tx;
end;
$BODY$
language plpgsql;
