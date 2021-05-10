-- Includes stuff to be executed after the execution of populate.pgsql

-- Recipes FTS

DROP MATERIALIZED VIEW IF EXISTS recipes_fts_view;
CREATE MATERIALIZED VIEW recipes_fts_view AS
    SELECT tb_recipe.id AS recipe_id, tb_recipe.id_category as id_category, tb_recipe.difficulty as difficulty, tb_recipe.name AS recipe_name, tb_member.id AS member_id, tb_member.name AS member_name,
        tb_category.name AS category, string_agg(tb_tag.name, ' ') AS tag,
        (setweight(to_tsvector('english', tb_recipe.name), 'A') ||
        setweight(to_tsvector('english', tb_category.name), 'B') ||
        setweight(to_tsvector('english', coalesce(string_agg(tb_tag.name, ' '), '')), 'B') ||
        setweight(to_tsvector('simple', tb_member.name), 'C')) AS search
    FROM tb_recipe
    JOIN tb_member ON tb_recipe.id_member = tb_member.id
    JOIN tb_category ON tb_recipe.id_category = tb_category.id
    LEFT JOIN tb_tag_recipe ON tb_recipe.id = tb_tag_recipe.id_recipe
    LEFT JOIN tb_tag ON tb_tag_recipe.id_tag = tb_tag.id
    GROUP BY tb_recipe.id, tb_member.id, tb_category.name
    ORDER BY tb_recipe.id;

DROP INDEX IF EXISTS recipes_fts;
CREATE INDEX recipes_fts ON recipes_fts_view USING GIN(search);

DROP FUNCTION IF EXISTS recipes_fts_UDF() CASCADE;
CREATE OR REPLACE FUNCTION recipes_fts_UDF()
RETURNS void AS $$
BEGIN
    REFRESH MATERIALIZED VIEW recipes_fts_view;
END
$$ LANGUAGE plpgsql;
