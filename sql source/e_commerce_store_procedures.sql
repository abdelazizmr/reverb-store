USE `e_commerce_store`;
DROP procedure IF EXISTS `e_commerce_store`.`get_countries`;


DELIMITER $$
CREATE PROCEDURE `get_countries`()
BEGIN
	select  distinct country from products order by country;
END$$

DELIMITER ;