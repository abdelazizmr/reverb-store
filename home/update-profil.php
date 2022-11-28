<?php
include "header.php";
include "../login-systeme/php/classes/connection.php";
ob_start();

class UpdateProfile extends ConnectToDb
{

    function update_info($client_id, $name, $number, $adress)
    {
        try {
            $stmt = $this->connectToDataBase()->query("update clients set client_name = '$name', client_phone = '$number' , client_adress = '$adress' where client_id = $client_id ");
        } catch (Exception) {
            echo '<h6 class="text-center text-danger">There is an issue try again please. 🤕</h6>';
        }
    }

    function get_infos($client_id)
    {
        $stmt = $this->connectToDataBase()->query("select * from clients where client_id  = $client_id ");
        $infos = $stmt->fetch();

        $_SESSION['NAME'] = $infos['client_name'];
        $_SESSION['PHONE'] = $infos['client_phone'];
        $_SESSION['ADRESS'] = $infos['client_adress'];

        //print_r(array($_SESSION['NAME'], $_SESSION['PHONE'], $_SESSION['ADRESS']));
    }
}

$client_id = $_SESSION['ID'];
$update = new UpdateProfile();

$update->get_infos($client_id);

if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    //print_r(array($client_id,$name,$phone,$adress));

    $update->update_info($client_id, $name, $phone, $adress);

    header('location:update-profil.php?infos_changed_succefully');
}

ob_end_flush();

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
                    <!-- Profile picture upload button-->
                    <input class="btn" type="file">
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <!-- Account details card-->
            <form method="POST">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1  text-info" for="inputUsername">Username *</label>
                            <?php

                            $username = $_SESSION['USERNAME'] ? $_SESSION['USERNAME'] : '';

                            echo "<input class='form-control' name='username' type='text' value='$username' disabled>";

                            ?>

                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (name)-->

                            <div class="col-md-6">
                                <label class="small mb-1 text-info" for="inputUsername">Name</label>
                                <?php
                                $name = $_SESSION['NAME'] ? $_SESSION['NAME'] : '';
                                echo "<input class='form-control' name='name' type='text' value='$name'>"
                                ?>
                            </div>
                            <!-- Form Group (phone)-->
                            <div class="col-md-6">
                                <label class="small mb-1 text-info" for="inputLastName">Phone number</label>
                                <?php
                                $phone = $_SESSION['PHONE'] ? $_SESSION['PHONE'] : '';
                                echo "<input class='form-control' name='phone' type='text' value='$phone'>"
                                ?>
                            </div>
                        </div>


                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1 text-info" for="inputEmailAddress">Email address *</label>

                            <?php
                            $email = $_SESSION['EMAIL'] ? $_SESSION['EMAIL'] : '';
                            echo "<input class='form-control' name='email' type='email' value='$email' disabled>";

                            ?>
                        </div>

                        <!-- home adress -->
                        <div class="mb-3">
                            <label class="small mb-1 text-info" for="inputEmailAddress">Home address</label>
                            <?php
                            $adress = $_SESSION['ADRESS'] ? $_SESSION['ADRESS'] : '';
                            echo "<input class='form-control' name='adress' type='text' value='$adress'>"
                            ?>
                        </div>
                        <!-- Form update pwd-->
                        <!-- Save changes button-->
                        <button class="btn mt-3 mx-auto bg-info" type="submit" name="save">Save changes</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>