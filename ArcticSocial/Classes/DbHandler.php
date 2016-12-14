<?php

class DbHandler {

    //private connection variable
    private $conn;

    //Constructor class - runs when class is initialized
    function __construct() {
        //initialize database connection when class is instantiated
        require_once dirname(__FILE__ . '/DbConnect.php');
        //Open database
        try {
            $db = new DbConnect();
            $this->conn = $db->connect();
        } catch (Exception $ex) {
            $this::dbConnectError($ex->getCode());
        }
    }//End of constructor
    
     public function createUser($Address,$Birthdate,
             $City,$email, $password, 
             $first_name, $last_name,$Phone_Num,
             $Postal_Code,$Province,$User_Name) {

        // First check if user already existed in db
        if (!$this->isUserExists($email)) {
            // Generating password hash
            $password_hash = PassHash::hash($password);

            // Make activation code
            $active = md5(uniqid(rand(), true));

            $stmt = $this->conn->prepare("INSERT INTO users(Address,Birthdate
                City,email,pass,
                first_name,last_name,Phone_Num,
                Postal_Code,Province,User_Name)
                     VALUES(:Address,:Birthdate,
                     :City,:email, :pass,
                     :fname, :lname,:Phone_Num,
                     :Postal_Code,:Province, :User_Name)");

            $stmt->bindValue(':Address', $Address, PDO::PARAM_STR);
            $stmt->bindValue(':Birthdate', $Birthdate, PDO::PARAM_STR);       
            $stmt->bindValue(':City', $City, PDO::PARAM_STR);          
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':fname', $first_name, PDO::PARAM_STR);
            $stmt->bindValue(':lname', $last_name, PDO::PARAM_STR);
            $stmt->bindValue(':Phone_Num', $Phone_Num, PDO::PARAM_STR);
            $stmt->bindValue(':Postal_Code', $Postal_Code, PDO::PARAM_STR);
            $stmt->bindValue(':Province', $Province, PDO::PARAM_STR);
            $stmt->bindValue(':User_Name', $User_Name, PDO::PARAM_STR);
            
            $result = $stmt->execute();


            // Check for successful insertion
            if ($result) {
                // User successfully inserted
                $data = array(
                    'error' => false,
                    'message' => 'USER_CREATE_SUCCESS',
                    'active' => $active
                );
            } else {
                // Failed to create user
                $data = array(
                    'error' => true,
                    'message' => 'USER_CREATE_FAIL',
                );
            }
        } else {
            // User with same email already existed in the db
            $data = array(
                'error' => true,
                'message' => 'USER_ALREADY_EXISTS'
            );
        }

        return $data;
    }
}//End of DbHandler
