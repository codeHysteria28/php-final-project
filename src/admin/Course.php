<?php
require_once '../HelperFunctions/displayAlert.php';
require '../Database.php';

class Course {
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

    public function createCourse():void {
        try {
            $query = "INSERT INTO courses(title, description, price, videoUrl) VALUES(:title, :description, :price, :videoUrl)";
            $database = new Database();
            $dbConn = $database->getConnection();
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

    public function updateCourse($ID):void{

    }

    public function deleteCourse($ID):void {

    }

}