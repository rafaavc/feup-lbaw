-- 17 - Create review

INSERT INTO tb_comment(text, rating, id_member, id_recipe) 
VALUES("Absolutely delicious!", 5, 1, 1);

-- 1 - Member Information

SELECT tb_member.name, tb_member.username, tb_member.city, tb_member.bio, tb_member.visibility, tb_member.score, tb_country.name
FROM tb_member
JOIN tb_country ON tb_member.id_country = tb_country.id;
