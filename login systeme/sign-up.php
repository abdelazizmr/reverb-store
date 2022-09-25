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
        <!-- <section>
            <img src="./illustration-woman-online-desktop.svg" alt="">
        </section> -->
         
    <section class="form mx-auto">
            <form action="./php/sign-up.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputPassword1" required>
                </div> 
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password1" required>
                </div> 
                <label id="invalid_pass" for="" class="form-label text-danger"></label>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm password</label>
                    <input type="password" name="cpassword" class="form-control" id="password2" required>
                </div>
                <label id="failure" for="" class="form-label text-danger"></label>
                <button type="submit" class="btn btn-success mt-2" name="log">Creat account</button>
            </form>
        
        </section>
    </main>
    

        <script defer>
            let p1 = document.getElementById('password1')
            p1.addEventListener('input',(e)=>{
                let value = e.target.value
                let error = document.getElementById('invalid_pass')
                if (value.length < 8){
                    error.style.display = 'block'
                    error.innerHTML = 'Password must have 8 characters'
                }else{
                    error.style.display = 'none'
                }
            })
            
            
            let p2 = document.getElementById('password2')
            
            p2.addEventListener('input',(e)=>{  
                let p1 = document.getElementById('password1').value  
                let value = e.target.value
                let invalid = document.getElementById('failure')
                if (value != p1){
                    invalid.style.display = 'block'
                    invalid.innerHTML = 'Password not identical'  
                }else{
                   invalid.style.display = 'none' 
                
                }
                
            })
            

    </script>

</body>
</html>