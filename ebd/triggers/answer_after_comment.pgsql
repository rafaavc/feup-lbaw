-- The date of an answer must be after the comment's creation date

CREATE OR REPLACE FUNCTION answer_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    original_comment_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.father_comment);
    answer_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.id_comment);
BEGIN
    IF answer_time < original_comment_time THEN
        RAISE EXCEPTION 'The date/time of an answer must be after the original comment''s creation date. Comment id = (%), answer id = (%)', NEW.father_comment, NEW.id_comment;
    END IF; 
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS answer_date_precedence_tg ON tb_answer;
CREATE TRIGGER answer_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_answer
FOR EACH ROW
EXECUTE PROCEDURE answer_date_precedence();