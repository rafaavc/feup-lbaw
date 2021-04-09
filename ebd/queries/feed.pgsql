SELECT tb_recipe.id, tb_recipe.name as title, description, creation_time, tb_member.name as member_name, tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE recipe_visibility(tb_recipe.id, $memberId)
ORDER BY creation_time DESC
LIMIT 5;