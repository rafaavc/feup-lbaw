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
    id serial,
    name text NOT NULL,
    description text NOT NULL,
    visibility boolean NOT NULL,

    CONSTRAINT group_PK PRIMARY KEY (id)
);

CREATE TABLE tb_country (
    id serial,
    abbreviation text NOT NULL,
    name text NOT NULL,

    CONSTRAINT country_PK PRIMARY KEY (id)
);

CREATE TABLE tb_member (
    id serial,
    email text UNIQUE NOT NULL,
    password text NOT NULL,
    name text NOT NULL,
    username text UNIQUE NOT NULL,
    city text,
    bio text,
    visibility boolean DEFAULT FALSE NOT NULL,
    is_banned boolean DEFAULT FALSE NOT NULL,
    country_id integer NOT NULL,
    score real,

    CONSTRAINT member_PK PRIMARY KEY (id),
    CONSTRAINT member_country_FK FOREIGN KEY (country_id) REFERENCES "tb_country" ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE tb_ingredient (
    id serial,
    name text NOT NULL,

    CONSTRAINT ingredient_PK PRIMARY KEY (id)
);

CREATE TABLE tb_frequently_asked_question (
    id serial,
    question text NOT NULL,
    answer text NOT NULL,

    CONSTRAINT frequently_asked_question_PK PRIMARY KEY (id)
);

CREATE TABLE tb_unit (
    id serial,
    name text NOT NULL,

    CONSTRAINT unit_PK PRIMARY KEY (id)
);

CREATE TABLE tb_conversion (
    unit_1 integer NOT NULL,
    unit_2 integer NOT NULL,

    CONSTRAINT conversion_PK PRIMARY KEY (unit_1, unit_2),
    CONSTRAINT unit_1_FK FOREIGN KEY (unit_1) REFERENCES "tb_unit" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT unit_2_FK FOREIGN KEY (unit_2) REFERENCES "tb_unit" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_category (
    id serial,
    name text NOT NULL,

    CONSTRAINT category_PK PRIMARY KEY (id)
);

CREATE TABLE tb_recipe (
    id serial,
    name text NOT NULL,
    difficulty Difficulty NOT NULL,
    description text,
    servings integer,
    preparation_time integer,
    cooking_time integer,
    additional_time integer,
    visibility boolean NOT NULL,
    creation_time datetime NOT NULL,
    id_member integer NOT NULL,
    id_category integer,
    id_group integer,
    score real,

    CONSTRAINT recipe_PK PRIMARY KEY (id),
    CONSTRAINT id_member_FK1 FOREIGN KEY (id_member) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_category_FK FOREIGN KEY (id_category) REFERENCES "tb_category" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT servings_CK CHECK (servings > 0),
    CONSTRAINT preparation_time_CK CHECK (preparation_time >= 0),
    CONSTRAINT cooking_time_CK CHECK (cooking_time >= 0),
    CONSTRAINT additional_time_CK CHECK (additional_time >= 0)
);

CREATE TABLE tb_ingredient_recipe (
    recipe_id integer NOT NULL,
    ingredient_id integer NOT NULL,
    unit_id integer NOT NULL,
    quantity real,

    CONSTRAINT ingredient_recipe_PK PRIMARY KEY (recipe_id, ingredient_id),
    CONSTRAINT recipe_id_FK FOREIGN KEY (recipe_id) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ingredient_id_FK FOREIGN KEY (ingredient_id) REFERENCES "tb_ingredient" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT non_negative_quantity CHECK (quantity >= 0)
);

CREATE TABLE tb_tag (
    id serial,
    name text NOT NULL,

    CONSTRAINT tag_PK PRIMARY KEY (id)
);

CREATE TABLE tb_tag_recipe (
    id_tag integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT tag_recipe_PK PRIMARY KEY (id_tag, id_recipe),
    CONSTRAINT id_tag_FK FOREIGN KEY (id_tag) REFERENCES "tb_tag" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_step (
    id serial,
    name text NOT NULL,
    description text,
    id_recipe integer NOT NULL,

    CONSTRAINT step_PK PRIMARY KEY (id),
    CONSTRAINT id_recipe_PK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_favourite (
    id_recipe integer NOT NULL,
    id_member integer NOT NULL,

    CONSTRAINT favourite_PK PRIMARY KEY (id_recipe, id_member),
    CONSTRAINT id_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_moderator (
    id_member integer NOT NULL,
    id_group integer NOT NULL,

    CONSTRAINT group_moderator_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK1 FOREIGN KEY (id_group) REFERENCES "tb_group" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_member (
    id_member integer NOT NULL,
    id_group integer NOT NULL,

    CONSTRAINT group_member_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_group_request (
    id_member integer,
    id_group integer,
    state State NOT NULL,
    timestamp datetime,

    CONSTRAINT group_request_PK PRIMARY KEY (id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN KEY (id_member) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY (id_group) REFERENCES "tb_group" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_admin (
    id serial,
    email text UNIQUE NOT NULL,
    password text NOT NULL,
    name text NOT NULL,
    username text UNIQUE NOT NULL,

    CONSTRAINT admin_PK PRIMARY KEY (id)
);

CREATE TABLE tb_following (
    id_following integer NOT NULL,
    id_followed integer NOT NULL,

    CONSTRAINT following_diff_CK CHECK (id_following <> id_followed),
    CONSTRAINT following_PK PRIMARY KEY (id_following, id_followed),
    CONSTRAINT following_following_FK FOREIGN KEY (id_following) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT following_followed_FK FOREIGN KEY (id_followed) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_message (
    id serial,
    text text NOT NULL,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_sender integer NOT NULL,

    CONSTRAINT message_PK PRIMARY KEY (id),
    CONSTRAINT message_receiver_FK FOREIGN KEY (id_receiver) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT message_sender_FK FOREIGN KEY (id_sender) REFERENCES "tb_member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT not_same_user_CK CHECK (id_receiver <> id_sender)
);

CREATE TABLE tb_comment (
    id serial,
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
    CONSTRAINT id_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT father_comment_FK FOREIGN KEY (father_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_comment_notification (
    id serial,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_comment integer NOT NULL,

    CONSTRAINT comment_notification_PK PRIMARY KEY (id),
    CONSTRAINT id_receiver_FK FOREIGN KEY (id_receiver) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_delete_notification (
    id serial,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    name_recipe text NOT NULL,

    CONSTRAINT delete_notification_PK PRIMARY KEY (id),
    CONSTRAINT id_receiver_FK FOREIGN KEY (id_receiver) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_favourite_notification (
    id serial,
    read boolean DEFAULT FALSE NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_caused_by integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT favourite_notification_PK PRIMARY KEY (id),
    CONSTRAINT id_receiver_FK FOREIGN KEY (id_receiver) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_caused_by_FK FOREIGN KEY (id_caused_by) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT not_same_user_CK CHECK (id_receiver <> id_caused_by)
);

CREATE TABLE tb_comment_report (
    id serial,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active text NOT NULL,
    id_comment integer NOT NULL,

    CONSTRAINT comment_report_PK PRIMARY KEY (id),
    CONSTRAINT id_reporter_FK FOREIGN KEY (id_reporter) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_comment_FK FOREIGN KEY (id_comment) REFERENCES "tb_comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_recipe_report (
    id serial,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active text NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT recipe_report_PK PRIMARY KEY (id),
    CONSTRAINT id_reporter_FK FOREIGN KEY (id_reporter) REFERENCES "tb_member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY (id_recipe) REFERENCES "tb_recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

