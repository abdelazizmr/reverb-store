<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create an account</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="style/style.css">
</head>
<body>

    <main class="container">
         
    <section class="form mx-auto mt-5">
            <form method="post" action="./php/admin-log.php">
                <div class="mb-2">
                    <label for="exampleInputEmail1" class="form-label">Admin username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-2">
                    <label for="exampleInputPassword1" class="form-label">Admin password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div> 
                <button type="submit" class="btn btn-success mt-3" name="log">Log in</button>
            </form>

        
        </section>
        
    </main>
    


</body>
</html>


