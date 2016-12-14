CREATE OR REPLACE FUNCTION public.record_action()
RETURNS TRIGGER
AS $$
declare lcl_old varchar;
declare lcl_new varchar;
declare lcl_id varchar;

begin
    /**
     * If primary key consists of id and version and id_version sent in as in_pkey_definition when 
     * create_audit_objects called, this function will check that neither has been changed for the
     * given row.
     */

    SELECT kcu.column_name into lcl_id FROM INFORMATION_SCHEMA.TABLES t
         LEFT JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS tc
                 ON tc.table_catalog = t.table_catalog
                 AND tc.table_schema = t.table_schema
                 AND tc.table_name = t.table_name
                 AND tc.constraint_type = 'PRIMARY KEY'
         LEFT JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
                 ON kcu.table_catalog = tc.table_catalog
                 AND kcu.table_schema = tc.table_schema
                 AND kcu.table_name = tc.table_name
                 AND kcu.constraint_name = tc.constraint_name
        WHERE t.table_schema NOT IN ('pg_catalog', 'information_schema') and tc.table_name = TG_TABLE_NAME;

    EXECUTE format ('SELECT ($1).%I::text',lcl_id) USING NEW into lcl_new;
    EXECUTE format ('SELECT ($1).%I::text',lcl_id) USING OLD into lcl_old;

    IF (TG_OP = 'UPDATE') THEN
            IF (TG_NARGS > 0 and TG_ARGV[0] = lcl_id) or TG_NARGS = 0 THEN
                IF (lcl_new != lcl_old) THEN
                    RAISE EXCEPTION 'Cannot change primary key.';
                END IF;
            ELSIF (TG_NARGS > 0 and TG_ARGV[0] = 'id_version') THEN
                IF (NEW.id != OLD.id or NEW.version != OLD.version) THEN
                    RAISE EXCEPTION 'Cannot change primary key of id/version.';
                END IF;
            END IF;
    END IF;
    
    NEW.action_on = CURRENT_TIMESTAMP;
    NEW.action_by = SESSION_USER;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
