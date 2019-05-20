<?php
session_start();
$sTitle = 'Signup';
require_once './components/userLogged.php';
require_once './components/top.php';
?>
<div id='signupContainer'>
    <form id="frmSignup">
        <h1>Signup</h1>
        <p id='msgSignupError'></p>
        <input type="text" name="txtName" placeholder='name (more than 1 sign)' id='inputName' value='' required>
        <input type="text" name="txtLastName" placeholder='lastname (more than 1 sign)' id='inputLastName' value='' required>
        <input type="text" name="txtEmail" placeholder='Email' id='inputEmail' value='' required>
        <input type="password" name="txtPassword" placeholder='password (8 signs or more - must contain 1 lowercase letter, 1 uppercase letter and 1 number)' id='inputPassword' value='' required>
        <input type="password" name="txtRepeatPassword" placeholder='repeat password' id='inputRepeatPassword' value='' required>
        <input type="number" name="txtPhone" placeholder='Phone (XX-XX-XX-XX)' id='inputPhone' value='' required>
        <button id='btnSignup' class='btn' type='submit'>Signup</button>
    </form>
</div>

    
<?php
$sScript = 'signup.js';
require_once './components/bottom.php';