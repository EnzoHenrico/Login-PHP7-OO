<?php
require_once "ClassRegisterFunctions.php";

class ClassRegister extends RegisterFunctions{

public $registerError = array();

  public function __construct($postCreateName, $postCreateLogin, $postCreateKey, $postConfirmKey){
  
     self::verifyRegister($postCreateName, $postCreateLogin, $postCreateKey, $postConfirmKey);
  }   
}

?>