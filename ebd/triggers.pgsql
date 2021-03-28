-- 2 - Recipe score

ALTER TABLE tb_recipe
ADD COLUMN num_rating integer DEFAULT 0;

DROP FUNCTION IF EXISTS score_recipe_insertOrUpdate() CASCADE;
CREATE FUNCTION score_recipe_insertOrUpdate() RETURNS TRIGGER AS $$
DECLARE
    totalScore real := NEW.score / NEW.num_rating;
BEGIN
    IF TG_OP = 'INSERT' THEN
        UPDATE tb_recipe 
        SET num_rating = num_rating + 1, score = (totalScore + NEW.rating) / (num_rating + 1)
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN NEW;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        UPDATE tb_recipe 
        SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
        -- SET score = score + (NEW.rating - OLD.rating)
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN NEW;
    END IF;
    IF TG_OP = 'DELETE' THEN
        UPDATE tb_recipe
        SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / (num_rating - 1)
        -- SET num_rating = num_rating - 1, score = score - OLD.rating
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN OLD;
    END IF;
        
    RETURN NULL; -- Result is ignored.
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_insertOrUpdate_tg ON tb_recipe;
CREATE TRIGGER score_recipe_insertOrUpdate_tg
AFTER INSERT OR UPDATE ON tb_comment
FOR EACH ROW
WHEN (NEW.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_insertOrUpdate();

DROP FUNCTION IF EXISTS score_recipe_delete() CASCADE;
CREATE FUNCTION score_recipe_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real := NEW.score / NEW.num_rating;
BEGIN
    IF TG_OP = 'INSERT' THEN
        UPDATE tb_recipe 
        SET num_rating = num_rating + 1, score = (totalScore + NEW.rating) / (num_rating + 1)
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN NEW;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        UPDATE tb_recipe 
        SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
        -- SET score = score + (NEW.rating - OLD.rating)
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN NEW;
    END IF;
    IF TG_OP = 'DELETE' THEN
        UPDATE tb_recipe
        SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / (num_rating - 1)
        -- SET num_rating = num_rating - 1, score = score - OLD.rating
        WHERE tb_recipe.id = NEW.id_recipe;

        RETURN OLD;
    END IF;
        
    RETURN NULL; -- Result is ignored.
END
$$ LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS score_recipe_delete_tg ON tb_recipe;
CREATE TRIGGER score_recipe_delete_tg
AFTER DELETE ON tb_comment
FOR EACH ROW
WHEN (OLD.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_delete();

-- 1 - User score


ALTER TABLE tb_member
ADD COLUMN num_rating integer DEFAULT 0;