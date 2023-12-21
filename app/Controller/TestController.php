<?php

  namespace App\Controller;
   use App\Controller\Testparent;
  class TestController extends Testparent  {
      public function index(){
          echo " we are in class Test";
      }
      public function tergui($a,$b,$c){
        echo $a + $b + $c;

      }
      

  }