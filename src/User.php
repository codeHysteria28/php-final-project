<?php
require_once 'HelperFunctions/displayAlert.php';
class User {

    // declare user variables
    private $name;
    private $password;
    private $email;
    private $db;


    // constructor
    public function __construct($db, $name, $password, $email){
        $this->db = $db;
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->email = $email;
    }

    // method to register a new user
    public function registerUser(): void{
        try{
            $smtp = $this->db->prepare(
                "INSERT INTO users(name, password, email) VALUES(:name, :password, :email)"
            );
            $smtp->bindParam(':name', $this->name);
            $smtp->bindParam(':password', $this->password);
            $smtp->bindParam(':email', $this->email);

            if($smtp->execute()){
                displayMessage("success", "User {$this->name} registered successfully");
            }else {
                displayMessage("error", "Failed to register the user");
            }
        }catch (PDOException $ex){
            displayMessage("error", "Error: " . $ex->getMessage());
        }
    }
}
