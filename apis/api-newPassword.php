<?php 
if (!empty($_POST["txtNewPassword"]) && ($_POST["txtNewPassword"] == $_POST["txtRepeatPassword"])) {
    $password = test_input($_POST["txtNewPassword"]);
    if (strlen($_POST["txtNewPassword"]) < 8) {
        // $passwordErr = "Your Password Must Contain At Least 8 Characters!";
        echo '{"status":0, "message":"Your Password Must Contain At Least 8 Characters"}';
        exit();
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        // $passwordErr = "Your Password Must Contain At Least 1 Number!";
        echo '{"status":0, "message":"Your Password Must Contain At Least 1 Number"}';
        exit();
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        // $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
        echo '{"status":0, "message":"Your Password Must Contain At Least 1 Capital Letter"}';
        exit();
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        // $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        echo '{"status":0, "message":"Your Password Must Contain At Least 1 Lowercase Letter"}';
        exit();
    }
} elseif (!empty($_POST["txtPassword"])) {
    // $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
    echo '{"status":0, "message":"Please Check You have Entered Or Confirmed Your Password"}';
    exit();
} else {
    //  $passwordErr = "Please enter password   ";
     echo '{"status":0, "message":"Please enter a valid password"}';
     exit();
}

/*Each $_POST variable with be checked by the function*/
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();
require_once '../components/apiCheckUserLogged.php'; 

if ( isset($_POST['txtCurrentPassword']) && isset($_POST['txtNewPassword']) && isset($_POST['txtRepeatPassword']) ) {
    if (!isset($_POST["csrf_token"]) || $_SESSION["csrf_token"]!=$_POST["csrf_token"])
    {
        echo '{"status":0, "message":"Security Error"}';
        exit();
    }
}

require_once '../database.php';

// a static string - only in the code
$static_peber = 'sdajkd6776sdaksadjjjkd7sad';
// check password
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
        $userPassword = password_verify($_POST['txtCurrentPassword'].$static_peber, $hashed_password);
        // if $userPassword is true - then the password is correct and the code can continue to the update password part
        if ($userPassword) {
            // echo '{"status":1, "message":"success"}';
        } else {
            echo '{"status":0, "message":"Wrong Password"}';
            exit();
        }
    }
} catch (PDOException $e) {
    // echo $e;
    echo '{"status":0, "message":"error"}';
}


$options = [
    'cost' => 5
];

$hashed_password = password_hash($_POST['txtNewPassword'].$static_peber, PASSWORD_DEFAULT, $options);

try {
    $sQuery = $db->prepare('UPDATE users
                          SET password = :sPassword
                          WHERE id = :iId');
    $sQuery->bindValue(':sPassword', $hashed_password);
    $sQuery->bindValue(':iId', $_SESSION['jUser']['id']);
    $sQuery->execute();
    if($sQuery->rowCount()) {
        echo '{"status":1, "message":"success"}';
        exit;
    } else {
        echo '{"status":0, "message":"error"}';
    }

} catch(pdOException $exp) {
    // echo $exp;
    echo '{"status":0, "message":"error"}';
}


