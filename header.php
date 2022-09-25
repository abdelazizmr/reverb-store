<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        body{
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a{
            text-decoration: none;
            color: black;
        }
        nav {
            height: 80px;
            background-color: #f6f6f6;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        nav ul{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
        }
        nav ul li {
            list-style-type: none;
        }
        nav ul li a:hover{
            color: lightblue;
        }
        nav ul button{
            padding: 5px 10px;
        }

        /* form */
        main{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top:50px;
        }
        form {
            border: 2px dashed gray;
            padding: 20px;
            width:500px;
            background-color: #f6f6f6ff;
            font-weight:bold;
        }
        form button{
            padding:5px 10px;
            margin-bottom : 10px;
            margin-right:10px;
            cursor: pointer;
            font-weight:bold;
        }
        input {
            height:30px;
            width:100%;
            margin-bottom : 10px;
            padding-left:10px;
            outline:none;
            border:none;
        }
        input:focus{
            border:2px solid lightblue;
        }
        .error{
            color:red;
            text-align:center;
            padding-top:10px;
        }

    </style>
</head>
<body>
    <nav>
        <h2>Store</h2>
        <ul>
            <li><a id="client" href="clients.php">Client</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="achats.php">Achats</a></li>
            <button disabled>Log out</button>
        </ul>
    </nav>
</body>




</html>
