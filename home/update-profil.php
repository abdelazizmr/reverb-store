<?php
include "header.php";

?>

<div class="container-xl px-4 mt-5">

        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2 w-100" src="https://st4.depositphotos.com/11634452/21365/v/600/depositphotos_213659488-stock-illustration-picture-profile-icon-human-people.jpg" alt="">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <input class="btn btn-primary" type="file">Upload new image</input>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="update-info/update-profil.inc.php" method="POST">

                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username *</label>
                                <?php
                                    if ($_SESSION['USERNAME']){
                                        $user = $_SESSION['USERNAME'];;

                                        echo "<input class='form-control' name='username' type='text' value='$user' disabled>";
                                    }else{
                                        echo "<input class='form-control' name='username' type='text' value=''>";
                                    }
                                ?>
                                
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Your name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter your name" value="">
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Phone number</label>
                                    <input class="form-control" name="phone" type="text" placeholder="Enter your phone number" >
                                </div>
                            </div>


                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address *</label>
                                
                                <?php
                                    if ($_SESSION['EMAIL']){
                                        $email = $_SESSION['EMAIL'];
                                        echo "<input class='form-control' name='email' type='email' value='$email' disabled>";
                                    }else{
                                        echo '<input class="form-control" name="email" type="email" placeholder="Enter your email address" value="name@example.com">';
                                    }
                                ?>
                            </div>

                            <!-- home adress -->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Home address</label>
                                <input class="form-control" name="home-adress" type="email" placeholder="AV example street xxx nr 000">
                            </div>
                            <!-- Form update pwd-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (password)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">New assword</label>
                                    <input class="form-control" placeholder="New password" name="password" type="password"  value="">
                                </div>
                                <!-- Form Group (confirm pwd)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Confirm new password</label>
                                    <input class="form-control" placeholder="Confirm new password" type="password" name="cpassword">
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary mt-3" type="submit" name="save">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>