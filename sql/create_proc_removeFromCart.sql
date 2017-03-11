DELIMITER //
DROP PROCEDURE IF EXISTS proc_removeFromCart
//
CREATE PROCEDURE proc_removeFromCart (IN cart_id int)
BEGIN
DECLARE shoe_quantity int;
DECLARE _shoe_id int;
DECLARE result_code int;
START TRANSACTION;
	SELECT shoe_id INTO _shoe_id FROM cart WHERE id = cart_id;
	SELECT quantity INTO shoe_quantity FROM shoes WHERE shoes.id = _shoe_id;
	DELETE FROM cart WHERE id = cart_id;
    UPDATE shoes SET quantity = shoe_quantity + 1 WHERE id = _shoe_id;
    SET result_code = 1;
    SELECT result_code;
COMMIT;
END
//
DELIMITER ;