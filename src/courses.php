<?php
include "./templates/header.php";
require_once 'HelperFunctions/displayAlert.php';
include './admin/getAllCourses.php';
if(isset($_SESSION['Active']) && $_SESSION['Active']){
?>

<div class="row">
    <?php
        try {
            $courses = getAllCourses();

            if(!empty($courses)){
                foreach ($courses as $course){
                    echo '<div class="col-md-4"><div class="card">'; // start of col-md and card element
                    echo '<iframe class="card-img-top" width="420" height="315" src="' . $course['videoUrl'] . '"></iframe>';
                    echo '<div class="card-body">';
                    echo "<h5 class='card-title'>{$course['title']}</h5>";
                    echo "<p class='card-text'>{$course['description']}</p>";
                    echo "<p class='fw-bold text-success'>Price: €<small class='price'>{$course['price']}</small></p>";
                    echo "<button class='btn btn-primary purchase' data-title='" . htmlspecialchars($course['title'], ENT_QUOTES) . "' data-price='{$course['price']}'>Purchase</button>";
                    echo '</div></div></div>'; // end of col-md, card, card-body
                }
            }else {
                echo "<h2 class='fw-bold text-warning'>No available courses !</h2>";
            }
        }catch (Exception $ex){
            displayMessage("error", "Error fetching courses: " . $ex->getMessage());
        }
    ?>
</div>

<div id="shopping_cart">
    <i class="fa-solid fa-cart-shopping"></i>
</div>

<div id="shopping_cart-inside"></div>

<?php
}else {
    displayMessage("error", "You must be logged in to preview the courses. Redirecting ...");
    header('refresh: 2;url=login.php');
    exit();
}
include "./templates/footer.php";
?>