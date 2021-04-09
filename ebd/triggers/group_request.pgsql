DROP FUNCTION IF EXISTS group_request() CASCADE;
CREATE FUNCTION group_request() RETURNS TRIGGER AS
$BODY$
DECLARE
    group_visibility boolean := (SELECT visibility FROM tb_group WHERE id = NEW.id_group);
BEGIN
    IF group_visibility = TRUE THEN
        NEW.state := 'accepted';
    ELSE
        NEW.state := 'pending';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS group_request ON tb_group_request;
CREATE TRIGGER group_request
    BEFORE INSERT OR UPDATE ON tb_group_request
    FOR EACH ROW
    EXECUTE PROCEDURE group_request();