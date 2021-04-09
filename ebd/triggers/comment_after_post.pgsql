-- The date of a review/comment/answer must be after the post's creation date

CREATE OR REPLACE FUNCTION comment_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    recipe_time timestamptz := (SELECT creation_time FROM tb_recipe WHERE id = NEW.id_recipe);
BEGIN
    IF NEW.post_time IS NOT NULL AND NEW.post_time < recipe_time THEN
        RAISE EXCEPTION 'The date/time of a comment/review must be after the recipe''s creation date. Comment id = (%)', NEW.id;
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_date_precedence_tg ON tb_comment;
CREATE TRIGGER comment_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE comment_date_precedence();