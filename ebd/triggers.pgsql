
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


-- The date of a review/comment/answer must be after the post's creation date


CREATE OR REPLACE FUNCTION comment_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    recipe_time timestamptz := (SELECT creation_time FROM tb_recipe WHERE id = NEW.id_recipe);
BEGIN
    IF NEW.post_time IS NOT NULL AND NEW.post_time < recipe_time THEN
        RAISE EXCEPTION 'The date/time of a comment/review must be after the recipe''s creation date.';
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_date_precedence_tg ON tb_comment;
CREATE TRIGGER comment_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE comment_date_precedence();
