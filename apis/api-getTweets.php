<?php 
session_start();
require_once '../components/apiCheckUserLogged.php'; 

$sLoggedUserId = $_SESSION['jUser']['id'];
$sLastTweetTime = $_POST['sLastTweetTime'];

require_once '../database.php';


try {
    // select in select 
    // order by
    $stmt = $db-> prepare('SELECT tweets.*, users.name, users.lastname, users.profilePicture 
    FROM tweets AS tweets
    INNER JOIN users AS users ON tweets.user_fk = users.id
    WHERE user_fk IN 
    (select following_fk from follows where user_fk = :id) AND tweet_time >
    :sLastTweetTime ORDER BY tweets.tweet_time');
    $stmt->bindValue(':id', $sLoggedUserId);
    $stmt->bindValue(':sLastTweetTime', $sLastTweetTime);
    $stmt->execute();
    $aRows = $stmt-> fetchall(PDO::FETCH_ASSOC);

    echo json_encode($aRows);

}catch( PDOException $e ){
    echo '{"status":0, "message":"error", "code":"001", "line":'.__LINE__.'}';
    // echo $e;
}



