<?php
session_start();
//static peber to login
$static_peber = 'sdajkd6776sdaksadjjjkd7sad';

require_once '../database.php';
// finds the ip address
$ip = $_SERVER['REMOTE_ADDR'];
// counting how many times the same ip address has tried to login
$result = $db->prepare("SELECT count(ip_address) AS failed_login_attempt FROM failed_login WHERE ip_address = :ip AND date BETWEEN DATE_SUB( NOW() , INTERVAL 1 HOUR ) AND NOW()");
$result->bindValue(':ip', $ip);
$result->execute();
$aFailedLoginsAttempts = $result->fetchAll(PDO::FETCH_ASSOC);
// the attempts
$failed_login_attempt = $aFailedLoginsAttempts[0]['failed_login_attempt'];

function loginError() {
    global $db;
    global $failed_login_attempt;
    global $ip;
    // login error      
    // insert ip address and datetime into failed_login table
    $sQuery = $db->prepare('INSERT INTO failed_login VALUES (:ip, NOW())');
    $sQuery->bindValue(':ip', $ip);
    $sQuery->execute();
    if ($sQuery->rowCount()) {
        if ($failed_login_attempt == 2) {
            echo '{"status":2, "message":"refresh side!"}';
            exit();
        } else if ($failed_login_attempt >= 3) {
            echo '{"status":2, "message":"username and password did not match"}';
            exit();
        }
        echo '{"status":5, "message":"username and password did not match"}';
        exit();
        
        
    }
}
// if the user has tried more than 3 times and failed login attempt is set (isset)
if (isset($failed_login_attempt) && $failed_login_attempt >= 3) {
    // recaptcha -  // Checks if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        function post_captcha($user_response)
        {
            $fields_string = '';
            $fields = array(
            'secret' => '6LcLh6QUAAAAAC7-u-EzBKt7RMi_ZUdyPS8fXgLa',
            'response' => $user_response
        );
            foreach ($fields as $key=>$value) {
                $fields_string .= $key . '=' . $value . '&';
            }
            $fields_string = rtrim($fields_string, '&');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        // Call the function post_captcha
        $res = post_captcha($_POST['g-recaptcha-response']);

        if (!$res['success']) {
            // What happens when the CAPTCHA wasn't checked
            echo '{"status":3, "message":"Please make sure you check the security CAPTCHA box."}';
            exit();
        } else {
            // If CAPTCHA is successfully completed...
        }
    }
}

// without recaptcha (until user has tried 3 times)
try {
    $sQuery = $db->prepare('SELECT * FROM users WHERE email = :userEmail');
    $sQuery->bindValue(':userEmail', $_POST['txtUserEmail']);
    $sQuery->execute();
    $aUsers = $sQuery->fetchAll(PDO::FETCH_ASSOC);

    if (count($aUsers)) {
        $hashed_password = $aUsers[0]['password'];
        $userPassword = password_verify($_POST['txtPassword'].$static_peber, $hashed_password);
        if ($userPassword) {
            $_SESSION['jUser'] = $aUsers[0];
            $_SESSION['jUser']['ip'] = $_SERVER['REMOTE_ADDR'];
            echo '{"status":1, "message":"login success"}';
            $sQuery = $db->prepare("DELETE FROM failed_login WHERE ip_address = :ip");
            $sQuery->bindValue(':ip', $ip);
            $sQuery->execute();
            if ($sQuery->rowCount()) {
                exit;
            }
            exit;
        } else {
            // login error
            loginError();   
        }
        exit;
    } else {
        // login error      
        loginError(); 
    
    }
} catch (PDOException $e) {
    echo '{"status":0, "message":"error", "code":"001", "line":'.__LINE__.'}';
}
