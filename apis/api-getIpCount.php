<?php 
require_once '../database.php';
$ip = $_SERVER['REMOTE_ADDR'];
$result = $db->prepare("SELECT count(ip_address) AS failed_login_attempt FROM failed_login WHERE ip_address = :ip AND date BETWEEN DATE_SUB( NOW() , INTERVAL 1 DAY ) AND NOW()");
$result->bindValue(':ip', $ip);
$result->execute();
$aFailedLoginsAttempts = $result->fetchAll(PDO::FETCH_ASSOC);
// echo json_encode($aFailedLoginsAttempts[0]['failed_login_attempt']);
$failed_login_attempt = $aFailedLoginsAttempts[0]['failed_login_attempt'];
echo $failed_login_attempt;