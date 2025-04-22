<?php
include '../templates/adminHeader.php';
include 'getAllCourses.php';
include '../HelperFunctions/sanitizeUserInput.php';
require_once '../HelperFunctions/displayAlert.php';
require_once 'Course.php';

// sanitize the id query parameter and ensure only numeric values are passed
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id > 0 && $_SESSION['AdminActive']){
    // store result to variables
    $title = '';
    $description = '';
    $price = '';
    $videoUrl = '';

    // get the updated course from DB
    $course = getSingleCourse($id);

    // Check if the course exists
    if ($course) {
        $title = $course['title'];
        $description = $course['description'];
        $price = $course['price'];
        $videoUrl = $course['videoUrl'];
    } else {
        echo "Course not found!";
    }
}

if(isset($_POST['updateCourse']) && $_SESSION['AdminActive']) {
    // save and sanitize user input to variables
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $price = sanitizeInput($_POST['price']);
    $videoUrl = sanitizeInput($_POST['videoUrl']);

    // create a new course object and call a method to create a new course
    $course = new Course($title, $description, $price, $videoUrl);
    $course->updateCourse($id);
}

?>

<div class="col-md-6 mt-5" id="create-course">
    <h2 class="text-primary">Updating course with ID: <?php echo $id; ?> </h2>
    <form method="post" action="#">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?php echo $title ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required><?php echo $description ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" aria-describedby="price" value="<?php echo $price ?>" required>
        </div>
        <div class="mb-3">
            <label for="videoUrl" class="form-label">Video URL</label>
            <input type="text" class="form-control" name="videoUrl" id="videoUrl" value="<?php echo $videoUrl ?>" aria-describedby="videoUrl" required>
        </div>
        <button type="submit" name="updateCourse" class="btn btn-warning">Update course</button>
    </form>
</div>


<?php include "../templates/adminFooter.php"; ?>