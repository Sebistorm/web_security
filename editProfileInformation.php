<?php
session_start();
$sTitle = 'Edit Profile Information';
require_once './components/sessionValidation.php';
require_once './components/checkUserLogged.php';
require_once './components/top.php';
$_SESSION["csrf_token"]=hash("sha256",rand()."secret");
?>

<div class="editProfileContent">
    <div class="EditProfileContainer">
      <form id="frmEditProfile">
        <h1>Edit Profile</h1>
        <label>Name</label>
        <input id='userName' name="txtName" type="text" value="" placeholder="name">
        <label>Last Name</label>
        <input id='userLastName' name="txtLastName" type="text" value="" placeholder="Last Name">
        <label>Email</label>
        <input id='userEmail' name="txtEmail" type="text" value="" placeholder="email">
        <label>Phone</label>
        <input id='userPhone' name="txtPhone" type="text" value="" placeholder="Phone">
        <button id="btnEditProfile" type="submit" class="ok mt20">save</button>
      </form>
   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Confim Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='frmConfirmPassword'>
          <p id='msgConfirmPassword'></p>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
          <label>Password</label>
          <input id='userPassword' name="txtPassword" type="password" value="" placeholder="Password"> 
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id='btnConfirmPassword' class="btn btn-primary">Confirm</button>
      </div>
    </div>
  </div>
</div>

    
<?php
$sScript = 'editProfileInformation.js';
require_once './components/bottom.php';