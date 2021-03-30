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


COMMIT;