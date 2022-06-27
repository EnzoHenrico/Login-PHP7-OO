<?php
require_once 'ClassConnection.php';
require_once '../classes/database/registerQuery.php';

class ClassRegister {

  public $inputName;
  public $inputUsername;
  public $inputKey;
  public $inputConfirmKey;

  public function __construct($postCreateName, $postCreateLogin, $postCreateKey, $postConfirmKey){

    $connection = new ClassConnection();
    // Security: clean sql inputs
    $this->inputName = $connection->clean($postCreateName);
    $this->inputUsername = $connection->clean($postCreateLogin);
    $this->inputKey = $connection->clean($postCreateKey);
    $this->inputConfirmKey = $connection->clean($postConfirmKey);  

  }

  public function createUser(){

    $sql = new RegisterQuery();
    $verifyIf = new Verification();

    try {
      
      $name = $verifyIf->fieldIsfilled($this->inputName, "Name");
      $username = $verifyIf->fieldIsfilled($this->inputUsername, "Username");
      $username = $verifyIf->usernameIsAvailable($this->inputUsername);
      $key = $verifyIf->inputPasswordMatch($this->inputKey, $this->inputConfirmKey);

      $sql->createNewUser($name , $username, $key);      

    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }
}

?>