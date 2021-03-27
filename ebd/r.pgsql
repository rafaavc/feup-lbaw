-- 4: Member Recipes
-- only selects the member's recipes that are not part of a group (those are only visible inside the group)
SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, 
    tb_recipe.visibility, tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score
    -- , comment_elapsed_time(tb_recipe.creation_time) as elapsed_time  -- tried using this but was returning weird values :/
FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_member = $member AND id_group IS NULL;

