<?php 
if (isset($_SESSION['jUser'])) {
    if($_SESSION['jUser']) {
        header("Location: index.php");
    }
}
?>