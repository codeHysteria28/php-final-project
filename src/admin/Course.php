<?php
require_once '../HelperFunctions/displayAlert.php';
require_once '../Database.php';

class Course {

    // declare Course instance variables
    private $title;
    private $description;
    private $price;
    private $videoUrl;

    public function __construct($title, $description, $price, $videoUrl){
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->videoUrl = $videoUrl;
    }

    // method to create a database connection
    public function createDbConnection(){
        $database = new Database();
        return $database->getConnection();
    }

    // method to create a new course
    public function createCourse():void {
        try {
            $query = "INSERT INTO courses(title, description, price, videoUrl) 
                      VALUES(:title, :description, :price, :videoUrl)";
            $dbConn = $this->createDbConnection();
            $smtp = $dbConn->prepare($query);
            $smtp->bindParam(":title", $this->title);
            $smtp->bindParam(":description", $this->description);
            $smtp->bindParam(":price", $this->price);
            $smtp->bindParam(":videoUrl", $this->videoUrl);

            if($smtp->execute()){
                displayMessage("success", "Course with title: {$this->title} was created successfully!");
                header('refresh: 2; url=adminInterface.php');
                exit();
            }else {
                displayMessage("error", "Failed to create the course");
            }
        }catch (PDOException $ex){
            displayMessage("error", "Error: " . $ex->getMessage());
        }
    }

    // method to update an existing course in database
    public function updateCourse($ID):void{
        try{
            $query = "UPDATE courses 
                      SET title = :title, description = :description, price = :price, videoUrl = :videoUrl WHERE id = :id";
            $dbConn = $this->createDbConnection();
            $smtp = $dbConn->prepare($query);
            $smtp->bindParam(":id", $ID, PDO::PARAM_INT);
            $smtp->bindParam(":title", $this->title);
            $smtp->bindParam(":description", $this->description);
            $smtp->bindParam(":price", $this->price);
            $smtp->bindParam(":videoUrl", $this->videoUrl);

            if($smtp->execute()){
                displayMessage("success", "Course with ID: {$ID} was updated successfully! Redirecting...");
                header('refresh: 2; url=../adminInterface.php');
                exit();
            }else {
                displayMessage("error", "Failed to Update the course");
            }
        }catch (PDOException $ex){
            displayMessage("error", "Error: " . $ex->getMessage());
        }
    }

    // method to delete an existing course in database
    public function deleteCourse($ID):void {
        try{
            $query = "DELETE FROM courses WHERE ID = :id";
            $dbConn = $this->createDbConnection();
            $smtp = $dbConn->prepare($query);
            $smtp->bindParam(':id', $ID, PDO::PARAM_INT);

            if($smtp->execute()){
                displayMessage("success", "Course with ID: {$ID} was deleted successfully! Redirecting...");
                header('refresh: 2; url=../adminInterface.php');
                exit();
            }else {
                displayMessage("error", "Failed to create the course");
            }

        }catch (PDOException $ex){
            displayMessage("error", "Error: " . $ex->getMessage());
        }
    }

}