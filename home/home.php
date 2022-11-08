<?php
include "header.php";
include "../login-systeme/php/classes/connection.php"; 

echo '<div class="container d-flex flex-wrap justify-content-center gap-4 mb-5">';

        


class Products extends ConnectToDb{


    //* display products on load
    function displayProducts($limit){
        try{
            $stmt = $this->connectToDataBase()->query("select * from products order by product_id desc limit $limit");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->getProducts($products);

            
        }catch(Exception){
            echo "<h4 class='h4 text-center text-danger'>Sorry something wrong at this moment! try again later</h4>";
        }
    }

    //* search a product by name 
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

    //* took an array as parameter and create products cards
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

    //* countries on the select menu
    function get_countries(){
        $stmt = $this->connectToDataBase()->query("CALL get_countries()");
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        echo '<form method="POST" class= "d-flex container justify-content-end">
                <select name="countries" class="my-3 p-2 me-1">';

        foreach($countries as $country){

        $name = $country["country"];
            echo "<option value='$name'>$name</option>";        
        }

        echo '</select> <button type="submit" name="confirm" style="border:none;background-color:transparent">confirm</button>
        </form>';
    }

    //* filtering products by country
    function filter_countries($country){
        try{
            $stmt = $this->connectToDataBase()->prepare('select * from products where Country = ?');

            if (!$stmt->execute(array($country))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select * from products where Country='$country' ");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->getProducts($products);
        
        }catch (Exception) {
            echo "<h4 class='h4 text-center text-danger'>Sorry something wrong at this moment! try again later</h4>";
        }
        
    }
        
        
}


//* create a products object and excute the methods respectively
function excute(){
    $products = new Products();

    if (isset($_POST['search'])) {
        $input = $_POST['search'];
        $products->searchProduct($input);
        exit();
    }

    $products->get_countries();


    if (isset($_POST['confirm'])) {
        $products->filter_countries($_POST['countries']);
        exit();
    }

    $products->displayProducts(45);

    
}

excute();


echo "</div>";

?>