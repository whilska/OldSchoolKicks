--create_admin_specials_view.sql

CREATE OR REPLACE VIEW admin_specials_view AS
SELECT
	sp.id AS id, 
	sh.id AS shoe_id,
	sh.shoe_name AS shoe_name,
	sp.special_price AS special_price,
	sp.start_date AS start_date,
	sp.end_date AS end_date,
	CASE WHEN v.id IS NULL THEN 0 ELSE 1 END AS active_flag 
FROM 
	specials sp
JOIN shoes sh ON sp.shoe_id = sh.id
LEFT JOIN display_specials_view v ON sp.id = v.id;