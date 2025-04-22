<?php
// Created by:
// Branislav Buna
// TU Dublin
// B00158771

include "src/templates/header.php";
?>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
            <h1 class="text-primary">Unlock Your Coding Potential</h1>
            <p class="text-muted">
                Embark on an exciting journey into the world of programming with our comprehensive and easy-to-follow learning platform. Whether you're a complete beginner or looking to expand your existing skills, we provide the tools and resources you need to master in-demand coding languages and build innovative projects. Start your coding adventure today!
            </p>
            <small class="text-primary">Create an account to browse courses !</small>
        </div>
        <div class="col-md-6 text-center">
            <div class="image-container">
                <img src="assets/1.jpeg" alt="a man learning to code" class="img-thumbnail img-fluid learningToCodeCopy"/>
                <img src="assets/1.jpeg" alt="a man learning to code" class="img-thumbnail img-fluid learningToCode"/>
            </div>
        </div>
    </div>
    <?php
        if(isset($_SESSION['Active']) && $_SESSION['Active']){
            echo '<a class="btn btn-primary" href="src/courses.php">Browse Courses</a>';
        }else {
            echo '<a class="btn btn-primary" href="src/signUp.php">Sign Up today</a>';
        }
    ?>
</div>

<?php include "src/templates/footer.php"; ?>