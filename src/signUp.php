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
        $email = sanitizeInput($_POST['email']);

        // create a user object and register a new user
        if(!empty($name) && !empty($password) && !empty($email)){
            $user = new User($dbConnection, $name, $password, $email);
            $user->registerUser();
        }else {
            displayMessage("error", "Please, fill all required field !");
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
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required placeholder="eg. joedoe@learn2code.io" autocomplete="">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <p class="mt-3">
                <small>Already have an account ?</small>
                <a href="./login.php">Login</a>
            </p>
        </form>
    </div>
</div>

<?php include "templates/footer.php"; ?>
