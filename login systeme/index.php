<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my login system</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
<!-- fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>

    <main class="container">
        <section>
            <img src="style/illustration-woman-online-desktop.svg" alt="">
        </section>
        <section class="form mt-5">
            
            <form action="./php/log-in.php" method="post">
                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} else{echo '';}  ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" 
                    value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} else{echo '';}  ?>">
                    <div id="emailHelp" class="form-text"><a href="reset.php">Forget password</a></div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary my-2" name="log">Log in</button>

                <div class="line">
                    <hr>
                    <p>or</p>
                    <hr>
                </div>
                
            </form>
            <div id="failure"></div>
            <button class="btn btn-success mt-2" id="btn" name="log">Sign up</button>
        </section>
    </main>

    <footer>
        <ul>
            
            <li><a href=""><i class="fa-solid fa-earth-americas"></i>Language</a></li>
            <li><a href="">Privacy Policies</a></li>
            <li><a href="">About us</a></li>
            <li><a href="admin.php">Admins</a></li>
        </ul>
        <ul>
            <li id="year"></li>
        </ul>
    </footer>

    
    

    <script>
        let btn = document.getElementById('btn')
        btn.addEventListener('click',(e)=>{
            e.preventDefault();
            window.location.href = "sign-up.php";
        })
    </script>

</body>
</html>