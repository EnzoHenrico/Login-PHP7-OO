<?php
require_once '../app/services/authentication.php';
require_once '../app/services/session.php';

class Verification
{

  public function fieldIsfilled($input, $fieldName)
  {
    if (!$input) {
      throw new \Exception("{$fieldName} field required");
    } else{
      return $input;
    }
  }

  public function inputPasswordMatch($password, $confirmation)
  {

    if (empty($password)) {
      throw new \Exception("password empty");
    }
    if (empty($password)) {
      throw new \Exception("Confirm your password");
    }

    if ($password != $confirmation) {
      throw new \Exception("Password need match");
    }

    return $password;
  }
}
