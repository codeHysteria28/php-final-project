<?php

class Course {
    private $title;
    private $description;
    private $price;
    private $videoUrl;
    private $isFree;

    public function __construct($title, $description, $price, $videoUrl, $isFree){
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->videoUrl = $videoUrl;
        $this->isFree = $isFree;
    }

    public function createCourse():void {

    }

    public function updateCourse($ID):void{

    }

    public function deleteCourse($ID):void {

    }

}