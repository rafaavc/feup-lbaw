
SELECT tb_recipe.id
FROM tb_recipe
JOIN tb_category ON tb_recipe.id_category = tb_category.id
WHERE tb_category.name = $categoryName;
