-- Function: record_action()

-- DROP FUNCTION record_action();

CREATE OR REPLACE FUNCTION record_action()
  RETURNS trigger AS
$BODY$
declare lcl_new integer;
declare lcl_old integer;
begin
    /**
     * If primary key consists of id and version and id_version sent in as in_pkey_definition when 
     * create_audit_objects called, this function will check that neither has been changed for the
     * given row.
     */

    IF (TG_OP = 'UPDATE') THEN
            IF (TG_NARGS > 0 and TG_ARGV[0] = 'id_version') THEN
                IF (NEW.id != OLD.id or NEW.version != OLD.version) THEN
                    RAISE EXCEPTION 'Cannot change primary key of id/version.';
                END IF;
            ELSEIF (TG_NARGS > 0) THEN
                EXECUTE 'SELECT ($1).' || TG_ARGV[0] INTO lcl_new USING NEW;
                EXECUTE 'SELECT ($1).' || TG_ARGV[0] INTO lcl_old USING OLD;
                IF (lcl_old != lcl_new) THEN
                    RAISE EXCEPTION 'Cannot change primary key.';
                END IF;
            END IF;
    END IF;

    NEW.action_on = CURRENT_TIMESTAMP;
    NEW.action_by = SESSION_USER;

    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION record_action()
  OWNER TO informatics;
