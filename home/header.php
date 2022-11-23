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
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- css for home page -->
    <link rel="stylesheet" href="style/header.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    

    <!-- bts icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body style="background-color:#f6f6f6">



    <nav class="navbar navbar-light bg-light mb-4" style="background-color: white !important">
        <div class=" container">
            <a href="home.php" class="navbar-brand">
                <h2 class="text-center">REVERB</h2>
            </a>
            <form class="d-flex" method="post" action="home.php">
                <input class="form-control" type="search" name="search" placeholder="Searcha product" aria-label="Search">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                <?php
                if ($_SESSION['USERNAME']) {
                    $user = $_SESSION['USERNAME'];
                    $id = $_SESSION['ID'];

                    echo "<button id='btnToggle' class='btn btn-primary rounded-circle ms-2 username'>$user[0] </button>";
                }
                ?>

                <ul id="bar" class="hide">

                    <li><a href="./update-profil.php">Edit Your Profile</a></li>
                    <li><a href="./orders.php">Orders</a></li>
                    <li><a href="">Settings</a></li>
                    <button class="btn btn-primary" type="submit" name="logout">log out</button>
                </ul>
            </form>

        </div>

    </nav>



    <?php

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('location:../login-systeme/index.php');
    }
    ?>



    <script>
        let togglebutton = document.getElementById('btnToggle')

        togglebutton.addEventListener("click", toggleBar)

        function toggleBar(e) {
            e.preventDefault();
            document.getElementById('bar').classList.toggle('hide');
        }
    </script>
</body>

</html>