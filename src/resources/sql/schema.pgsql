DROP SCHEMA IF EXISTS public CASCADE;
CREATE SCHEMA public;

DROP SCHEMA IF EXISTS public CASCADE;
CREATE SCHEMA public;

CREATE DOMAIN "datetime"
AS timestamp with time zone
DEFAULT now()
NOT NULL;

CREATE TYPE Difficulty AS ENUM (
    'easy',
    'medium',
    'hard',
    'very hard'
);

CREATE TYPE State AS ENUM (
    'pending',
    'accepted',
    'rejected'
);

CREATE TABLE tb_group (
    id SERIAL,
    name text NOT NULL,
    description text NOT NULL,
    visibility boolean NOT NULL,

    CONSTRAINT group_PK PRIMARY KEY (id)
);

CREATE TABLE tb_country (
    id SERIAL,
    abbreviation text NOT NULL,
    name text NOT NULL,

    CONSTRAINT country_PK PRIMARY KEY (id)
);

CREATE TABLE tb_member (
    id SERIAL,
    email text UNIQUE NOT NULL,
    password text NOT NULL,
    name text NOT NULL,
    username text UNIQUE NOT NULL,
    city text,
    bio text,
    visibility boolean DEFAULT FALSE NOT NULL,
    is_banned boolean DEFAULT FALSE NOT NULL,
    id_country integer NOT NULL,
    score real DEFAULT 0,

    CONSTRAINT member_PK PRIMARY KEY (id),
    CONSTRAINT member_country_FK FOREIGN KEY (id_country) REFERENCES "tb_country" ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE tb_ingredient (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT ingredient_PK PRIMARY KEY (id)
);

CREATE TABLE tb_frequently_asked_question (
    id SERIAL,
    question text NOT NULL,
    answer text NOT NULL,

    CONSTRAINT frequently_asked_question_PK PRIMARY KEY (id)
);

CREATE TABLE tb_unit (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT unit_PK PRIMARY KEY (id)
);

CREATE TABLE tb_conversion (
    unit_1 integer NOT NULL,
    unit_2 integer NOT NULL,
    factor real NOT NULL,

    CONSTRAINT conversion_PK PRIMARY KEY (unit_1, unit_2),
    CONSTRAINT conversion_unit_1_FK FOREIGN KEY (unit_1) REFERENCES "tb_unit" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT conversion_unit_2_FK FOREIGN KEY (unit_2) REFERENCES "tb_unit" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_category (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT category_PK PRIMARY KEY (id)
);

CREATE TABLE tb_recipe (
    id SERIAL,
    name text NOT NULL,
    difficulty Difficulty NOT NULL,
    description text,
    servings integer,
    preparation_time integer,
    cooking_time integer,
    additional_time integer,
    creation_time datetime NOT NULL,
    id_member integer NOT NULL,
    id_category integer,
    id_group integer,
    score real DEFAULT 0,

    CONSTRAINT recipe_PK PRIMARY KEY (id),
    CONSTRAINT recipe_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT recipe_category_FK FOREIGN KEY (id_category) REFERENCES "tb_category" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT recipe_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT recipe_servings_CK CHECK (servings > 0),
    CONSTRAINT recipe_preparation_time_CK CHECK (preparation_time >= 0),
    CONSTRAINT recipe_cooking_time_CK CHECK (cooking_time >= 0),
    CONSTRAINT recipe_additional_time_CK CHECK (additional_time >= 0)
);

CREATE TABLE tb_ingredient_recipe (
    id_recipe integer NOT NULL,
    id_ingredient integer NOT NULL,
    id_unit integer NOT NULL,
    quantity real,

    CONSTRAINT ingredient_recipe_PK PRIMARY KEY (id_recipe, id_ingredient),
    CONSTRAINT ingredient_recipe_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ingredient_recipe_ingredient_FK FOREIGN KEY (id_ingredient) REFERENCES "tb_ingredient" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ingredient_recipe_unit_FK FOREIGN KEY (id_unit) REFERENCES "tb_unit" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ingredient_recipe_non_negative_quantity_CK CHECK (quantity >= 0)
);

CREATE TABLE tb_tag (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT tag_PK PRIMARY KEY (id)
);

CREATE TABLE tb_tag_recipe (
    id_tag integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT tag_recipe_PK PRIMARY KEY (id_tag, id_recipe),
    CONSTRAINT tag_recipe_tag_FK FOREIGN KEY (id_tag) REFERENCES "tb_tag" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT tag_recipe_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_step (
    id SERIAL,
    name text NOT NULL,
    description text,
    id_recipe integer NOT NULL,

    CONSTRAINT step_PK PRIMARY KEY (id),
    CONSTRAINT step_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_favourite (
    id_recipe integer NOT NULL,
    id_member integer NOT NULL,

    CONSTRAINT favourite_PK PRIMARY KEY (id_recipe, id_member),
    CONSTRAINT favourite_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT favourite_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_moderator (
    id_member integer NOT NULL,
    id_group integer NOT NULL,

    CONSTRAINT group_moderator_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT group_moderator_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT group_moderator_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_member (
    id_member integer NOT NULL,
    id_group integer NOT NULL,

    CONSTRAINT group_member_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT group_member_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT group_member_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_request (
    id_member integer,
    id_group integer,
    state State NOT NULL,
    timestamp datetime,

    CONSTRAINT group_request_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT group_request_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT group_request_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_admin (
    id SERIAL,
    email text UNIQUE NOT NULL,
    password text NOT NULL,
    name text NOT NULL,
    username text UNIQUE NOT NULL,

    CONSTRAINT admin_PK PRIMARY KEY (id)
);

CREATE TABLE tb_following (
    id_following integer NOT NULL,
    id_followed integer NOT NULL,
    state State NOT NULL,
    timestamp datetime,

    CONSTRAINT following_PK PRIMARY KEY (id_following, id_followed),
    CONSTRAINT following_following_FK FOREIGN KEY (id_following) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT following_followed_FK FOREIGN KEY (id_followed) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT following_diff_CK CHECK (id_following <> id_followed)
);

CREATE TABLE tb_message (
    id SERIAL,
    text text NOT NULL,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    sender integer NOT NULL,

    CONSTRAINT message_PK PRIMARY KEY (id),
    CONSTRAINT message_sender_FK FOREIGN KEY (sender) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_comment (
    id SERIAL,
    text text NOT NULL,
    rating integer,
    post_time datetime,
    id_member integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT comment_PK PRIMARY KEY (id),
    CONSTRAINT comment_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT comment_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT comment_rating_CK CHECK (rating IS NULL OR (rating >= 1 AND rating <= 5))
);

CREATE TABLE tb_answer (
    id_comment integer,
    father_comment integer NOT NULL,

    CONSTRAINT answer_PK PRIMARY KEY (id_comment),
    CONSTRAINT answer_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT answer_father_comment_FK FOREIGN KEY (father_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_comment_notification (
    id SERIAL,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_comment integer NOT NULL,

    CONSTRAINT comment_notification_PK PRIMARY KEY (id),
    CONSTRAINT comment_notification_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_delete_notification (
    id SERIAL,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    name_recipe text NOT NULL,

    CONSTRAINT delete_notification_PK PRIMARY KEY (id),
    CONSTRAINT delete_notification_receiver_FK FOREIGN KEY (id_receiver) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_favourite_notification (
    id SERIAL,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_caused_by integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT favourite_notification_PK PRIMARY KEY (id),
    CONSTRAINT favourite_notification_caused_by_FK FOREIGN KEY (id_caused_by) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT favourite_notification_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_comment_report (
    id SERIAL,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active boolean NOT NULL,
    id_comment integer NOT NULL,

    CONSTRAINT comment_report_PK PRIMARY KEY (id),
    CONSTRAINT comment_report_reporter_FK FOREIGN KEY (id_reporter) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT comment_report_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_recipe_report (
    id SERIAL,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active boolean NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT recipe_report_PK PRIMARY KEY (id),
    CONSTRAINT recipe_report_reporter_FK FOREIGN KEY (id_reporter) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT recipe_report_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE password_resets (
    id SERIAL,
    email text,
    token text,
    created_at datetime
);


-- INDEXES

DROP INDEX IF EXISTS member_recipe_index;
CREATE INDEX member_recipe_index ON tb_recipe USING hash(id_member);


DROP INDEX IF EXISTS category_recipe_index;
CREATE INDEX category_recipe_index ON tb_recipe USING hash(id_category);


DROP INDEX IF EXISTS group_recipe_index;
CREATE INDEX group_recipe_index ON tb_recipe USING hash(id_group);


DROP INDEX IF EXISTS message_index;
CREATE INDEX message_index ON tb_message (sender);


DROP INDEX IF EXISTS rating_index;
CREATE INDEX rating_index ON tb_recipe USING btree(score); -- B-tree by default


DROP INDEX IF EXISTS member_comment_index;
CREATE INDEX member_comment_index ON tb_comment USING hash(id_member);


DROP INDEX IF EXISTS recipe_comment_index;
CREATE INDEX recipe_comment_index ON tb_comment USING hash(id_recipe);


DROP INDEX IF EXISTS receiver_delete_notification_index;
CREATE INDEX receiver_delete_notification_index ON tb_delete_notification USING hash(id_receiver);


DROP INDEX IF EXISTS recipe_creation_time_index;
CREATE INDEX recipe_creation_time_index ON tb_recipe USING btree(creation_time);


DROP INDEX IF EXISTS recipe_difficulty_index;
CREATE INDEX recipe_difficulty_index ON tb_recipe USING hash(difficulty);


ALTER TABLE tb_category
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS categories_fts;
CREATE INDEX categories_fts ON tb_category USING GIN(search);


ALTER TABLE tb_member
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS users_fts;
CREATE INDEX users_fts ON tb_member USING GIN(search);

ALTER TABLE tb_group
ADD COLUMN search tsvector;

DROP INDEX IF EXISTS groups_fts;
CREATE INDEX groups_fts ON tb_group USING GIN(search);


-- TRIGGERS

ALTER TABLE tb_recipe
ADD COLUMN num_rating integer DEFAULT 0;

DROP FUNCTION IF EXISTS score_recipe_insert_update() CASCADE;
CREATE FUNCTION score_recipe_insert_update() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = NEW.id_recipe;

    IF TG_OP = 'INSERT' THEN
        UPDATE tb_recipe
        SET num_rating = num_rating + 1, score = (totalScore + NEW.rating) / (num_rating + 1)
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;
    IF TG_OP = 'UPDATE' THEN
        UPDATE tb_recipe
        SET score = (totalScore + (NEW.rating - OLD.rating)) / num_rating
        WHERE tb_recipe.id = NEW.id_recipe;
    END IF;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_insert_update_tg ON tb_comment;
CREATE TRIGGER score_recipe_insert_update_tg
AFTER INSERT OR UPDATE ON tb_comment
FOR EACH ROW
WHEN (NEW.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_insert_update();

DROP FUNCTION IF EXISTS score_recipe_delete() CASCADE;
CREATE FUNCTION score_recipe_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_recipe
    WHERE id = OLD.id_recipe;


    UPDATE tb_recipe
    SET num_rating = num_rating - 1, score = (totalScore - OLD.rating) / GREATEST((num_rating - 1), 1)
    WHERE tb_recipe.id = OLD.id_recipe;

    RETURN OLD;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_recipe_delete_tg ON tb_comment;
CREATE TRIGGER score_recipe_delete_tg
AFTER DELETE ON tb_comment
FOR EACH ROW
WHEN (OLD.rating IS NOT NULL)
EXECUTE PROCEDURE score_recipe_delete();

ALTER TABLE tb_member
ADD COLUMN num_rating integer DEFAULT 0;

DROP FUNCTION IF EXISTS score_member_insert() CASCADE;
CREATE FUNCTION score_member_insert() RETURNS TRIGGER AS $$
BEGIN
    UPDATE tb_member
    SET num_rating = num_rating + 1
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_insert_tg ON tb_recipe;
CREATE TRIGGER score_member_insert_tg
AFTER INSERT ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_insert();

DROP FUNCTION IF EXISTS score_member_update() CASCADE;
CREATE FUNCTION score_member_update() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = NEW.id_member;

    UPDATE tb_member
    SET score = (totalScore + (NEW.score - OLD.score)) / num_rating
    WHERE tb_member.id = NEW.id_member;

    RETURN NEW;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_update_tg ON tb_recipe;
CREATE TRIGGER score_member_update_tg
AFTER UPDATE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_update();

DROP FUNCTION IF EXISTS score_member_delete() CASCADE;
CREATE FUNCTION score_member_delete() RETURNS TRIGGER AS $$
DECLARE
    totalScore real;
BEGIN
    SELECT score * num_rating INTO totalScore
    FROM tb_member
    WHERE id = OLD.id_member;

    UPDATE tb_member
    SET num_rating = num_rating - 1, score = (totalScore - OLD.score) / GREATEST((num_rating - 1), 1)
    WHERE tb_member.id = OLD.id_member;

    RETURN OLD;
END
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS score_member_delete_tg ON tb_recipe;
CREATE TRIGGER score_member_delete_tg
AFTER DELETE ON tb_recipe
FOR EACH ROW
EXECUTE PROCEDURE score_member_delete();

DROP FUNCTION IF EXISTS recipe_visibility();
CREATE OR REPLACE FUNCTION recipe_visibility(id_recipe integer, id_user integer)
RETURNS BOOLEAN AS $$
DECLARE
    _id_group integer;
    group_visibility boolean;
    author_visibility boolean;
    id_author integer;
BEGIN
    SELECT tb_member.visibility INTO author_visibility
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;

    -- User is the recipe's creator
	IF id_author = id_user THEN
		RETURN TRUE;
	END IF;

    SELECT tb_recipe.id_group INTO _id_group
    FROM tb_recipe
    WHERE tb_recipe.id = id_recipe;

    -- Recipe belongs to a group and the group is public or the user is member of that group
    IF _id_group IS NOT NULL THEN
        SELECT visibility INTO group_visibility FROM tb_group WHERE id = _id_group;
        IF group_visibility = TRUE THEN
            RETURN TRUE;
        END IF;
        IF EXISTS(
            SELECT * FROM tb_group_member
            WHERE tb_group_member.id_group = _id_group AND tb_group_member.id_member = id_user) THEN
            RETURN TRUE;
        ELSE
            RETURN FALSE;
        END IF;
    END IF;

	-- Recipe's author profile visibility if public
    IF author_visibility = TRUE THEN
        RETURN TRUE;
    END IF;

    SELECT tb_recipe.id_member INTO id_author
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    WHERE tb_recipe.id = id_recipe;

	-- User follows recipe's author
    IF EXISTS (
        SELECT * FROM tb_following
        WHERE tb_following.id_following = id_user AND tb_following.id_followed = id_author
        AND state = 'accepted') THEN
        RETURN TRUE;
    END IF;

    RETURN FALSE;
END;
$$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS comment_elapsed_time(timestamptz) CASCADE;
CREATE OR REPLACE FUNCTION comment_elapsed_time(comment_creation_time timestamptz)
RETURNS TEXT AS $timeString$
DECLARE
    time_unit INTEGER;
BEGIN
    -- Year
	SELECT EXTRACT(YEAR FROM AGE(now(), comment_creation_time)) INTO time_unit;
   	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' years ago');
        ELSE
            RETURN CONCAT(time_unit, ' year ago');
        END IF;
    END IF;

    -- Months
	SELECT EXTRACT(MONTH FROM AGE(now(), comment_creation_time)) INTO time_unit;
	IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' months ago');
        ELSE
            RETURN CONCAT(time_unit, ' month ago');
        END IF;
    END IF;

    -- Days
	SELECT EXTRACT(DAY FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' days ago');
        ELSE
            RETURN CONCAT(time_unit, ' day ago');
        END IF;
    END IF;

    -- Hours
	SELECT EXTRACT(HOUR FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' hours ago');
        ELSE
            RETURN CONCAT(time_unit, ' hour ago');
        END IF;
    END IF;

    -- Minutes
	SELECT EXTRACT(MINUTE FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' minutes ago');
        ELSE
            RETURN CONCAT(time_unit, ' minute ago');
        END IF;
    END IF;

    -- Seconds
	SELECT EXTRACT(SECOND FROM AGE(now(), comment_creation_time)) INTO time_unit;
    IF time_unit > 0 THEN
        IF time_unit > 1 THEN
            RETURN CONCAT(time_unit, ' seconds ago');
        ELSE
            RETURN CONCAT(time_unit, ' second ago');
        END IF;
    END IF;

    RETURN time_unit;
END;
$timeString$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION single_rating() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.rating IS NOT NULL AND EXISTS (
            SELECT FROM tb_comment
            WHERE id_recipe = NEW.id_recipe
                AND id_member = NEW.id_member
                AND rating IS NOT NULL
                AND id != NEW.id   -- the id may be equal in case of update
    ) THEN
        RAISE EXCEPTION 'A user can only rate a recipe once.';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS single_rating_tg ON tb_comment;
CREATE TRIGGER single_rating_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE single_rating();


CREATE OR REPLACE FUNCTION comment_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    recipe_time timestamptz := (SELECT creation_time FROM tb_recipe WHERE id = NEW.id_recipe);
BEGIN
    IF NEW.post_time IS NOT NULL AND NEW.post_time < recipe_time THEN
        RAISE EXCEPTION 'The date/time of a comment/review must be after the recipe''s creation date. Comment id = (%)', NEW.id;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS comment_date_precedence_tg ON tb_comment;
CREATE TRIGGER comment_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_comment
FOR EACH ROW
EXECUTE PROCEDURE comment_date_precedence();


CREATE OR REPLACE FUNCTION answer_date_precedence() RETURNS TRIGGER AS $$
DECLARE
    original_comment_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.father_comment);
    answer_time timestamptz := (SELECT post_time FROM tb_comment WHERE id = NEW.id_comment);
BEGIN
    IF answer_time < original_comment_time THEN
        RAISE EXCEPTION 'The date/time of an answer must be after the original comment''s creation date. Comment id = (%) t = (%), answer id = (%) t = (%),', NEW.father_comment, original_comment_time, NEW.id_comment, answer_time;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS answer_date_precedence_tg ON tb_answer;
CREATE TRIGGER answer_date_precedence_tg
BEFORE INSERT OR UPDATE ON tb_answer
FOR EACH ROW
EXECUTE PROCEDURE answer_date_precedence();


CREATE OR REPLACE FUNCTION default_following_state() RETURNS TRIGGER AS $$
DECLARE
    member_visibility boolean := (SELECT visibility FROM tb_member WHERE id = NEW.id_followed);
BEGIN
    IF NEW.state IS NULL THEN
        IF member_visibility = TRUE THEN  -- if the member's profile is public
            NEW.state := 'accepted';
        ELSE
            NEW.state := 'pending';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS default_following_state_tg ON tb_following;
CREATE TRIGGER default_following_state_tg
BEFORE INSERT ON tb_following
FOR EACH ROW
EXECUTE PROCEDURE default_following_state();



DROP FUNCTION IF EXISTS group_request() CASCADE;
CREATE FUNCTION group_request() RETURNS TRIGGER AS
$BODY$
DECLARE
    already_belongs_to_group integer := (SELECT count(*) FROM tb_group_member WHERE id_group = NEW.id_group AND id_member = NEW.id_member);
    group_visibility boolean := (SELECT visibility FROM tb_group WHERE id = NEW.id_group);
BEGIN
    IF already_belongs_to_group > 0 THEN
        NEW.state = 'accepted';
        RETURN NEW;
    END IF;

    IF group_visibility = TRUE THEN
        NEW.state := 'accepted';
        INSERT INTO tb_group_member VALUES(NEW.id_member, NEW.id_group);
    ELSE
        NEW.state := 'pending';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS group_request_tg ON tb_group_request;
CREATE TRIGGER group_request_tg
    BEFORE INSERT ON tb_group_request
    FOR EACH ROW
    EXECUTE PROCEDURE group_request();



CREATE FUNCTION name_search() RETURNS TRIGGER AS $$
DECLARE
    idiom regconfig := TG_ARGV[0];
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.search = to_tsvector(idiom, NEW.name);
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name THEN
            NEW.search = to_tsvector(idiom, NEW.name);
        END IF;
    END IF;
    RETURN NEW;
END
$$ LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS category_search_tg ON tb_category;
CREATE TRIGGER category_search_tg
BEFORE INSERT OR UPDATE ON tb_category
FOR EACH ROW
EXECUTE PROCEDURE name_search('english');


DROP TRIGGER IF EXISTS users_search_tg ON tb_member;
CREATE TRIGGER users_search_tg
BEFORE INSERT OR UPDATE ON tb_member
FOR EACH ROW
EXECUTE PROCEDURE name_search('simple');


DROP TRIGGER IF EXISTS groups_search_tg ON tb_group;
CREATE TRIGGER groups_search_tg
BEFORE INSERT OR UPDATE ON tb_group
FOR EACH ROW
EXECUTE PROCEDURE name_search('english');



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


DROP FUNCTION IF EXISTS answer_rating() CASCADE;
CREATE FUNCTION answer_rating() RETURNS TRIGGER AS
$BODY$
DECLARE
    comment_rating integer := (SELECT rating FROM tb_comment WHERE id = NEW.id_comment);
BEGIN
    IF comment_rating IS NOT NULL THEN
        RAISE EXCEPTION 'An answer cannot have a rating.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS answer_rating_tg ON tb_answer;
CREATE TRIGGER answer_rating_tg
    BEFORE INSERT OR UPDATE ON tb_answer
    FOR EACH ROW
    EXECUTE PROCEDURE answer_rating();


