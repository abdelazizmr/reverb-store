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

    function deleteProfilePicture($profile_id, $filename)
    {

        $stmt = $this->connectToDataBase()->query("delete from profile_pictures where profile_id = $profile_id ");
    }


    function insertProfileImage($client_id, $filename)
    {


        $stmt = $this->connectToDataBase()->query("INSERT INTO profile_pictures (client_id,src) VALUES 
            ($client_id,'$filename') ");
    }

    function getProfileImage($client_id)
    {

        $stmt = $this->connectToDataBase()->query("select src from profile_pictures where client_id = $client_id");
        $row = $stmt->fetch();
        if ($row == false) {
            return null;
        }
        return $row['src'];
    }

    function getProfileId($client_id)
    {
        $stmt = $this->connectToDataBase()->query("select profile_id from profile_pictures where client_id = $client_id");
        $row = $stmt->fetch();
        return $row['profile_id'];
    }
}

$client_id = $_SESSION['ID'];
$update = new UpdateProfile();

$update->get_infos($client_id);
$src = $update->getProfileImage($client_id);

if ($src == null) {
    $src = "default.jpg";
}


if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

    //print_r(array($client_id,$name,$phone,$adress));
    //! updated profil infos
    $update->update_info($client_id, $name, $phone, $adress);


    header('location:update-profil.php?infos_changed_succesffully');
}

if (isset($_POST['upload'])) {
    $filename = $_FILES['uploadfile']['name'];
    $filetmpname = $_FILES['uploadfile']['tmp_name'];
    //folder where images will be uploaded
    $folder = './imagesUpload/';
    //function for saving the uploaded images in a specific folder
    move_uploaded_file($filetmpname, $folder . $filename);
    //!inserting image details (ie image name) in the database


    $result = $update->getProfileImage($client_id);

    if ($result === null) {
       $update->insertProfileImage($client_id, $filename);
       header('location:update-profil.php?profile_image_inserted_succefully');
        exit();
    }

    if (empty($filename)){
        echo "<span class='text-center text-danger>You must choose a picture</span>'";
        exit();
    }

    $profile_id  = $update->getProfileId($client_id);
    $update->deleteProfilePicture($profile_id, $filename);
    $update->insertProfileImage($client_id, $filename);
    $_SESSION['IMAGE'] = $filename;
    header('location:update-profil.php?profile_picture_updated_succefully');
}

if (isset($_POST['remove'])) {
    if ($src == "default.jpg"){
        header('location:update-profil.php');
        die();
    }
    $filename = $_FILES['uploadfile']['name'];
    $profile_id  = $update->getProfileId($client_id);
    $update->deleteProfilePicture($profile_id, $filename);
    unset($_SESSION['IMAGE']);
    $src ="default.jpg";
    header('location:update-profil.php?profile_picture_deleted_succefully');

}

ob_end_flush();

?>

<div class="container-xl px-4 mt-5">


    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <form class="card mb-4 mb-xl-0" method="post" enctype="multipart/form-data">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center align-items-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2 w-100 h-100" src="./imagesUpload/<?php echo $src; ?>" alt="">
                    <!-- Profile picture help block-->
                    <!-- Profile picture upload button-->
                    <input type="file" name="uploadfile" class="my-2 wrap ms-5 mx-auto" accept="image/*" />
                    <button class="btn mt-2 mx-auto text-info" name="upload">Upload</button>
                    <button class="btn ms-2 mt-2 mx-auto text-danger" name="remove">Remove</button>
                </div>
            </form>
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
                        <button class="btn mt-3 mx-auto text-light bg-success" type="submit" name="save">
                            Save changes
                        </button>
            </form>
        </div>
    </div>
</div>
</div>
</div>