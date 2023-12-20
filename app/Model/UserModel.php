<?php
 
 namespace App\Model;

 use App\Classes\User;
 use App\Orm\Orm;
 use \PDOException;

class UserModel  {
    private $users = [];
    private $con;
    public function __construct() { 
        $this->con = new Orm();
    }

    public function addUser(
        string $fname,
        string $lname,
        string $mobileNumber,
        string $email,
        string $address,
        int $ville_id
    ): bool {
        try {
            $user = new User(0, $fname, $lname, $mobileNumber, $email, $address, null, $ville_id);
    
            $res = $this->con->insert(
                "users",
                ["FirstName"=> $user->getFname(), "LastName"=> $user->getLname(), "MobileNumber"=>$user->getMobileNumber(), "Email"=>$user->getEmail(), "Address"=> $user->getAddress(), "ville_id"=>$user->getVilleId()]
               
            );
    
            return $res;
        } catch (PDOException $e) {
           
            echo "Error adding user: " . $e->getMessage();
            return false; 
        }
    }
    
    public function allUsers() {
        try {
            
            $res = $this->con->innerJoinSelect(["users","villes"],["users.ID as ID","LastName","Email","FirstName","MobileNumber","ville","Address","CreationDate","ville_id"],
            ["users.ville_id"=>"villes.id"],["1"=>"1"]);
            foreach ($res as $r) 
            {   
                $user = new User($r["ID"],$r["FirstName"],$r["LastName"],$r["MobileNumber"],$r["Email"],$r["Address"],$r["CreationDate"],$r["ville_id"]);
                array_push($this->users,$user);
            }
             return $this->users;
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUser($id) {
        try {
                $condition = $id;
                $r = $this->con->selectOne("users",$condition);
             
                    $user = new User($r["ID"],$r["FirstName"],$r["LastName"],$r["MobileNumber"],$r["Email"],$r["Address"],$r["CreationDate"],$r["ville_id"]);
                return $user;
                    
            } 
        catch (PDOException $e) {
            echo $e->getMessage();
            }
    }
    public function deleteUser($id) {
        try {
                
                
                $r = $this->con->delete("users",$id);
             
                   
                return $r;
                    
            } 
        catch (PDOException $e) {
            echo $e->getMessage();
            }
    }
 }  

// public static function  testInput($data) {
//         $data = trim($data);
//         $data = stripslashes($data);
//         $data = htmlspecialchars($data);
//         return $data;
//       }





