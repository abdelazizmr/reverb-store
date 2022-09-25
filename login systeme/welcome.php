<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login success</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        nav{
            
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:20px;
            background-color: #caca5a;
            margin-bottom : 100px
        }
        ul{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:20px
        }
        ul li{
            list-style:none;
            font-weight:bold;
            color:white;
            text-transform : uppercase;
        }
        button{
            padding:5px;
            font-weight:bold
        }form{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:20px;
            color : white
        }
        button{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li>home</li>
            <li>blogs</li>
            <li>contact</li>
        </ul>
        <form method="post">
            <?php
                if ($_SESSION['USERNAME']){
                    $user = $_SESSION['USERNAME'];
                    $id = $_SESSION['ID'];
                    echo "<h4>$user</h4>";
                    echo "<h4>$id</h4>";
                }else{
                    echo '<h4>Hello stranger</h4>';
                }
            ?>
            <button type="submit" name="logout">log out</button>
        </form>
    </nav>
    

    <?php

    if (isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('location:index.php');
    }
    ?>

    
</body>
</html>