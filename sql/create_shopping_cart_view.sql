--create_shopping_cart_view.sql

CREATE OR REPLACE VIEW shopping_cart_view AS
SELECT 
	c.id AS id,
	s.id AS shoe_id,
	s.shoe_name AS shoe_name,
	s.price AS price,
	v.special_price AS special_price,
	c.user_email AS email
FROM cart c 
LEFT JOIN display_specials_view v on c.shoe_id = v.shoe_id
LEFT JOIN shoes s ON c.shoe_id = s.id;