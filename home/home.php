<?php
include "header.php";
include "../login-systeme/php/classes/connection.php";


class Products extends ConnectToDb
{


    //* display products on load
    function displayProducts($limit)
    {
        try {
            $stmt = $this->connectToDataBase()->query("select * from products order by product_id desc limit $limit");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->getProducts($products);
        } catch (Exception) {
            echo "<h4 class='h4 text-center text-danger'>Sorry something wrong at this moment! try again later</h4>";
        }
    }

    //* search a product by name 
    function searchProduct($product)
    {
        try {
            $stmt = $this->connectToDataBase()->prepare("select * from products where title like ? ");

            if (!$stmt->execute(array($product))) {
                $stmt = null;
                header('location:home.php?error=search_invalid');
                exit();
            }

            $stmt = $this->connectToDataBase()->query("select * from products where title like '%$product%' ");

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) == 0) {
                echo "<h4 class='h4 text-center text-danger'>This product does not exist</h4>";
                exit();
            }

            $this->getProducts($products);
        } catch (Exception) {
            echo "<h4 class='text-center text-danger'>This product does not exist</h4>";
        }
    }

    //* took an array as parameter and create products cards
    function getProducts($arr)
    {
        foreach ($arr as $product) {
            $id = $product['product_id'];
            $title = $product['Title'];
            $image = $product['Image'];
            $price = $product['Price'];
            $condition = $product['Condition'];
            $country = $product['Country'];


            echo '
                <div class="card shadow bg-body rounded border-right-0" style="width: 18rem;">
                    <a href="product_detail.php?id='.$id.'">
                    <img src="' . $image . '" class="card-img-top" alt="product-image">
                    <div class="card-body">
                        <h6 class="card-text text-primary mb-3">' . $title . '</h6>
                        <p class="card-text"><strong>' . $price . '$</strong></p>
                        <div class="d-flex justify-content-between">
                        <span class="card-text">' . $condition . '</span>
                        <span class="card-text text-primary"><i class="bi bi-caret-right-fill"></i>' . $country . '</span>
                        </div>
                    </div>
                    </a>
                </div>';
        }
    }

    //* countries on the select menu
    function getCountries()
    {
        $stmt = $this->connectToDataBase()->query("CALL get_countries()");
        $countries = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($countries as $country) {
            $name = $country["country"];
            echo "<option value='$name'>$name</option>";
        }
    }

    //* filtering products by country
    function filter_products($min,$max,$country){
        try {
            $stmt = $this->connectToDataBase()->prepare('select * from products where Country = ? and Price between ? and ?');

            //print_r(array('min' => $min, 'max' => $max, 'country' => $country));

            if ($country == 'Choose by Country'){
                if($min == '' and $max == ''){
                    echo "<h4 class='h4 text-center text-danger'>No products found ☹</h4>";
                    exit();
                }elseif ($max != '' and $min != ''){
                    $stmt = $this->connectToDataBase()->query("select * from products where Price between '$min' and '$max' order by Price desc ");
                }elseif ($max != '' and $min == ''){
                    $stmt = $this->connectToDataBase()->query("select * from products where Price < '$max' order by Price desc ");
                }elseif ($max == '' and $min != ''){
                    $stmt = $this->connectToDataBase()->query("select * from products where Price > '$min' order by Price asc ");
                }
                elseif ($min >= $max) {
                    echo "<h4 class='h4 text-center text-danger'>No products found ☹</h4>";
                    exit();
                }

                
            }elseif($min == '' and $max == ''){
                $stmt = $this->connectToDataBase()->query("select * from products where Country = '$country' ");
            }

            elseif($min != ''){
                $stmt = $this->connectToDataBase()->query("select * from products where Country = '$country' and Price > '$min' order by Price asc ");
            } 
            elseif ($max != '') {
                $stmt = $this->connectToDataBase()->query("select * from products where Country = '$country' and Price < '$max' order by Price desc ");
            }

            else{
                
                $stmt = $this->connectToDataBase()->query("select * from products where Country = '$country' and Price between '$min' and '$max' ");
            }

           

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($products) == 0){
                echo "<h4 class='h4 text-center text-danger'>No products found ☹</h4>";
                exit();
            }

            $this->getProducts($products);

        } catch (Exception) {
            echo "<h4 class='h4 text-center text-danger'>Sorry something wrong at this moment! try again later</h4>";
        }
    }

}



echo '<section class="filter-products mb-3">
        <form method="POST" class="d-flex container justify-content-center gap-3">
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" min="0" class="form-control" placeholder="min price" name="min-price">
            </div>
    
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" min="0" class="form-control" placeholder="max price" name="max-price">
            </div>
            <select name="countries" class="form-select me-1">
                <option selected>Choose by Country</option>
                ';
        //? getting the countries through the getCountries method from products class
        $country = new Products();
        $country->getCountries();
    
echo '</select>
            <button type="submit" class="btn btn-primary" name="filter">Filter</button>
        </form>;
    </section>';

echo '<div class="container d-flex flex-wrap justify-content-center gap-4 mb-5">';

        





//* create a products object and excute the methods respectively
function excute(){
    $products = new Products();

    if (isset($_POST['search'])) {
        $input = $_POST['search'];
        if ($input == ''){
            $products->displayProducts(45);
            exit();
        }
        $products->searchProduct($input);
        exit();
    }

    //$products->getCountries();

    if (isset($_POST['filter'])) {
        $minPrice = $_POST['min-price'];
        $maxPrice = $_POST['max-price'];
        $countries = $_POST['countries'];

        $products->filter_products($minPrice,$maxPrice,$countries);
        exit();
    }

    $products->displayProducts(45);

    
}

excute();


echo "</div>";

?>