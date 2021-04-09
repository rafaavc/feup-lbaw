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