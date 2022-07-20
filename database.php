<?php

try{
  $sUserName = 'web-developer';
  // $sUserName = 'root';
  // $sPassword = '';
  $sPassword = '';
  $sConnection = "mysql:host=localhost; dbname=web_security; charset=utf8mb4";

  $aOptions = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );

}catch( PDOException $e){
  echo '{"status":"err","message":"cannot connect to database"}';
  exit();
}
