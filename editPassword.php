<?php
session_start();
$sTitle = 'Edit Password';
require_once './components/sessionValidation.php';
require_once './components/checkUserLogged.php';
require_once './components/top.php';
?>

<div class="editPasswordContent">
    <div class="editPasswordContainer">
      <form id="frmEditPassword">
        <h1>Edit Password</h1>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
        <p id='msgStatus'></p>
        <label>Current Password</label>
        <input id='userCurrentPassword' name="txtCurrentPassword" type="password" value="" placeholder="Current Password">
        <label>New Password</label>
        <input id='userNewPassword' name="txtNewPassword" type="password" value="" placeholder="New Password">
        <label>Repeat Password</label>
        <input id='userRepeatPassword' name="txtRepeatPassword" type="password" value="" placeholder="Repeat Password">
        <button id="btnEditPassword" type="submit" class="ok mt20">Confirm Password</button>
      </form>
   </div>
</div>

    
<?php
$sScript = 'editPassword.js';
require_once './components/bottom.php';