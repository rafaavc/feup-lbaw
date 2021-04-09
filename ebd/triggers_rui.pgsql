-- 2 - Recipe score

ALTER TABLE tb_recipe
ADD COLUMN num_rating integer DEFAULT 0;

-- Insert and Update

DROP FUNCTION IF EXISTS score_recipe_insert_update() CASCADE;
CREATE FUNCTION score_recipe_insert_update() RETURNS TRIGGER AS $$
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

DROP TRIGGER IF EXISTS score_recipe_insert_update_tg ON tb_comment;
CREATE TRIGGER score_recipe_insert_update_tg
AFTER INSERT OR UPDATE OF rating ON tb_comment
FOR EACH ROW
WHEN (NEW.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_insert_update();

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
    SET score = (totalScore + (NEW.score - OLD.score)) / num_rating
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_update_tg ON tb_recipe;
CREATE TRIGGER score_member_update_tg
AFTER UPDATE OF score ON tb_recipe
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
    SET num_rating = num_rating - 1, score = (totalScore - OLD.score) / (num_rating - 1)
    WHERE tb_member.id = OLD.id_member;

    RETURN OLD;    
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_delete_tg ON tb_recipe;
CREATE TRIGGER score_member_delete_tg
AFTER DELETE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_delete();

-- 3 - Recipe Visibility (Still needs further testing)

-- > TODO: add query to see if recipe is visible:
-- > if the recipe is in a group:
--     > it is visible if the group is public or if the user is member of the group
-- > else it is visible if the author is public 
-- > else it is visible if the user follows the author
-- > else is private

DROP FUNCTION IF EXISTS recipe_visibility();
CREATE OR REPLACE FUNCTION recipe_visibility(id_recipe integer, id_user integer)
RETURNS BOOLEAN AS $$ 
DECLARE 
    _id_group integer;
    group_visibility boolean;
    author_visibility boolean;
    id_author integer;
BEGIN
    SELECT tb_recipe.id_group INTO _id_group
    FROM tb_recipe 
    WHERE tb_recipe.id = id_recipe;
	
	-- Recipe belongs to a group and the group is public or the user is member of that group
    IF _id_group IS NOT NULL THEN
        SELECT visibility INTO group_visibility FROM tb_group;
        IF group_visibility = TRUE THEN
            RETURN TRUE;
        END IF; 
        IF EXISTS(
            SELECT * FROM tb_group_member 
            WHERE tb_group_member.id_group = _id_group AND tb_group_member.id_member = id_user) THEN
            RETURN TRUE;
        END IF;
    END IF;

    SELECT tb_member.visibility INTO author_visibility
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;

    SELECT tb_recipe.id_member INTO id_author
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;
	
	-- Recipe's author profile visibility if public
    IF author_visibility = TRUE THEN
        RETURN TRUE;
    END IF;
	
	-- User follows recipe's author
    IF EXISTS (
        SELECT * FROM tb_following
        WHERE tb_following.id_following = id_user AND tb_following.id_followed = id_author
        AND state = 'accepted') THEN
        RETURN TRUE;
    END IF;

	-- User is the recipe's creator
	IF id_author = id_user THEN
		RETURN TRUE;
	END IF;

    RETURN FALSE;
END;
$$ LANGUAGE plpgsql;