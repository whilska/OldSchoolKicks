--create_display_specials_view.sql

CREATE OR REPLACE VIEW display_specials_view AS
SELECT
	sp.id AS id,
	sh.id AS shoe_id,
	sh.shoe_name AS shoe_name,
	sh.shoe_desc AS shoe_desc,
	sp.special_price AS special_price,
	sh.quantity AS quantity,
	sh.pic_link AS pic_link
FROM
	specials sp
JOIN shoes sh ON sp.shoe_id = sh.id
JOIN (SELECT MAX(ID) AS id FROM specials WHERE end_date >= NOW() AND start_date <= NOW() GROUP BY shoe_id) mx ON sp.id = mx.id 
WHERE 
	sh.quantity > 0;