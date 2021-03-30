
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


-- default group request state

CREATE OR REPLACE FUNCTION default_group_request_state() RETURNS TRIGGER AS $$
DECLARE
    group_visibility boolean := (SELECT visibility FROM tb_group WHERE id = NEW.id_group);
BEGIN
    IF NEW.state IS NULL THEN
        IF group_visibility = TRUE THEN
            NEW.state := 'accepted';
        ELSE
            NEW.state := 'pending';
        END IF; 
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS default_group_request_state_tg ON tb_group_request;
CREATE TRIGGER default_group_request_state_tg
BEFORE INSERT OR UPDATE ON tb_group_request
FOR EACH ROW
EXECUTE PROCEDURE default_group_request_state();
