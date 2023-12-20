<?php  
 namespace App\Model;
 use App\Classes\City;
 use App\Orm\Orm;
 class CityModel {
    private $cities = [];
    private $con;
    public function __construct() { 
        $this->con = new Orm();
    }
    public function showCity() {
          $res= $this->con->selectAll("villes");
          foreach($res as $r) {
                     $city= new City($r["id"],$r["ville"],null);
                     array_push($this->cities,$city);
          }
          return $this->cities;
    }
 }