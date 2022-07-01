<?php
include('db.php');
include('function.php');
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Add") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        }
        $statement = $connection->prepare("
   INSERT INTO users (phone, email, fname, lname, image) 
   VALUES (:phone, :email, :fname, :lname, :image)
  ");
        $result = $statement->execute(
            array(
                ':phone' => $_POST["phone"],
                ':email' => $_POST["email"],
                ':fname' => $_POST["fname"],
                ':lname' => $_POST["lname"],
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
        $statement = $connection->prepare(
            "UPDATE users 
   SET phone = :phone, email = :email, fname = :fname, lname = :lname, image = :image  
   WHERE id = :id
   "
        );
        $result = $statement->execute(
            array(
                ':phone' => $_POST["phone"],
                ':email' => $_POST["email"],
                ':fname' => $_POST["fname"],
                ':lname' => $_POST["lname"],
                ':image'  => $image,
                ':id'   => $_POST["user_id"]
            )
        );
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }
}
