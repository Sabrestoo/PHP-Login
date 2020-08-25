<?php 

define('__CONFIG__', true);

require_once '../includes/config.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Handle FETCH api json in PHP
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ( $contentType === "Application/json" && $_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $content = trim(file_get_contents("php://input"));
    
    $decoded = json_decode($content, true);
    
    $return =[];

    $email = $decoded['email'];

    $findUser = $conn->prepare("SELECT user_id FROM users WHERE email = :email LIMIT 1");
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();

        if($findUser->rowCount() == 1) {
            //User exists
            $return['error'] = "You already have an account";
            echo 'user exists';
        } else {

            $password = password_hash($decoded['password'], PASSWORD_DEFAULT);
            //User does not exist
            $addUser = $conn->prepare("INSERT into users(email, password) VALUES(:email, :password)");
            $addUser->bindParam(':email', $email, PDO::PARAM_STR);
            $addUser->bindParam(':password', $password, PDO::PARAM_STR);
            $addUser->execute();

            $user_id = $conn->lastInsertId();

            $_SESSION['user_id'] = (int) $user_id;
            $return['redirect'] = '/dashboard.php';
        }

    echo json_encode($return, JSON_PRETTY_PRINT);   

} else  {
   exit;
}
?>
