<?php
require_once '../app/ClassConnection.php';
require_once '../app/middlewares/verification.php';
require_once '../app/services/session.php';


class ClassLogin

{

  public $inputLogin;
  public $inputKey;

  function __construct($postLogin, $postKey)
  {
    $connection = new ClassConnection();
    // Security: clean sql inputs
    $this->inputLogin = $connection->clean($postLogin);
    $this->inputKey = $connection->clean($postKey);
  }

  public function verifyInputs()
  {
    $verifyIf = new Verification();

    try {
      $verifyIf->fieldIsfilled($this->inputLogin, 'Username');
      $verifyIf->fieldIsfilled($this->inputKey, 'Password');
    } catch (\Exception $error) {
      return $error->getMessage();
    }
    
    return self::loginIsValid($this->inputLogin, $this->inputKey);
  }

  public function loginIsValid($login, $key)
  {
    $session = new SeesionServices();

    try {
      $data = $session->getDataByUsername($login);
      $session->authenticateSession($data, $key);
    } catch (\Exception $error) {
      return $error->getMessage();
    }
  }
}
