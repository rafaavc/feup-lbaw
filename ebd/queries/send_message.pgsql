-- User A sends a message to the user B
INSERT INTO tb_message (text, id_receiver, id_sender)
    VALUES ($text, $id_user_b, $id_user_a);