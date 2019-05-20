<?php 
session_start();
require_once '../components/apiCheckUserLogged.php'; 


if ( !(strlen($_POST['txtName']) > 1 && strlen($_POST['txtLastName']) > 1 && strlen($_POST['txtEmail']) > 1 && strlen($_POST['txtPhone']) >= 8) ) {
    echo '{"status":0, "message":"error"}';
    exit();
}


require_once '../database.php';
try{
    $sQuery = $db->prepare('UPDATE users 
                            SET name = :sName,
                            lastname = :sLastname,
                            email = :sEmail,
                            phone = :sPhone
                            WHERE id = :iUserId');
    $sQuery->bindValue(':sName', $_POST['txtName']);
    $sQuery->bindValue(':sLastname', $_POST['txtLastName']);
    $sQuery->bindValue(':sEmail', $_POST['txtEmail']);
    $sQuery->bindValue(':sPhone', $_POST['txtPhone']);
    $sQuery->bindValue(':iUserId', $_SESSION['jUser']['id']);
    $sQuery->execute();
    echo '{"status":1, "message":"update success"}';    
    
  
  }catch(PDOException $ex){
    // echo '{"status":0, "message":"exception"}';
    // echo $ex;
  } 