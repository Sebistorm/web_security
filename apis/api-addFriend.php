<?php 
session_start();
require_once '../components/apiCheckUserLogged.php'; 
require_once '../database.php';

try {
    $sQuery = $db->prepare('INSERT INTO follows VALUES (NULL, :iUser_fk, :iFollowing_fk)');
    $sQuery->bindValue(':iUser_fk', $_SESSION['jUser']['id']);
    $sQuery->bindvalue(':iFollowing_fk', $_POST['follow_id']);
    $sQuery->execute();
    if ($sQuery->rowCount()) {
        echo '{"status":1, "message":"success"}';
    }


} catch (PDOException $e) {
    // echo $e;
    echo '{"status":0, "message":"error"}';
}