<?php
session_start();
$sTitle = 'Login';
require_once './components/userLogged.php';
require_once './components/top.php';

?>


<div id="loginContent">
  <form id='frmUser' action="" method="post">
    <h1>Login</h1>
    <p id='loginMessage'></p>
    <input name='txtUserEmail' value='' type="text" placeholder='email'>
    <input name='txtPassword' value='' type="password" placeholder='Password'>
    <div id='recaptchaContainer'></div>
    <button id='btnLogin' type='submit'>Login</button>
    <p><a href='signup.php'>Register</a></p>
  </form>
</div>


<?php
$sScript = 'login.js';
require_once './components/bottom.php';


