<?php
    include "header.php";
    include "../login-systeme/php/classes/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="style/product.css" rel="stylesheet" />
    <title>Product</title>
</head>

<body>
    <!-- Navigation-->

    <!-- Product section-->

    <?php
   

    class Product_detail extends ConnectToDb
    {
        function get_product($id)
        {

            $stmt = $this->connectToDataBase()->prepare("select * from products where product_id = ? ");

            if (!$stmt->execute(array($id))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select * from products where product_id = '$id' ");

            $products = $stmt->fetch(PDO::FETCH_ASSOC);

            $title = $products['Title'];
            $image = $products['Image'];
            $price = $products['Price'];
            $b = $price + 50; 
            $ex_price = sprintf("%.2f", $b);
            $condition = $products['Condition'];
            $country = $products['Country'];

            echo '<section class="py-5">
            <div class="container px-4 px-lg-5 my-3">
                <div class="row gx-4 gx-lg-5 align-items-center shadow p-3 mb-5 bg-body rounded">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 rounded " src="' . $image . '" alt="product picture" /></div>
                    <div class="col-md-6">
                        
                        <h3 class="fw-bolder text-primary">' . $title . '</h3>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$' . $ex_price . '</span>
                            <span class="ms-2 paper">$' . $price . '</span>
                        </div>
                        <div class="small mb-2 paper"><strong>Shipping </strong> : <i>Free</i></div>
                        <div class="small mb-2 paper"><strong>Country </strong> : <i> ' . $country . '</i></div>
                        <div class="small mb-2 paper"><strong>Condition </strong> : <i> ' . $condition . '</i></div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" min="1" type="num" value="1" style="max-width: 3rem ; background-color:#eee" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
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
            </div>
        </section>';

        //echo $_SESSION['ID'];
        }
    }
    $id = $_GET['id'];
    $product = new Product_detail();
    $product->get_product($id);
    ?>


    
    <!-- </section> --> 
</body>

</html>