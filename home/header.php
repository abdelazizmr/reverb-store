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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <!-- mycss -->
    <link rel="stylesheet" href="style/header.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body style="background-color:#f6f6f6">

    <header class="mb-5" style="background-color: white;">


        <nav class="navbar navbar-light bg-light" style="background-color: white !important">
            <div class=" container">
                <a href="home.php" class="navbar-brand">
                    <h2 class="text-center">REVERB</h2>
                </a>
                <form class="d-flex" method="post" action="home.php">
                    <input class="form-control" type="search" name="search" placeholder="Searcha product" aria-label="Search">
                    <button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <?php
                    if ($_SESSION['USERNAME']) {
                        $user = $_SESSION['USERNAME'];
                        $id = $_SESSION['ID'];

                        echo "<button id='btnToggle' class='btn btn-primary rounded-circle ms-2 username'>$user[0] </button>";
                    }
                    ?>

                    <ul id="bar" class="hide">

                        <li><a href="update-profil.php">Edit Your Profile</a></li>
                        <li><a href="">Favourite items</a></li>
                        <li><a href="">Settings</a></li>
                        <button class="btn btn-primary" type="submit" name="logout">log out</button>
                    </ul>
                </form>

            </div>

        </nav>

    </header>












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