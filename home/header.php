<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/header.css">
<!-- fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <header class="mb-5">
    <nav>
        <a href="home.php"><h3>X_SHOP</h3></a>
        
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Products</a></li>
            <li><a href="">About us</a></li>
        </ul>
        
            
        <form class="navbar-form" method="post">
        <?php
                if ($_SESSION['USERNAME']){
                    $user = $_SESSION['USERNAME'];
                    $id = $_SESSION['ID'];

                    echo "<button class='btn btn-primary username'>$user[0]</button>";
                }
                // }else{
                //     echo '<h4>Hello stranger</h4>';
                // }
        ?>
            <button  id='btnToggle' class='btn btn-primary'><i class='fa-solid fa-angle-down'></i></button>
            <ul id="bar" class="hide">

                <li><a href="update-profil.php">Edit Your Profile</a></li>
                <li><a href="">Favourite items</a></li>
                <li><a href="">Settings</a></li>
                <button class="btn btn-primary" type="submit" name="logout">log out</button>
            </ul>
        </form>
    </nav>
    </header>
    
    





    <?php

    if (isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('location:../login-systeme/index.php');
    }
    ?>

    

<script>
    let togglebutton = document.getElementById('btnToggle')

    togglebutton.addEventListener("click", toggleBar)
    function toggleBar(e){
        e.preventDefault();
        console.log(e);
        // console.log(document.getElementById('bar'));
        document.getElementById('bar').classList.toggle('hide');
    }
</script>
</body>
</html>