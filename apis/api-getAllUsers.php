<?php 
// exit();
session_start();
require_once '../components/apiCheckUserLogged.php'; 
require_once '../database.php';

try{
//   $sQuery = $db->prepare('SELECT name, lastname, profilePicture FROM users');
  $sQuery = $db->prepare('select id, name, lastname, profilePicture from users where id NOT IN 
  (select following_fk from follows where user_fk = :id) AND NOT id = :id');
  $sQuery->bindValue(':id', $_SESSION['jUser']['id']);
  $sQuery->execute();
  if ($sQuery->rowCount()) {
    // Array
    $aPersons = $sQuery-> fetchall(PDO::FETCH_ASSOC);
    echo json_encode($aPersons);
  } else {
    echo '{"status":0, "message":"error"}';
  }

}catch(PDOException $ex){
//   echo "Sorry, system is updating ...";
  // echo $ex;
  echo '{"status":0, "message":"error"}';
} 