<?php

namespace App\Controller;
use App\Model\UserModel;
use App\Controller\Controller;
use App\Model\CityModel;

    class UserController extends Controller {

          public   function index()
          {
            $user = new UserModel();
            $result= $user->allUsers();
            
            $this->render("user","listeUser","liste of users", $result);
            
                    
           }

           public   function  adduser() 
               {
                $city =new CityModel();
                $city= $city->showCity();
                $this->render("user","create","Add Users", $city);
                       
              }

              public function insertuser()
              {
                  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                    
                      $fname = $_POST['fname'] ?? '';
                      $lname = $_POST['lname'] ?? '';
                      $contactno = $_POST['contactno'] ?? '';
                      $email = $_POST['email'] ?? '';
                      $address = $_POST['address'] ?? '';
                      $city = $_POST['city'] ?? '';
              
                     
                      
                      $user = new UserModel();
                      $res = $user->addUser($fname, $lname, $contactno, $email, $address, $city);
              
                      
                      if ($res) {
                          
                          header('Location:../');
                          exit; 
                      } else {
                    
                          echo "Failed to add user.";
                      }
                  } else {
                     
                      echo "Invalid request method.";
                  }
              }
              

          public  function readUser () 
          {
               
               if(isset($id)){
               $user = new UserModel();
               $result = $user->getUser($id);
               require_once '../app/view/read_user.php';  
               } 
                     
          }
          public  function destroyUser($id) 
          {
               
               $user = new UserModel();
               $result = $user->deleteUser($id);
               if($result){
                header('Location:?action=listusers');
               }
                   
          }

           
    }


   
           
   
