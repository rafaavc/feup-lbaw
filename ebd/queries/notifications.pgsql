
-- get comment notifications of $userId

SELECT tb_comment_notification.id, read, tb_comment_notification.timestamp
FROM tb_comment_notification
JOIN tb_comment ON tb_comment_notification.id_comment = tb_comment.id
JOIN tb_recipe ON tb_comment.id_recipe = tb_recipe.id
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_comment.id_member = $userId;



-- get delete notifications of $userId

SELECT tb_delete_notification.id, read, name_recipe, tb_delete_notification.timestamp
FROM tb_delete_notification
JOIN tb_member ON tb_delete_notification.id_receiver = tb_member.id
WHERE tb_delete_notification.id_receiver = $userId;



-- get favourite notifications of $userId

SELECT tb_favourite_notification.id, read, tb_favourite_notification.timestamp, id_caused_by
FROM tb_favourite_notification
JOIN tb_recipe ON tb_favourite_notification.id_recipe = tb_recipe.id
JOIN tb_member ON tb_recipe.id_member = tb_member.id
WHERE tb_recipe.id_member = $userId;
