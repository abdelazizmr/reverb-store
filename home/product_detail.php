<?php
include "header.php";
include "../login-systeme/php/classes/connection.php";

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link href="style/product.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>


<body>


    <?php
    class Product_detail extends ConnectToDb
    {
        private $title;
        private $image;
        private $price;
        private $condition;
        private $country;

        function __construct($title ='', $image='' , $price='', $condition='', $country='')
        {
            $this->title = $title;
            $this->image = $image;
            $this->price = $price;
            $this->condition = $condition;
            $this->country = $country;
            
        }

        //getting a product with id from Get method
        function get_product($id){

            $stmt = $this->connectToDataBase()->prepare("select * from products where product_id = ? ");

            if (!$stmt->execute(array($id))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select * from products where product_id = '$id' ");

            $products = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $products['Title'];
            $this->image = $products['Image'];
            $this->price = $products['Price'];
            $b = $this->price + 100;
            $ex_price = sprintf("%.2f", $b);
            $this->condition = $products['Condition'];
            $this->country = $products['Country'];

            echo '<section class="py-5">
                <form class="container px-4 px-lg-5 my-3" method="POST">
                <div class="row gx-4 gx-lg-5 align-items-center shadow p-3 mb-5 bg-body rounded">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 rounded " src="' . $this->image . '" alt="product picture" /></div>
                    <div class="col-md-6">
                        
                        <h3 class="fw-bolder text-primary">' . $this->title . '</h3>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$' . $ex_price . '</span>
                            <span class="ms-2 paper">$' . $this->price . '</span>
                        </div>
                        <div class="small mb-2 paper"><strong>Shipping </strong> : <i>Free</i></div>
                        <div class="small mb-2 paper"><strong>Country </strong> : <i> ' . $this->country . '</i></div>
                        <div class="small mb-2 paper"><strong>Condition </strong> : <i> ' . $this->condition . '</i></div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" min="1" type="num" value="1" style="max-width: 3rem ; background-color:#eee" name="quantity" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="add">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                            <button class="btn btn-primary ms-2" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Buy now
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>';

        }

        //checking of the order is already ordered : returns -> false || order_id
        function is_ordered($product_id,$client_id){

            $stmt = $this->connectToDataBase()->prepare("select count(order_id) from orders where product_id = ? and client_id = ? ");

            if (!$stmt->execute(array($product_id,$client_id))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select order_id,count(order_id) as count from orders where product_id = '$product_id' and client_id = '$client_id' ");

            $result = $stmt->fetch();

            if ($result['count'] == 0){
                //echo "never ordered";
                return false;
            }

            //echo "already ordered";
            //print_r($result['count']);
            return $result['order_id'];

        }

        //place an order for first time
        function place_order($product_id,$client_id,$quantity,$order_date){
            $stmt = $this->connectToDataBase()->prepare("insert into orders(order_id,product_id,client_id,quantity,order_date) values(0,?,?,?,?)");

            if (!$stmt->execute(array($product_id,$client_id,$quantity,$order_date))) {
                $stmt = null;
                header('location:product_detail.php?error=nvalid_order');
                exit();
            }

            // $stmt = $this->connectToDataBase()->query("insert into orders(order_id,product_id,client_id,quantity,order_date) values(0,'$product_id','$client_id','$quantity','$order_date')");

            //$stmt->execute();

            $stmt = null;


        }

        //updated an order already exist to the same user
        function update_quantity($order_id,$quantity){
            $stmt = $this->connectToDataBase()->query("update orders set quantity = '$quantity' where order_id = '$order_id' ");
        }

    }

    //product_id getting it through method 
    $product_id = $_GET['id'];
    //client_id from the session when logged in
    $client_id  = $_SESSION['ID'];
    $product = new Product_detail();
    $product->get_product($product_id);
    

    if(isset($_POST['add'])){
        $quantity = $_POST['quantity'];
        $date = date("Y-m-d H:i:s"); //datetime of now
        if(empty($quantity)){
            echo "<script>alert('You must enter the quantity to place the order')</script>";
            exit();
        }

        if (!$product->is_ordered($product_id, $client_id)) {
            //* not ordered yet
            $product->place_order($product_id,$client_id,$quantity,$date);

            echo "<script>alert('Product has been added to your card ✅')</script>";

            exit();
        }
            
        //* already ordered    

        $result = $product->is_ordered($product_id, $client_id);

        $product->update_quantity($result, intval($quantity));

        echo "<script>alert('Updated the quantity for this product ✅')</script>";

    }



    ?>

</body>

</html>