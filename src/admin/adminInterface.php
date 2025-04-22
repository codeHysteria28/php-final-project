<?php
include '../templates/adminHeader.php';
require_once '../HelperFunctions/displayAlert.php';

if(isset($_SESSION['AdminActive']) && $_SESSION['AdminActive']){
    // admin content below
    // create, update and delete courses
?>



<?php
}else {
    displayMessage("error", "Admin is not logged in, and admin session is not active! Redirecting to admin login ...");
    header('refresh: 1;url=adminLogin.php');
    exit();
}
?>


<?php include "../templates/adminFooter.php"; ?>
