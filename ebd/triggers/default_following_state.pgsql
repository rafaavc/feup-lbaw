-- The default value for the following state depends on the member's visibility

CREATE OR REPLACE FUNCTION default_following_state() RETURNS TRIGGER AS $$
DECLARE
    member_visibility boolean := (SELECT visibility FROM tb_member WHERE id = NEW.id_followed);
BEGIN
    IF NEW.state IS NULL THEN
        IF member_visibility = TRUE THEN
            NEW.state := 'accepted';
        ELSE
            NEW.state := 'pending';
        END IF; 
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS default_following_state_tg ON tb_following;
CREATE TRIGGER default_following_state_tg
BEFORE INSERT OR UPDATE ON tb_following
FOR EACH ROW
EXECUTE PROCEDURE default_following_state();