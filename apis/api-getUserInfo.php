<?php 
session_start();
require_once '../components/apiCheckUserLogged.php'; 
require_once '../database.php';

try{
  $sQuery = $db->prepare('SELECT name, lastname, email, phone, profilePicture FROM users
                          Where id = :sUserId limit 1');
  $sQuery->bindValue(':sUserId', $_SESSION['jUser']['id']);
  $sQuery->execute();
  if ($sQuery->rowCount()) {
    // Array
    $aPersons = $sQuery->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($aPersons);
  } else {
    echo '{"status":0, "message":"error"}';
  }

}catch(PDOException $ex){
  echo "Sorry, system is updating ...";
  // echo $ex;
} 