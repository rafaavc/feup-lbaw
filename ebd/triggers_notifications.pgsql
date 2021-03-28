
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



-- Favourite notification
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


-- Delete notification
-- Add delete notification when an admin deletes a recipe (show to the recipe owner)
-- TODO
-- Right now, a delete notification is beeing added when a recipe is deleted1, regardless of who deleted it;
-- we need to change that so that a delete notification is added only when an admin deletes a recipe.
-- How can we check who is deleting the recipe ????

DROP FUNCTION IF EXISTS add_delete_notification CASCADE;
CREATE FUNCTION add_delete_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO tb_delete_notification (id_receiver, name_recipe)
    VALUES (OLD.id_member, OLD.name);
    RETURN OLD;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_notification ON tb_delete_notification CASCADE;
CREATE TRIGGER delete_notification
    BEFORE DELETE ON tb_recipe
    FOR EACH ROW
    EXECUTE PROCEDURE add_delete_notification();
