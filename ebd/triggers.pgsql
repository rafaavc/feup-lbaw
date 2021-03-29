
-- An user can only rate a recipe once

CREATE OR REPLACE FUNCTION single_rating() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.rating IS NOT NULL AND EXISTS (
            SELECT FROM tb_comment 
            WHERE id_recipe = NEW.id_recipe 
                AND id_member = NEW.id_member 
                AND rating IS NOT NULL 
                AND id != NEW.id   -- the id may be equal in case of update
    ) THEN
        RAISE EXCEPTION 'A user can only rate a recipe once.';
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS single_rating_tg ON tb_comment;
CREATE TRIGGER single_rating_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE single_rating();

