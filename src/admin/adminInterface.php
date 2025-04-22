<?php
include '../templates/adminHeader.php';
require_once '../HelperFunctions/displayAlert.php';
include 'getAllCourses.php';

if(isset($_SESSION['AdminActive']) && $_SESSION['AdminActive']){
    // admin content below
    // create, update and delete courses
?>

<div class="col-md-6 mt-5" id="create-course">
    <h2 class="text-primary">Create course</h2>
    <form method="post" action="createCourse.php">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="price" aria-describedby="price" required>
        </div>
        <div class="mb-3">
            <label for="videoUrl" class="form-label">Video URL</label>
            <input type="text" class="form-control" name="videoUrl" id="videoUrl" aria-describedby="videoUrl" required>
        </div>
        <button type="submit" name="createCourse" class="btn btn-success">Create course</button>
    </form>
</div>

<div class="col-md-6 mt-5" id="modify-course">
    <h2 class="text-warning">Modify existing course</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Video URL</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
            <?php
                // dynamically output courses from database into the table
                try {
                    // call a helper function to fetch all courses
                    $courses = getAllCourses();

                    // check if the result is empty
                    if(!empty($courses)){
                        // loop over all the available courses and output them to table
                        foreach ($courses as $course){
                            echo '<tr><th class="text-primary" scope="row">';
                            echo $course['ID'];
                            echo '</th>';
                            echo "<td>{$course['title']}</td>";
                            echo "<td>{$course['description']}</td>";
                            echo "<td>{$course['price']}</td>";
                            echo "<td>{$course['videoUrl']}</td>";
                            echo '<td><a class="text-warning" href="updateCourse.php/id='. $course['ID'] .'"><i class="fa-solid fa-pencil"></i></a></td>';
                            echo '<td><a class="text-danger" href="deleteCourse.php/id='. $course['ID'] .'"><i class="fa-solid fa-trash"></i></a></td>';
                            echo '</tr>';
                        }
                    }else {
                        echo '<tr><td colspan="5">No courses found.</td></tr>';
                    }
                }catch (Exception $ex){
                    echo "Error fetching courses: " . $ex->getMessage();
                }
            ?>
        </tbody>
    </table>
</div>

<?php
}else {
    displayMessage("error", "Admin is not logged in, and admin session is not active! Redirecting to admin login ...");
    header('refresh: 1;url=adminLogin.php');
    exit();
}
?>
<?php include "../templates/adminFooter.php"; ?>
