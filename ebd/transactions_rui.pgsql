-- Select member

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
WHERE id_member = $memberId AND id_group IS NULL;

-- Select recipe [2dukes]

