<?php
require_once '../Database.php';

function getAllCourses(){
    $query = "SELECT * FROM courses";
    $database = new Database();
    $dbConn = $database->getConnection();
    $stmt = $dbConn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
