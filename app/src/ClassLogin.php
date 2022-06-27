<?php 
require_once "ClassLoginFunctions.php";

Class ClassLogin extends LoginFunctions{
      
  public function __construct($postLogin, $postKey){

      self::verifyInputs($postLogin, $postKey); 
  }
}
   
?>