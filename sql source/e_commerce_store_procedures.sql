USE `e_commerce_store`;
DROP procedure IF EXISTS `e_commerce_store`.`get_countries`;


DELIMITER $$
CREATE PROCEDURE `get_countries`()
BEGIN
	select  distinct country from products order by country;
END$$

DELIMITER ;

//-------

USE `e_commerce_store`;
DROP procedure IF EXISTS `e_commerce_store`.`get_ordered_products`;


DELIMITER $$

CREATE PROCEDURE `get_ordered_products`(in order_id int)
BEGIN
	select * from shopping_cart s where s.order_id = order_id; 
END

DELIMITER ;