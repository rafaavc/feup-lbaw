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