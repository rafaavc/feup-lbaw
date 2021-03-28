
-- Comment notification:
-- Add comment notification after insert comment

DROP FUNCTION IF EXISTS add_comment_notification CASCADE;
CREATE FUNCTION add_comment_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO tb_comment_notification (id_comment) VALUES (NEW.id);
	RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_notification ON tb_comment_notification CASCADE;
CREATE TRIGGER comment_notification
    AFTER INSERT ON tb_comment
    FOR EACH ROW
    EXECUTE PROCEDURE add_comment_notification();



-- Favourite Notification
-- Add a favourite notification when a user adds a recipes to the favourites (show the the recipe owner)

