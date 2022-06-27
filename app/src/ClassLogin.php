<?php

require_once 'ClassConnection.php';

class LoginFunctions
{

  public $inputLogin;
  public $inputKey;

  function __construct($postLogin, $postKey)
  {

    $connection = new ClassConnection();
    // Security: clean sql inputs
    $this->cleanLogin = $connection->clean($postLogin);
    $this->cleanKey = $connection->clean($postKey);
  }

  public function verifyInputs()
  {

    $verifyIf = new Verification();

    try {
      $verifyIf->loginIsValid($this->inputLogin, $this->inputKey);
    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }
}
