<?php
session_start();
require_once '../components/apiCheckUserLogged.php'; 

if (isset($_POST['txtTweet'])) {
    if (!isset($_POST["csrf_token"]) || $_SESSION["csrf_token"]!=$_POST["csrf_token"])
    {
        echo '{"status":0, "message":"Security Error"}';
        exit();
    }
}

if (!(strlen($_POST['txtTweet']) >= 1 && strlen($_POST['txtTweet']) < 256)) {
    echo '{"status":0, "message":"Tweet must be between 1 - 255 characters"}';
    exit();
}

$tweetOutput = htmlentities($_POST['txtTweet']);

require_once '../database.php';

try {
    $sQuery = $db->prepare('INSERT INTO tweets VALUES (NULL, :user_fk, :tweet, NULL) ');
    $sQuery->bindValue(':user_fk', $_SESSION['jUser']['id']);
    $sQuery->bindValue(':tweet', $tweetOutput);
    $sQuery->execute();
    if ($sQuery->rowCount()) {
        echo '{"status":1, "message":"success"}';
    }
} catch (PDOException $e) {
    // echo $e;
    echo '{"status":0, "message":"error"}';
}