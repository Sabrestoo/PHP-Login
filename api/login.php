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
    $password = $decoded['password'];


    $findUser = $conn->prepare("SELECT user_id, password FROM users WHERE email = :email LIMIT 1");
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();


        if($findUser->rowCount() == 1) {
            //User exists verify password correct
          $user = $findUser->fetch(PDO::FETCH_ASSOC);         
          $hash = $user['password'];
          $user_id = (int) $user['user_id'];
          

            if(password_verify($password, $hash)){
                //User signed in
               $return['redirect'] = '/dashboard.php';
                
            } else {
                $return['error'] = 'Incorrect email or password'; 
            }
          
        } else {
            $return['error'] = 'Please <a href="/register.php">create an account</a>';
                      
        }

    echo json_encode($return, JSON_PRETTY_PRINT);   

} else {
    print 'error with login';
   exit;
}
?>
