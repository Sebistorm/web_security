<?php 
session_start();
require_once '../components/apiCheckUserLogged.php'; 
if ( !(strlen($_POST['txtPassword']) >= 8) )  {
    echo '{"status":0, "message":"wrong password"}';
    exit();
}


if (isset($_POST['txtPassword'])) {
    if (!isset($_POST["csrf_token"]) || $_SESSION["csrf_token"]!=$_POST["csrf_token"])
    {
        echo '{"status":0, "message":"Security Error"}';
        exit();
    }
}

require_once '../database.php';

$static_peber = 'sdajkd6776sdaksadjjjkd7sad';

try {
    $sQuery = $db->prepare('SELECT password FROM users WHERE id = :iUserId limit 1');
    $sQuery->bindValue(':iUserId', $_SESSION['jUser']['id']);
    $sQuery->execute();
    $aUsers = $sQuery->fetchAll(PDO::FETCH_ASSOC);
    // finds if there is a user
    if (count($aUsers)) {
        // saving the hashed password from the database in a variabel 
        $hashed_password = $aUsers[0]['password'];
        // function to check if the password is correct 
        $userPassword = password_verify($_POST['txtPassword'].$static_peber, $hashed_password);
        // if $userPassword is true - then the password is correct
        if ($userPassword) {
            echo '{"status":1, "message":"success"}';
        } else {
            echo '{"status":0, "message":"Wrong Password"}';
        }
    }
} catch (PDOException $e) {
    // echo $e;
    echo '{"status":0, "message":"error"}';
}

