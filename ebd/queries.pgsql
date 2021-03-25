-- 17 - Create review

INSERT INTO tb_comment(text, rating, id_member, id_recipe) 
VALUES("Absolutely delicious!", 5, 1, 1);

-- 1 - Member Information

SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, tb_member.visibility, tb_member.score, tb_country.name,
(SELECT COUNT(*) FROM tb_recipe WHERE id_member = tb_member.id) AS number_recipes,
(SELECT COUNT(*) FROM tb_following WHERE id_following = tb.member.id) AS number_following,
(SELECT COUNT(*) FROM tb_following WHERE id_followed = tb.member.id) AS number_followed
FROM tb_member
JOIN tb_country ON tb_member.id_country = tb_country.id;

-- 3 - Recipe information (tags, category, ingredients, units, steps, comments, etc.)

SELECT tb_recipe.name, tb_recipe.difficulty, tb_recipe.description, tb_recipe.servings, tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, tb_recipe.visibility,
    tb_recipe.creation_time, tb_recipe.score, tb_member.name, tb_member.username, tb_tag.name, tb_category.name, tb_ingredient.name
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
JOIN tb_category ON tb_recipe.id_category = tb_category.id_category;

-- Tags

SELECT tb_tag.name, tb_recipe.id
FROM tb_tag_recipe
JOIN tb_recipe ON tb_tag_recipe.id_recipe = tb_recipe.id
JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id;

-- Ingredients

SELECT tb_ingredient.name, tb_ingredient_recipe.quantity, tb_unit.text, tb_recipe.id
FROM tb_ingredient_recipe
JOIN tb_recipe ON tb_ingredient_recipe.id_recipe = tb_recipe.id
JOIN tb_ingredient ON tb_ingredient_recipe.id_ingredient = tb_ingredient.id
JOIN tb_unit ON tb_ingredient_recipe.id_unit = tb_unit.id;

-- Steps

SELECT tb_step.name, tb_step.description, tb_recipe.id
FROM tb_step
JOIN tb_recipe ON tb_step.id_recipe = tb_recipe.id;

-- Comments

SELECT tb_comment.text, tb_comment.post_time, tb_answer.father_comment
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
JOIN tb_answer ON tb_comment.id = tb_answer.id_comment
WHERE tb_comment.rating IS NULL;

-- Reviews

SELECT tb_comment.text, tb_comment.rating, tb_comment.post_time
FROM tb_comment
JOIN tb_recipe ON tb_comment.id = tb_recipe.id
WHERE tb_comment.rating IS NOT NULL;



-- Still need to specify the id for queries...

