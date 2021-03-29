-- Create recipe transaction

BEGIN;

INSERT INTO tb_recipe (name, difficulty, description, servings, preparation_time, cooking_time, additional_time, visibility, creation_time, id_member, id_category)
VALUES ($title, $difficulty, $description, $servings, $preparation_time, $cooking_time, $additional_time, $visibility, $creation_time, $id_member, $id_category);

INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);  -- this tag is repeated for each step

INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);  -- this line is repeated for each tag

INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity); -- this line is repeated for each ingredient

COMMIT;


-- Reply to comment transaction

BEGIN;

WITH new_comment AS (
    INSERT INTO tb_comment (text, rating, id_member, id_recipe) 
        VALUES ($text, NULL, $id_member, $id_recipe) RETURNING id AS new_comment_id
)
INSERT INTO tb_answer (id_comment, father_comment) SELECT new_comment_id AS id_comment, $father_comment as father_comment FROM new_comment;

COMMIT;


-- Update recipe

BEGIN;

UPDATE tb_recipe
SET difficulty = $difficulty, description = $description, servings = $servings, preparation_time = $preparation_time, 
cooking_time = $cooking_time, additional_time = $additional_time, 
visibility = $visibility, id_category = $category
WHERE id = $id_recipe;

INSERT INTO tb_step (name, description, id_recipe) VALUES ($step_name, $step_description, $id_recipe);  -- may need to add steps, may be repeated as necessary

UPDATE tb_step   -- may need to update steps, may be repeated as necessary
SET name = $new_step_name, description = $new_step_description  
WHERE id = $id_step_to_update;

DELETE FROM tb_step WHERE id = $id_step_to_delete; -- may need to delete steps, may be repeated as necessary

INSERT INTO tb_tag_recipe (id_tag, id_recipe) VALUES ($id_tag, $id_recipe);  -- may need to add tags, may be repeated as necessary

DELETE FROM tb_tag_recipe WHERE id_tag = $id_tag_to_delete AND id_recipe = $id_recipe;  -- may need to remove tags, may be repeated as necessary

INSERT INTO tb_ingredient_recipe (id_recipe, id_ingredient, id_unit, quantity) VALUES ($id_recipe, $id_ingredient, $id_unit, $quantity); -- may need to add ingredients, may be repeated as necessary

UPDATE tb_ingredient_recipe  -- may need to update recipe ingredients, may be repeated as necessary
SET id_unit = $new_id_unit, quantity = $new_quantity
WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_update;

DELETE FROM tb_ingredient_recipe WHERE id_recipe = $id_recipe AND id_ingredient = $id_ingredient_to_delete;   -- may need to delete ingredients, may be repeated as necessary

COMMIT;
