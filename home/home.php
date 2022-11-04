<?php
include "header.php";
include "../login-systeme/php/classes/connection.php"; 
echo '<div class="container d-flex flex-wrap justify-content-center gap-4">';

class Products extends ConnectToDb{

    function displayProducts($limit){
        try{
            $stmt = $this->connectToDataBase()->query("select * from products order by product_id desc limit $limit");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->getProducts($products);

            
        }catch(Exception){
            echo "<h4 class='h4 text-center text-danger'>Sorry something wrong at this moment! try again later</h4>";
        }
    }

    function searchProduct($product){
        try{
            $stmt = $this->connectToDataBase()->prepare("select * from products where title like ? ");

            if (!$stmt->execute(array($product))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select * from products where title like '%$product%' ");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) == 0){
                echo "<h4 class='h4 text-center text-danger'>This product does not exist</h4>";
                exit();
            }

            $this->getProducts($products);
        }catch(Exception){
            echo "<h4 class='text-center text-danger'>This product does not exist</h4>";
        }

    }

    function getProducts($arr){
        foreach ($arr as $product) {

            $title = $product['Title'];
            $image = $product['Image'];
            $price = $product['Price'];
            $condition = $product['Condition'];
            $country = $product['Country'];


            echo '
                <div class="card shadow bg-body rounded border-right-0" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="product-image">
                    <div class="card-body">
                        <h6 class="card-text text-primary mb-3">' . $title . '</h6>
                        <p class="card-text"><strong>' . $price . '$</strong></p>
                        <div class="d-flex justify-content-between">
                        <span class="card-text">' . $condition . '</span>
                        <span class="card-text text-primary"><i class="fa-solid fa-angle-right"></i>' . $country . '</span>
                        </div>
                    </div>
                </div>';
        }
    }
}

function excute(){
    $products = new Products();

    if (isset($_POST['search'])) {
        $input = $_POST['search'];
        $products->searchProduct($input);
        exit();
    }


    $products->displayProducts(3);
}

excute();


echo "</div>";

?>