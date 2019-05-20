<?php
session_start();
$sTitle = 'Edit Profile Picture';
require_once './components/sessionValidation.php';
require_once './components/checkUserLogged.php';
require_once './components/top.php';
?>

<div class='updateProfileImageContainer'>
    <form enctype='multipart/form-data' id='frmUpdateProfilePicture'>
        <p id='msgError'></p>
        <input type="file" class="form-control" id="file" name="file" required />
        <button id='btnUpdateProfilePicture' type="submit"><i class="fas fa-image"></i> Tilføj Billede</button>
    </form>
</div>

    
<?php
$sScript = 'editProfilePicture.js';
require_once './components/bottom.php';