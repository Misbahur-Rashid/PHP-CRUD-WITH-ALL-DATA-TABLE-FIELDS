<?php
include('Database/db.php');
include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        }
        $statement = $conn->prepare("
   INSERT INTO users (fname, lname, image, email, contact, dob, hobby, gender, address) 
   VALUES ('$fname', '$lname', '$image', '$email', '$contact', '$dob', '$hobby', '$gender', '$address')
  ");
        $result = $statement->execute(
            array(
                ':fname' => $_POST["fname"],
                ':lname' => $_POST["lname"],
                ':email' => $_POST["email"],
                ':contact' => $_POST["contact"],
                ':dob' => $_POST["dob"],
                ':hobby' => $_POST["hobby"],
                ':gender' => $_POST["gender"],
                ':address' => $_POST["address"],
                ':image'  => $image
            )
        );
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }
    if ($_POST["operation"] == "Edit") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $statement = $conn->prepare(
            "UPDATE users 
   SET fname = '$fname', lname = '$lname', email = '$email', contact = '$contact', dob = '$dob', hobby = '$hobby', gender = '$gender', address = '$address', image = '$image'  
   WHERE id = '$id'
   "
        );
        $result = $statement->execute(
            array(
                ':fname' => $_POST["fname"],
                ':lname' => $_POST["lname"],
                ':email' => $_POST["email"],
                ':contact' => $_POST["contact"],
                ':dob' => $_POST["dob"],
                ':hobby' => $_POST["hobby"],
                ':gender' => $_POST["gender"],
                ':address' => $_POST["address"],
                ':image'  => $image,
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
