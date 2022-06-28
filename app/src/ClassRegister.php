<?php
require_once 'ClassConnection.php';
require_once '../app/src/middlewares/verification.php';
require_once '../app/database/registerQuery.php';
class ClassRegister extends RegisterQuery
{

  public $inputName;
  public $inputUsername;
  public $inputKey;
  public $inputConfirmKey;
  private $registerError;

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
      $username = $verifyIf->fieldIsfilled($this->inputUsername, "Username");
      $username = $verifyIf->usernameIsAvailable($this->inputUsername);
      $name = $verifyIf->fieldIsfilled($this->inputName, "Name");
      $key = $verifyIf->inputPasswordMatch($this->inputKey, $this->inputConfirmKey);

      return $sql->createNewUser($name , $username, $key);

    } catch(\Exception $error) {
      echo "Create user exception: ".$error;
      return self::settRegisterError($error);
    }
    echo"<br>User created...<br>";

  }
  public function settRegisterError($error){
    $error = $this->registerError;
    return $error;
  }

  public function getRegisterError(){
    return $this->registerError; 
  }
}
?>