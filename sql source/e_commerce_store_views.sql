CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `shopping_cart` AS
    SELECT 
        `o`.`order_id` AS `order_id`,
        `o`.`order_date` AS `order_date`,
        `o`.`quantity` AS `quantity`,
        `p`.`product_id` AS `product_id`,
        `p`.`Title` AS `Title`,
        `p`.`Image` AS `Image`,
        `p`.`Price` AS `Price`
    FROM
        (`orders` `o`
        JOIN `products` `p` ON ((`o`.`product_id` = `p`.`product_id`)))