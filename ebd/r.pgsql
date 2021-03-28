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



-- 13: Update recipe

UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $recipeId;


-- 19: Delete recipe

DELETE FROM tb_recipe WHERE id = $recipeId;   -- It should cascade to the steps, ingredient_recipes and comments


