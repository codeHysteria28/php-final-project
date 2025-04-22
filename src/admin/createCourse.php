<?php
session_start();
require '../HelperFunctions/sanitizeUserInput.php';
require_once 'Course.php';

if(isset($_POST['createCourse']) && $_SESSION['AdminActive']) {
    // save and sanitize user input to variables
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $price = sanitizeInput($_POST['price']);
    $videoUrl = sanitizeInput($_POST['videoUrl']);

    // create a new course object and call a method to create a new course
    $course = new Course($title, $description, $price, $videoUrl);
    $course->createCourse();
}
