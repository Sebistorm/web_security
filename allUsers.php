<?php
session_start();
$sTitle = 'All Users';
require_once './components/checkUserLogged.php';
require_once './components/sessionValidation.php';
require_once './components/top.php';
?>

<div id='allUserContainer'>
    <div id='allUsers'>
    <h2>Do you know these?</h2>
        
    </div>
</div>

    
<?php
$sScript = 'allUsers.js';
require_once './components/bottom.php';