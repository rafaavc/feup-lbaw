-- 17 - Create review

INSERT INTO tb_comment(text, rating, id_member, id_recipe) 
VALUES('Absolutely delicious!', 5, 1, 1);

-- 1 - Member Information (Profile)

SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, tb_member.visibility, coalesce(tb_member.score, 0) AS score, tb_country.name AS country,
(SELECT COUNT(*) FROM tb_recipe WHERE id_member = tb_member.id) AS number_recipes,
(SELECT COUNT(*) FROM tb_following WHERE id_following = tb_member.id) AS number_following,
(SELECT COUNT(*) FROM tb_following WHERE id_followed = tb_member.id) AS number_followed
FROM tb_member
JOIN tb_country ON tb_member.id_country = tb_country.id
WHERE tb_member.id = $userId; -- $userId

-- Users following (Profile)

SELECT tb_following.id_followed 
FROM tb_following
WHERE tb_following.id_following = $userId; -- $userId

-- User Groups (Profile)

SELECT tb_group.id, tb_group.name
FROM tb_group_member
JOIN tb_group ON tb_group_member.id_group = tb_group.id
WHERE tb_group_member.id_member = $userId; -- $userId

-- 3 - Recipe information (tags, category, ingredients, units, steps, comments, etc.)

SELECT tb_recipe.name, tb_recipe.description, tb_recipe.servings, tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, tb_recipe.visibility,
    tb_recipe.creation_time, coalesce(tb_recipe.score, 0) AS score, tb_member.name AS member_name, tb_member.username AS member_username, tb_category.name AS category,
    (SELECT COUNT(*) FROM tb_comment WHERE id_recipe = $recipeId AND rating IS NOT NULL) AS number_ratings
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Tags

SELECT tb_tag.id, tb_tag.name
FROM tb_tag_recipe
JOIN tb_recipe ON tb_tag_recipe.id_recipe = tb_recipe.id
JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Ingredients

SELECT tb_ingredient.id, tb_ingredient.name, tb_ingredient_recipe.quantity, tb_unit.name
FROM tb_ingredient_recipe
JOIN tb_recipe ON tb_ingredient_recipe.id_recipe = tb_recipe.id
JOIN tb_ingredient ON tb_ingredient_recipe.id_ingredient = tb_ingredient.id
JOIN tb_unit ON tb_ingredient_recipe.id_unit = tb_unit.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Steps

SELECT tb_step.id, tb_step.name, tb_step.description
FROM tb_step
JOIN tb_recipe ON tb_step.id_recipe = tb_recipe.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

DROP FUNCTION IF EXISTS comment_elapsed_time(timestamptz) CASCADE;
CREATE OR REPLACE FUNCTION comment_elapsed_time(comment_creation_time timestamptz)
RETURNS TEXT AS $timeString$ 
DECLARE 
    time_unit INTEGER;
BEGIN
    -- Year
	SELECT EXTRACT(YEAR FROM AGE(now(), comment_creation_time)) INTO time_unit;
   	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' years ago');
        ELSE
            RETURN CONCAT(time_unit, ' year ago');
        END IF;
    END IF;
    
    -- Months
	SELECT EXTRACT(MONTH FROM AGE(now(), comment_creation_time)) INTO time_unit;
	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' months ago');
        ELSE
            RETURN CONCAT(time_unit, ' month ago');
        END IF;
    END IF;

    -- Days
	SELECT EXTRACT(DAY FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' days ago');
        ELSE
            RETURN CONCAT(time_unit, ' day ago');
        END IF;
    END IF;

    -- Hours
	SELECT EXTRACT(HOUR FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' hours ago');
        ELSE
            RETURN CONCAT(time_unit, ' hour ago');
        END IF;
    END IF;

    -- Minutes
	SELECT EXTRACT(MINUTE FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' minutes ago');
        ELSE
            RETURN CONCAT(time_unit, ' minute ago');
        END IF;
    END IF;

    -- Seconds
	SELECT EXTRACT(SECOND FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' seconds ago');
        ELSE
            RETURN CONCAT(time_unit, ' second ago');
        END IF;
    END IF;

    RETURN time_unit;
END;
$timeString$ LANGUAGE plpgsql;

SELECT comment_elapsed_time('2021-03-22 19:10:25'::timestamptz);

-- Comments

SELECT tb_comment.id, tb_comment.text, comment_elapsed_time(tb_comment.post_time), tb_answer.father_comment, tb_member.name, tb_member.id
FROM tb_comment
JOIN tb_recipe ON tb_comment.id_recipe = tb_recipe.id;
JOIN tb_answer ON tb_comment.id = tb_answer.id_comment
JOIN tb_member ON tb_comment.id_member = tb_member.id
WHERE tb_recipe.id = $recipeId; -- $recipeId

-- Reviews

SELECT tb_comment.id, tb_comment.text, tb_comment.rating, comment_elapsed_time(tb_comment.post_time)
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
WHERE tb_comment.rating IS NOT NULL AND tb_recipe.id = $recipeId; -- $recipeId


-- 2 - Group Information 

SELECT tb_group.name, tb_group.description, tb_group.visibility
FROM tb_group
WHERE tb_group.id = $groupId; -- $groupId

-- Members

SELECT tb_member.id, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_group.id_member
WHERE tb_group_member.id_group = $groupId; -- $groupId

-- Group Requests

SELECT tb_group_request.id, tb_group_request.state, tb_member.id, tb_member.name, tb_member.username
FROM tb_group_request
JOIN tb_member ON tb_group_request.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId

-- Group Members

SELECT tb_group_member.id_member, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId

