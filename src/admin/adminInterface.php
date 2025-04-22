<?php
include '../templates/adminHeader.php';
require_once '../HelperFunctions/displayAlert.php';

if(isset($_SESSION['AdminActive']) && $_SESSION['AdminActive']){
    // admin content below
    // create, update and delete courses
?>

<div class="col-md-6 mt-5" id="create-course">
    <h2 class="text-primary">Create course</h2>
    <form method="post">
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
        <button type="submit" class="btn btn-success">Create course</button>
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
