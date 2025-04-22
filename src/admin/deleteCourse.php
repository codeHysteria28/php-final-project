<?php
include '../templates/adminHeader.php';
require_once '../HelperFunctions/displayAlert.php';
require_once 'Course.php';

// sanitize the id query parameter and ensure only numeric values are passed
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id > 0 && $_SESSION['AdminActive']){
    // Create a Course instance and call a deleteCourse method
    $course = new Course('','','','');
    $course->deleteCourse($id);
}

include "../templates/adminFooter.php";
