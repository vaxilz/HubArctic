<?php
//$FILEPATH = realpath (dirname(__FILE__));
//ECHO $FILEPATH;
//C:\xampp\htdocs\ArcticSocial\Classes
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

            $stmt = $this->conn->prepare("INSERT INTO users(Address,Birthdate,
                City,email,pass,
                first_name,last_name,Phone_Num,
                Postal_Code,Province,User_Name)
                     VALUES(:Address,:Birthdate,
                     :City,:email, :pass,
                     :first_name, :last_name,:Phone_Num,
                     :Postal_Code,:Province, :User_Name)");

            $stmt->bindValue(':Address', $Address, PDO::PARAM_STR);
            $stmt->bindValue(':Birthdate', $Birthdate, PDO::PARAM_STR);       
            $stmt->bindValue(':City', $City, PDO::PARAM_STR);          
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
            $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
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
    
    public function getUserByEmail($email) {
        try {
            $stmt = $this->conn->prepare("SELECT id, type, email, first_name, last_name, 
                                         FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //return $user;
                $data = array('error' => false,
                    'items' => $user);
                return $data;
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }
    
    public function checkLogin($email, $password) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) from users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();
        if ($num_rows > 0) {
            $stmt = $this->conn->prepare("SELECT pass from users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);

            if (PassHash::check_password($row->pass, $password)) {
                // User password is correct
                return TRUE;
            } else {
                // user password is incorrect
                return FALSE;
            }
        } else {
            // user not existed with the email
            return FALSE;
        }
    }
    
     private function isUserExists($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) from users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();

        return $num_rows > 0;
    }

}//End of DbHandler
