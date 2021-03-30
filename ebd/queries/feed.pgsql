SELECT tb_recipe.id, tb_recipe.name as title, description, creation_time, tb_member.name as member_name, tb_recipe.score
FROM tb_recipe
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.visibility -- TODO: change visibility
AND tb_recipe.id_member IN (
	SELECT tb_following.id_followed AS id
	FROM tb_following
	JOIN tb_member ON tb_following.id_following = tb_member.id
	WHERE tb_member.id = $memberId
)
ORDER BY creation_time DESC
LIMIT 5;