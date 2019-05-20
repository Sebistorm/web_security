<?php
session_start();
$sTitle = 'Home';
require_once './components/sessionValidation.php';
require_once './components/checkUserLogged.php';
require_once './components/top.php';

$_SESSION["csrf_token"]=hash("sha256",rand()."secret");
?>

<div class='btnToggleMenuContainer'>
    <a class="btnToggleMenu" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-bars"></i>
    </a>
</div>

<div class="collapse" id="collapseExample">
  <div id='collapseBodyContainer' class="card card-body">
    <div class='cardBody1'>
        <p>Name: <span class='userName'>DATA_NAME</span></p>
        <p>Lastname: <span class='userLastName'>DATA_LASTNAME</span></p>
        <p>Email: <span class='userEmail'>DATA_EMAIL</span></p>
    </div>
    <div class='cardBody2'>
        <p>Phone: <span class='userPhone'>DATA_PHONE</span></p>
        <a href="editProfileInformation.php"><p id='changeProfilePicture'>Change profile information</p></a>
        <a href="editPassword.php"><p id='changePassword'>Change Password</p></a>
    </div>
    <div class='cardBody3'>
        <a href="editProfilePicture.php"><p id='changeProfilePicture'>Change profile picture</p></a>
        <a href="allUsers.php"><p id='findPeople'>Find people</p></a>
        <p id='logout'>Log out</p>
    </div>
    <div class='cardBody4'>
        <img src="img/img1.jpg" alt="Profile Picture" id='profilePicture'>
    </div>
  </div>
</div>


<div id='socialMediaFeed'>
    <div id='createTweetContainer'>
        <form id='frmTweet'>
            <h2>Create Tweet</h2>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"] ?>">
            <textarea name='txtTweet' id ='textareaTweet' rows='2' placeholder="what's on your mind"></textarea>
            <button type='submit' class='btnCreateTweet'>Tweet</button>
        </form>
    </div>

    <div id='tweetsContainer'>

    </div>
</div>

<?php
$sScript = 'index.js';
require_once './components/bottom.php';

