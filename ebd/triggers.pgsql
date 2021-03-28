-- 2 - Recipe score

ALTER TABLE tb_recipe
ADD COLUMN num_rating integer DEFAULT 0;

-- Insert and Update

DROP FUNCTION IF EXISTS score_recipe_insertOrUpdate() CASCADE;
CREATE FUNCTION score_recipe_insertOrUpdate() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = NEW.id_recipe;

    IF TG_OP = 'INSERT' THEN
        UPDATE tb_recipe 
        SET num_rating = num_rating + 1, score = (totalScore + NEW.rating) / (num_rating + 1)
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        UPDATE tb_recipe 
        SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_insertOrUpdate_tg ON tb_comment;
CREATE TRIGGER score_recipe_insertOrUpdate_tg
AFTER INSERT OR UPDATE ON tb_comment
FOR EACH ROW
WHEN (NEW.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_insertOrUpdate();

-- Delete

DROP FUNCTION IF EXISTS score_recipe_delete() CASCADE;
CREATE FUNCTION score_recipe_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = OLD.id_recipe;

    UPDATE tb_recipe
    SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / (num_rating - 1)
    WHERE tb_recipe.id = OLD.id_recipe;

    RETURN OLD;    
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_delete_tg ON tb_comment;
CREATE TRIGGER score_recipe_delete_tg
AFTER DELETE ON tb_comment
FOR EACH ROW
WHEN (OLD.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_delete();

-- 1 - User score (Still needs further testing)

ALTER TABLE tb_member
ADD COLUMN num_rating integer DEFAULT 0;

-- Insert

DROP FUNCTION IF EXISTS score_member_insert() CASCADE;
CREATE FUNCTION score_member_insert() RETURNS TRIGGER AS $$
BEGIN
    UPDATE tb_member 
    SET num_rating = num_rating + 1
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_insert_tg ON tb_recipe;
CREATE TRIGGER score_member_insert_tg
AFTER INSERT ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_insert();

-- Update

DROP FUNCTION IF EXISTS score_member_update() CASCADE;
CREATE FUNCTION score_member_update() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = NEW.id_member;

    UPDATE tb_member 
    SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_update_tg ON tb_recipe;
CREATE TRIGGER score_member_update_tg
AFTER UPDATE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_update();

-- Delete

DROP FUNCTION IF EXISTS score_member_delete() CASCADE;
CREATE FUNCTION score_member_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = OLD.id_member;

    UPDATE tb_member
    SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / (num_rating - 1)
    WHERE tb_member.id = OLD.id_member;

    RETURN OLD;    
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_delete_tg ON tb_recipe;
CREATE TRIGGER score_member_delete_tg
AFTER DELETE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_delete();