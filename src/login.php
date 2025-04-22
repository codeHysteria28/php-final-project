<?php
include 'templates/header.php';
require_once 'Database.php';
require_once 'User.php';
require 'HelperFunctions/sanitizeUserInput.php';
require_once 'HelperFunctions/displayAlert.php';

if(isset($_POST['submit'])) {
    try {
        // Initialize database connection
        $database = new Database();
        $dbConnection = $database->getConnection();

        // sanitize user input and store it in variable
        $name = sanitizeInput($_POST['name']);
        $password = sanitizeInput($_POST['password']);

        // create a user object and login user
        if(!empty($name) && !empty($password)){
            $user = new User($dbConnection, '', '', '');
            $user->loginUser($name, $password);
        }else {
            displayMessage("error", "Please, fill all required fields !");
        }
    }catch (Exception $ex){
        displayMessage("error", "Error: " . $ex->getMessage());
    }
}

?>

<div class="container-fluid d-flex justify-content-center align-items-center mt-5">
    <div class="col-md-4">
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="eg. Joe Doe" autocomplete=""/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required/>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <p class="mt-3">
                <small>Don't have an account ?</small>
                <a href="./signUp.php">Sign Up</a>
            </p>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>
