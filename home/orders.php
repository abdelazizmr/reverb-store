<?php
include "header.php";
include "../login-systeme/php/classes/connection.php";
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="./style//orders.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
</head>

<body>



    <?php
    class Orders extends ConnectToDb
    {

        private $order_id;
        function __construct($order_id = -1)
        {
            $this->order_id = $order_id;
        } 
        // returns an array with orders to this user
        function get_orders($client_id)
        {
            try {
                $stmt = $this->connectToDataBase()->query("select * from orders where client_id = $client_id ");

                $orders = $stmt->fetchAll();

                return $orders;
            } catch (Exception) {
                echo '<h6 class="text-center text-danger">There is an issue try again please. 🤕</h6>';
            }
        }


        function display_orders($orders)
        {

            if (count($orders) == 0) {
                echo '<h6 class="text-center text-danger">Your shopping cart is empty 🤕</h6>';
                exit();
            }

            $totalPrice = 0;

            //iterats on the array of orders and bring product info through the get_ordered_products procedure
            foreach ($orders as $order) {
                $order_id = $order['order_id'];
                $stmt = $this->connectToDataBase()->query("call get_ordered_products($order_id)");

                $o_products = $stmt->fetch();

                $product_id = $o_products['product_id'];
                $order_date = $o_products['order_date'];
                $quantity = $o_products['quantity'];
                $title = $o_products['Title'];
                $image = $o_products['Image'];
                $price = $o_products['Price'];

                $totalunit = $price * $quantity;

                $totalPrice += $totalunit;

                


                echo '
                <form method="GET" class="d-flex flex-row justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                    
                        <div class="mr-1"><a href="./product_detail.php?id=' .$product_id. '"><img class="rounded" src="' . $image . '" width="100"></a></div>
                        <div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold">' .substr($title, 0, 20). '..</span>
                            <div class="d-flex flex-row product-desc">
                                <div class="size mr-1"><span class="text-grey">Added at : ' .$order_date. '</span></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center qty">
                            <h5 class="text-grey mt-1 mr-1 ml-1">' .$quantity. '</h5></div>
                        <div>
                            <h5 class="text-grey">$' . $totalunit. '</h5>
                        </div>
                        <a href="orders.php?remove='.$order_id.'" type="submit" name="remove" class="d-flex align-items-center remove">
                        <i class="bi bi-trash-fill text-danger"></i>
                        </a>
                    
                    </form>
                    ';
            }

            //pay button
            echo '<div class="d-flex flex-row align-items-center mt-3 mb-5 bg-white rounded"><button class="btn btn-block btn-lg ml-2 pay-button w-100 text-warning border-warning" type="button">Total Price : $'.
            $totalPrice.'</button></div>';
    
        }

        function remove_order($order_id){
            $stmt = $this->connectToDataBase()->query("delete from orders where order_id = $order_id ");
        }
    }








    echo '<div class="container my-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="p-2">
                        <h2 class="text-center">Shopping Cart</h2>
                    </div>';
    $order = new Orders();
    $orders = $order->get_orders($_SESSION['ID']);
    $order->display_orders($orders);

    if (isset($_GET['remove'])){
        $order->remove_order($_GET['remove']);
        header('location: orders.php');
        exit();
    }


    echo ' 
        
    </div></div></div>';

    ob_end_flush();

    ?>
</body>

</html>