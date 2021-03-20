CREATE DOMAIN "datetime" AS timestamp with time zone DEFAULT now() NOT NULL;
CREATE TYPE Difficulty AS ENUM('easy', 'medium', 'hard', 'very hard') NOT NULL;
CREATE TYPE State AS ENUM('pending', 'accepted', 'rejected') NOT NULL;

CREATE TABLE frequently_asked_question (
    id SERIAL,
    question text NOT NULL,
    answer text NOT NULL,

    CONSTRAINT frequently_asked_question_PK PRIMARY KEY(id)
);

CREATE TABLE unit (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT unit_PK PRIMARY KEY(id)
);

CREATE TABLE conversion (
    unit_1 integer NOT NULL,
    unit_2 integer NOT NULL,
    
    CONSTRAINT conversion_PK PRIMARY KEY(unit_1, unit_2),
    CONSTRAINT unit_1_FK FOREIGN KEY(unit_1) REFERENCES "unit" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT unit_2_FK FOREIGN KEY(unit_2) REFERENCES "unit" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ingredient_recipe (
    recipe_id integer NOT NULL,
    ingredient_id integer NOT NULL,
    unit_id integer NOT NULL,
    quantity real,

    CONSTRAINT ingredient_recipe_PK PRIMARY KEY(recipe_id, ingredient_id),
    CONSTRAINT recipe_id_FK FOREIGN KEY(recipe_id) REFERENCES "recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ingredient_id_FK FOREIGN KEY(ingredient_id) REFERENCES "ingredient" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT non_negative_quantity CHECK(quantity >= 0) 
);

CREATE TABLE ingredient (
    id SERIAL,
    name text NOT NULL,
    
    CONSTRAINT ingredient_PK PRIMARY KEY(id)
);

CREATE TABLE tag (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT tag_PK PRIMARY KEY(id) 
);

CREATE TABLE tag_recipe (
    id_tag integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT tag_recipe_PK PRIMARY KEY(id_tag, id_recipe),
    CONSTRAINT id_tag_FK FOREIGN KEY(id_tag) REFERENCES "tag" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY(id_recipe) REFERENCES "recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE category (
    id SERIAL,
    name text NOT NULL,

    CONSTRAINT category_PK PRIMARY KEY(id)
);

CREATE TABLE step (
    id SERIAL,
    name text NOT NULL,
    description text,
    id_recipe integer NOT NULL,

    CONSTRAINT step_PK PRIMARY KEY(id),
    CONSTRAINT id_recipe_PK FOREIGN KEY(id_recipe) REFERENCES "recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- Rui

-- R10
CREATE TABLE recipe ( -- Switch order
    id SERIAL,
    name text NOT NULL,
    difficulty text,
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
    score real 
 
    CONSTRAINT recipe_PK PRIMARY KEY(id),
    CONSTRAINT id_member_FK1 FOREIGN KEY(id_member) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_category_FK FOREIGN KEY(id_category) REFERENCES "category" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY(id_group) REFERENCES "group" (id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT servings_CK CHECK(servings > 0),
    CONSTRAINT preparation_time_CK CHECK(preparation_time >= 0),
    CONSTRAINT cooking_time_CK CHECK(cooking_time >= 0),
    CONSTRAINT additional_time_CK CHECK(additional_time >= 0)
);

CREATE TABLE favourite (
    id_recipe integer NOT NULL,
    id_member integer NOT NULL,

    CONSTRAINT favourite_PK PRIMARY KEY(id_recipe, id_member),
    CONSTRAINT id_recipe_FK FOREIGN KEY(id_recipe) REFERENCES "recipe" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_member_FK FOREIGN KEY(id_member) REFERENCES "member" ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE group (
    id SERIAL,
    name text NOT NULL,
    description text NOT NULL,
    visibility boolean NOT NULL,

    CONSTRAINT group_PK PRIMARY KEY(id)
);

-- R13
CREATE TABLE group_moderator (
    id_member integer NOT NULL,
    id_group integer NOT NULL,
    
    CONSTRAINT group_moderator_PK PRIMARY KEY(id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN(id_member) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK1 FOREIGN(id_group) REFERENCES "group" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE group_member (
    id_member integer NOT NULL,
    id_group integer NOT NULL,
    
    CONSTRAINT group_member_PK PRIMARY KEY(id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN KEY(id_member) REFERENCES "member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY(id_group) REFERENCES "group" ON DELETE CASCADE ON UPDATE CASCADE    
);

-- R15
CREATE TABLE group_request (
    id_member integer,
    id_group integer,
    state State NOT NULL,
    timestamp datetime,
    
    CONSTRAINT group_request_PK PRIMARY KEY(id_member, id_group),
    CONSTRAINT id_member_FK FOREIGN KEY(id_member) REFERENCES "member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_group_FK FOREIGN KEY(id_group) REFERENCES "group" ON DELETE CASCADE ON UPDATE CASCADE
);

-- Rafael


-- R16
CREATE TABLE admin {
    id SERIAL,
    email text UNIQUE NOT NULL, 
    password text NOT NULL,
    name text NOT NULL,
    username UNIQUE NOT NULL,

    CONSTRAINT admin_PK PRIMARY KEY(id)
};

-- R17
CREATE TABLE member {
    id SERIAL,
    email text UNIQUE NOT NULL, 
    password text NOT NULL,
    name text NOT NULL,
    username UNIQUE NOT NULL,
    city text,
    bio text,
    visibility boolean DEFAULT false NOT NULL,
    is_banned boolean DEFAULT false NOT NULL,
    country_id integer NOT NULL,
    score real,
    
    CONSTRAINT member_PK PRIMARY KEY(id),
    CONSTRAINT member_country_FK FOREIGN KEY(country_id) REFERENCES "country" ON DELETE SET NULL ON UPDATE CASCADE
};

-- R18
CREATE TABLE following {
    id_following integer NOT NULL,
    id_followed integer NOT NULL,

    CONSTRAINT following_diff_CK CHECK(id_following <> id_followed),    
    CONSTRAINT following_PK PRIMARY KEY(id_following, id_followed),
    CONSTRAINT following_following_FK FOREIGN KEY(id_following) REFERENCES "member" ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT following_followed_FK FOREIGN KEY(id_followed) REFERENCES "member" ON DELETE CASCADE ON UPDATE CASCADE
};

-- R19
CREATE TABLE country {
    id SERIAL,
    abbreviation text NOT NULL,
    name text NOT NULL,
    
    CONSTRAINT country_PK PRIMARY KEY(id)
};

-- R20
CREATE TABLE message {
    id SERIAL,
    text text NOT NULL,
    read boolean DEFAULT false NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_sender integer NOT NULL,
    
    CONSTRAINT message_PK PRIMARY KEY(id),
    CONSTRAINT message_receiver_FK FOREIGN KEY(id_receiver) REFERENCES member ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT message_sender_FK FOREIGN KEY(id_sender) REFERENCES member ON DELETE CASCADE ON UPDATE CASCADE
};

-- R21
CREATE TABLE comment {
    id SERIAL,
    text text NOT NULL,
    rating integer,
    post_time datetime,
    id_member NOT NULL,
    id_recipe NOT NULL,
    
    CONSTRAINT comment_PK PRIMARY KEY(id),
    CONSTRAINT comment_member_FK FOREIGN KEY(id_member) REFERENCES member ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT comment_recipe_FK FOREIGN KEY(id_recipe) REFERENCES recipe ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT comment_rating_CK CHECK(rating IS NULL OR (rating >= 1 AND rating <= 5))
};

-- Alexandre

CREATE TABLE answer (
    id_comment integer,
    father_comment integer NOT NULL,
    
    CONSTRAINT answer_PK PRIMARY KEY(id_comment),
    CONSTRAINT id_comment_FK FOREIGN KEY(id_comment) REFERENCES "comment" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT father_comment_FK FOREIGN KEY(father_comment) REFERENCES "comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE comment_notification (
    id SERIAL,
    read boolean DEFAULT false NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_comment integer NOT NULL,

    CONSTRAINT comment_notification_PK PRIMARY KEY(id),
    CONSTRAINT id_receiver_FK FOREIGN KEY(id_receiver) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_comment_FK FOREIGN KEY(id_comment) REFERENCES "comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE delete_notification (
    id SERIAL,
    read boolean DEFAULT false NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    name_recipe text NOT NULL,

    CONSTRAINT delete_notification_PK PRIMARY KEY(id),
    CONSTRAINT id_receiver_FK FOREIGN KEY(id_receiver) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE favourite_notification (
    id SERIAL,
    read boolean DEFAULT false NOT NULL,
    timestamp datetime,
    id_receiver integer NOT NULL,
    id_caused_by integer NOT NULL,
    id_recipe integer NOT NULL,

    CONSTRAINT favourite_notification_PK PRIMARY KEY(id),
    CONSTRAINT id_receiver_FK FOREIGN KEY(id_receiver) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_caused_by_FK FOREIGN KEY(id_caused_by) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY(id_recipe) REFERENCES "recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT not_same_user_CK CHECK(id_receiver <> id_caused_by)
);

CREATE TABLE comment_report (
    id SERIAL,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active text NOT NULL,
    id_comment integer NOT NULL,
    
    CONSTRAINT comment_report_PK PRIMARY KEY(id),
    CONSTRAINT id_reporter_FK FOREIGN KEY(id_reporter) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_comment_FK FOREIGN KEY(id_comment) REFERENCES "comment" (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE recipe_report (
    id SERIAL,
    id_reporter integer NOT NULL,
    reason text NOT NULL,
    active text NOT NULL,
    id_recipe integer NOT NULL,
    
    CONSTRAINT recipe_report_PK PRIMARY KEY(id),
    CONSTRAINT id_reporter_FK FOREIGN KEY(id_reporter) REFERENCES "member" (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT id_recipe_FK FOREIGN KEY(id_recipe) REFERENCES "recipe" (id) ON DELETE CASCADE ON UPDATE CASCADE
);