<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../HelperFunctions/displayAlert.php';

// get all courses
function getAllCourses(){
    try {
        $query = "SELECT * FROM courses";
        $database = new Database();
        $dbConn = $database->getConnection();
        $stmt = $dbConn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $ex){
        displayMessage("error", "Error: " . $ex->getMessage());
    }
}

// get single course
function getSingleCourse($id){
    try {
        $query = "SELECT * FROM courses WHERE id = :id LIMIT 1";
        $database = new Database();
        $dbConn = $database->getConnection();
        $stmt = $dbConn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch (PDOException $ex){
        displayMessage("error", "Error: " . $ex->getMessage());
    }
}
