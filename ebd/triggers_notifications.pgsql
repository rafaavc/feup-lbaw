
-- Comment notification:
-- Add comment notification after insert comment


CREATE FUNCTION add_comment_notification() RETURNS TRIGGER AS
$BODY
BEGIN
    INSERT INTO tb_comment_notification (id_comment)
    VALUES (New.id)
END
$BODY
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_notification;
CREATE TRIGGER add_comment_notification
    AFTER INSERT ON tb_comment_notification
    EXECUTE PROCEDURE add_comment_notification();
