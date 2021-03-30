SET TRANSACTION ISOLATION LEVEL READ COMMITTED READ ONLY;
BEGIN TRANSACTION;

-- Group Information 

SELECT tb_group.name, tb_group.description
FROM tb_group
WHERE tb_group.id = $groupId; -- $groupId

-- Members

SELECT tb_member.id, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_member.id
WHERE tb_group_member.id_group = $groupId; -- $groupId

-- Group Requests

SELECT tb_group_request.state, tb_member.id, tb_member.name, tb_member.username
FROM tb_group_request
JOIN tb_member ON tb_group_request.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId

-- Group Members

SELECT tb_group_member.id_member, tb_member.username
FROM tb_group_member
JOIN tb_member ON tb_group_member.id_member = tb_member.id
WHERE tb_group = $groupId; -- $groupId

-- Group recipes

SELECT tb_recipe.id, tb_recipe.name, tb_recipe.description, tb_recipe.servings, 
    tb_recipe.preparation_time, tb_recipe.cooking_time, tb_recipe.additional_time, -- TODO: visibility
    tb_recipe.creation_time, 
    tb_category.name AS category, coalesce(tb_recipe.score, 0) as score

FROM tb_recipe JOIN tb_category ON tb_recipe.id_category = tb_category.id

WHERE id_group = $id_group;


COMMIT;