DELIMITER //
DROP PROCEDURE IF EXISTS proc_addToCart
//
CREATE PROCEDURE proc_addToCart (IN shoe_id int, IN user_email varchar(200))
BEGIN
DECLARE shoe_quantity int;
DECLARE result_code int;
START TRANSACTION;
	SELECT quantity INTO shoe_quantity FROM shoes WHERE shoes.id = shoe_id;
	IF shoe_quantity > 0 THEN
		INSERT INTO cart (shoe_id,user_email) VALUES (shoe_id,user_email);
        UPDATE shoes SET quantity = shoe_quantity - 1 WHERE id = shoe_id;
        SET result_code = 1;
	ELSE
		SET result_code = 0;
    END IF;
    SELECT result_code;
COMMIT;
END
//
DELIMITER ;
