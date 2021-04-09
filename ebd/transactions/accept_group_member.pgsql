SET TRANSACTION ISOLATION LEVEL READ COMMITTED;
BEGIN TRANSACTION;

-- Insert into group member
INSERT INTO tb_group_member (id_member, id_group)
    VALUES ($id_member, $id_group);

-- Change group request to accepted
UPDATE tb_group_request
    SET state = 'accepted'
    WHERE id_member = $id_member AND id_group = $id_group;

COMMIT;
