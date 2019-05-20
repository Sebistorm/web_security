<?php

if (!empty($_POST["txtPassword"]) && ($_POST["txtPassword"] == $_POST["txtRepeatPassword"])) {
    $password = test_input($_POST["txtPassword"]);
    if (strlen($_POST["txtPassword"]) < 8) {
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
     echo '{"status":0, "message":"Please enter password"}';
     exit();
}

/*Each $_POST variable with be checked by the function*/
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




if ( !((strlen($_POST['txtName']) > 1 && strlen($_POST['txtLastName']) > 1 && strlen($_POST['txtEmail']) > 1 && strlen($_POST['txtPhone']) >= 8)) ) {
    echo '{"status":0, "message":"error"}';
    exit();
}




$options = [
    'cost' => 5
];
// a static string - only in the code
$static_peber = 'sdajkd6776sdaksadjjjkd7sad';
$hashed_password = password_hash($_POST['txtPassword'].$static_peber, PASSWORD_DEFAULT, $options);
// echo $hashed_password;

require_once '../database.php';
try {
    $sQuery = $db->prepare('INSERT INTO users VALUES(NULL, :name, :lastname, :email, :password, :phone, :profilePicture)');
    $sQuery->bindValue(':name', $_POST['txtName']);
    $sQuery->bindValue(':lastname', $_POST['txtLastName']);
    $sQuery->bindValue(':email', $_POST['txtEmail']);
    $sQuery->bindValue(':password', $hashed_password);
    $sQuery->bindValue(':phone', $_POST['txtPhone']);
    $sQuery->bindValue(':profilePicture', 'ano-user.png');

    $sQuery->execute();
    if ($sQuery->rowCount()) {
        echo '{"status":1, "message":"success"}';
    }
} catch (PDOException $e) {
      echo '{"status":0, "message":"login-error", "code":"001"}';
    // echo $e;
}
