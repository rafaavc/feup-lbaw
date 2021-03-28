
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
-- Add favourite notification when a user adds a recipes to the favourites (show the the recipe owner)

DROP FUNCTION IF EXISTS add_favourite_notification CASCADE;
CREATE FUNCTION add_favourite_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO tb_favourite_notification (id_caused_by, id_recipe)
    VALUES (NEW.id_member, NEW.id_recipe);
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS favourite_notification ON tb_favourite_notification CASCADE;
CREATE TRIGGER favourite_notification
    AFTER INSERT ON tb_favourite
    FOR EACH ROW
    EXECUTE PROCEDURE add_favourite_notification();
