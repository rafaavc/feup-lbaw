-- 4: Member Recipes
-- only selects the member's recipes that are not part of a group (those are only visible inside the group)
SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, 
    tb_recipe.visibility, tb_recipe.creation_time, 
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
VALUES ('Spanish Moroccan Fish', 'medium', 'This Moroccan recipe was passed down for generations in my family. We usually serve it on the Sabbath night and holidays. It is a favorite! This dish may be served hot or cold according to taste.', 5, 51.666666666666664, 103.33333333333333, 0, TRUE, '202019-12-13 04:45:00', 19, 7);


-- 13: Update recipe

UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $recipeId;


-- 19: Delete recipe

DELETE FROM tb_recipe WHERE id = $recipeId;   -- It should cascade to the steps, ingredient_recipes and comments


