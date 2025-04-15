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
            $query = "INSERT INTO users(name, password, email) VALUES(:name, :password, :email)";
            $smtp = $this->db->prepare($query);
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

    // method to login user
    public function loginUser($name, $password): void {
        try {
            $query = "SELECT * FROM users WHERE name = :name";
            $smtp = $this->db->prepare($query);
            $smtp->bindParam(':name', $name);
            $smtp->execute();
            $user = $smtp->fetch(PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user['password'])){
                $_SESSION['Name'] = $user['name'];
                $_SESSION['Active'] = true;

                header('location:' . BASE_URL . 'index.php');
                exit();
            }else {
                displayMessage("error", "Incorrect username or password");
            }
        }catch(PDOException $ex){
            displayMessage("error", "Error: " . $ex->getMessage());
        }
    }
}
