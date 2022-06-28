<?php
require_once 'ClassConnection.php';
require_once '../app/src/middlewares/verification.php';
class ClassLogin
{

  public $inputLogin;
  public $inputKey;
  private $loginError;

  function __construct($postLogin, $postKey)
  {

    $connection = new ClassConnection();
    // Security: clean sql inputs
    $this->inputLogin = $connection->clean($postLogin);
    $this->inputKey = $connection->clean($postKey);
    self::verifyInputs();
  }

  public function verifyInputs()
  {

    $verifyIf = new Verification();

    try {
      $verifyIf->loginIsValid($this->inputLogin, $this->inputKey);
    } catch (\Exception $error) {
      return self::settLoginError($error);
    }
  }

  public function settLoginError($error){
    $error = $this->loginError;
    return $error;
  }

  public function getLoginError(){
    return $this->loginError; 
  }
}
