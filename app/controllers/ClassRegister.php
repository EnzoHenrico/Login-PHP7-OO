<?php
require_once '../app/ClassConnection.php';
require_once '../app/middlewares/verification.php';
require_once '../app/services/authentication.php';

class ClassRegister extends AuthenticationServices
{

  public $inputName;
  public $inputUsername;
  public $inputKey;
  public $inputConfirmKey;

  public function __construct($postCreateLogin, $postCreateName, $postCreateKey, $postConfirmKey){

    $connection = new ClassConnection();
    // Security: clean sql inputs
    $this->inputUsername = $connection->clean($postCreateLogin);
    $this->inputName = $connection->clean($postCreateName);
    $this->inputKey = $connection->clean($postCreateKey);
    $this->inputConfirmKey = $connection->clean($postConfirmKey);  

  }

  public function checkField($input, $field){

    $verifyIf = new Verification();

    try {    
      $verifyIf->fieldIsfilled($input, $field);
       return null;
    } catch (\Exception $error) {
       return $error->getMessage();
    }      
  }

  public function createUser(){

    $services = new AuthenticationServices();
    $verifyIf = new Verification();

    try {
      $username = $verifyIf->fieldIsfilled($this->inputUsername, "Username");
      $usernameCount = $services->loginVerify($username);

      if ($usernameCount > 0) throw new \Exception("Username in use");

      $name = $verifyIf->fieldIsfilled($this->inputName, "Name");
      $key = $verifyIf->inputPasswordMatch($this->inputKey, $this->inputConfirmKey);
      return $services->createNewUser($name , $username, $key);

    } catch(\Exception $error) {
      return $error->getMessage();
    }

  }
}
?>