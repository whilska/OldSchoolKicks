--create_shoppers_report_view.sql
CREATE OR REPLACE VIEW shoppers_report_view AS
SELECT
	v.email AS user_email,
	u.lastname AS lastname,
	u.firstname AS firstname,
	v.shoe_name AS shoe_name,
	v.shoe_id AS shoe_id
FROM
	shopping_cart_view v
LEFT JOIN 
	users u ON u.email = v.email;