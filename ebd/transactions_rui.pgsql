-- Select Member Information

SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
BEGIN TRANSACTION;

SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, coalesce(tb_member.score, 0) AS score, tb_country.name AS country,
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

-- Member Recipes 

SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, recipe_visibility(tb_recipe.id, $userId) AS visibility,
    tb_category.name AS category, score,
    comment_elapsed_time(tb_recipe.creation_time) as elapsed_time  
FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE id_member = $userId AND id_group IS NULL; 

COMMIT;

-- Select recipe Information

SET TRANSACTION ISOLATION LEVEL SERIALIZABLE READ ONLY;
BEGIN TRANSACTION;

SELECT tb_recipe.name, tb_recipe.description, tb_recipe.servings, tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time,
    tb_recipe.creation_time, score, tb_member.name AS member_name, tb_member.username AS member_username, tb_category.name AS category,
    (SELECT COUNT(*) FROM tb_comment WHERE id_recipe = tb_recipe.id AND rating IS NOT NULL) AS number_ratings,
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE recipe_visibility(tb_recipe.id, $userId) = TRUE AND tb_recipe.id = $recipeId; -- $userId | $recipeId

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

-- Note: Need to execute first the comment_elapsed_time UDF.

-- Comments

SELECT tb_comment.id, tb_comment.text, comment_elapsed_time(tb_comment.post_time), tb_answer.father_comment, tb_member.name, tb_member.id
FROM tb_comment
JOIN tb_answer ON tb_comment.id = tb_answer.id_comment
JOIN tb_member ON tb_comment.id_member = tb_member.id
WHERE tb_comment.id_recipe = $recipeId; -- $recipeId

-- Reviews

SELECT tb_comment.id, tb_comment.text, tb_comment.rating, comment_elapsed_time(tb_comment.post_time)
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
WHERE tb_comment.rating IS NOT NULL AND tb_recipe.id = $recipeId; -- $recipeId


COMMIT;