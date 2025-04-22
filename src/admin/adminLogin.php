<?php
include '../templates/adminHeader.php';
require_once '../Database.php';
require_once '../HelperFunctions/displayAlert.php';
require '../HelperFunctions/sanitizeUserInput.php';

if(isset($_POST['submit'])){
    try{
        // Initialize database connection
        $database = new Database();
        $dbConnection = $database->getConnection();

        // Sanitize user input
        $adminID = sanitizeInput($_POST['adminID']);
        $adminPass = sanitizeInput($_POST['adminPass']);

        $query = "SELECT * FROM adminlogin WHERE ID = :adminID";
        $smtp = $dbConnection->prepare($query);
        $smtp->bindParam(':adminID', $adminID);
        $smtp->execute();
        $admin = $smtp->fetch(PDO::FETCH_ASSOC);

        if($admin){
            $_SESSION['AdminID'] = $admin['ID'];
            $_SESSION['AdminActive'] = true;
            displayMessage("success", "Logged in successfully! Redirecting ...");
            header('refresh: 1;url=adminInterface.php');
            exit();
        } else {
            displayMessage("error", "Incorrect username or password");
        }
    }catch (PDOException $ex){
        displayMessage("error", "Error: " . $ex->getMessage());
    }
}

?>

<div class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div class="col-md-4">
        <form method="post" action="">
            <div class="mb-3">
                <label for="adminID" class="form-label">Admin ID</label>
                <input type="text" name="adminID" id="adminID" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="adminPass" class="form-label">Admin Password</label>
                <input type="password" name="adminPass" class="form-control" id="adminPass" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>

<?php include "../templates/adminFooter.php"; ?>
