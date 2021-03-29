-- 4: Member Recipes
-- TODO visibility !!!!
-- only selects the member's recipes that are not part of a group (those are only visible inside the group)
SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, -- TODO: visibility
    tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score
    -- , comment_elapsed_time(tb_recipe.creation_time) as elapsed_time  -- tried using this but was returning weird values :/

FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_member = $memberId AND id_group IS NULL;


-- 6: Messages from two users

SELECT *
FROM tb_message
WHERE (id_receiver = $memberId1 AND id_sender = $memberId2) OR (id_receiver = $memberId2 AND id_sender = $memberId1)
ORDER BY timestamp DESC;


-- 15: Create recipe

INSERT INTO tb_recipe (name, difficulty, description, servings, preparation_time, cooking_time, additional_time, visibility, creation_time, id_member, id_category)
VALUES ($title, $difficulty, $description, $servings, $preparation_time, $cooking_time, $additional_time, $visibility, $creation_time, $id_member, $id_category);

INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);

INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);

INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity);


-- 13: Update recipe

UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $recipeId;

UPDATE tb_step   -- may need to update steps, may be repeated as necessary
SET name = $new_step_name, description = $new_step_description  
WHERE id = $id_step_to_update;

UPDATE tb_ingredient_recipe  -- may need to update recipe ingredients, may be repeated as necessary
SET id_unit = $new_id_unit, quantity = $new_quantity
WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_update;


-- 19: Delete recipe

DELETE FROM tb_recipe WHERE id = $recipeId;   -- It should cascade to the steps, ingredient_recipes and comments


-- Filter date

-- need to add visibility
SELECT tb_recipe.id, tb_recipe.name as title, description, creation_time, tb_member.name as member_name, tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.visibility AND creation_time > $lower_date_bound AND creation_time < $upper_date_bound
AND tb_recipe.id_member IN (
	SELECT tb_following.id_followed AS id
	FROM tb_following
	JOIN tb_member ON tb_following.id_following = tb_member.id
	WHERE tb_member.id = $memberId
)
ORDER BY creation_time DESC;


-- Filter date

-- need to add visibility
SELECT tb_recipe.id, tb_recipe.name as title, description, creation_time, tb_member.name as member_name, tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.visibility AND difficulty = $desired_difficulty
AND tb_recipe.id_member IN (
	SELECT tb_following.id_followed AS id
	FROM tb_following
	JOIN tb_member ON tb_following.id_following = tb_member.id
	WHERE tb_member.id = $memberId
)
ORDER BY creation_time DESC;

