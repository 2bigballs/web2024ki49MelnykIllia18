<?php 
session_start();

$action = $_REQUEST["action"];

switch ($action) {
  case "getUserById":
    getUserById();
    break;
  case "updateUserById":
    updateUserById();
    break;
}



function getUserById(){
    require "database.php";
    $id = $_GET['id'] ?? $_SESSION["ID"];

    $sql = "SELECT * FROM users WHERE Id = '$id'";
    $result = mysqli_query($connection, $sql);
    $response = mysqli_fetch_assoc($result);

    echo json_encode($response);
}

function updateUserById(){
    
    require "database.php";
    $id = $_POST['id'] ?? $_SESSION["ID"];
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $position = $_POST['position'];
    $full_name = $_POST['full_name'];
    
    $sql = "UPDATE users SET 
    Email = '$email', 
    UserName = '$user_name', 
    Password = '$password',
    Position = '$position',
    FullName = '$full_name',
    Description = '$description'
    
    WHERE Id = '$id'";
    $result = mysqli_query($connection, $sql);
    
    if(!$result){
        http_response_code(400);
        echo "Failure update user data!";
        exit;
    }
}

?>