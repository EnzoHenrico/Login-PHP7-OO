<?php
require_once '../app/database/registerQuery.php';
require_once '../app/database/loginQuery.php';
require_once '../app/database/sessionQuery.php';

class Verification
{

  public function fieldIsfilled($input, $fieldName)
  {
    if (!$input) {
      throw new \Exception("{$fieldName} field mandatory");
    } else{
      return $input;
    }
  }

  public function inputPasswordMatch($key, $confirmKey)
  {

    if (empty($key)) {
      throw new \Exception("Password field mandatory");
    }
    if (empty($confirmKey)) {
      throw new \Exception("Confirm your password");
    }

    if ($key != $confirmKey) {
      throw new \Exception("Password need match");
    }

    return $key;
  }

  public function usernameIsAvailable($username)
  {

    $sql = new RegisterQuery();

    if (empty($username)) {
      throw new \Exception("Username field mandatory");
    }

    $usernameCount = $sql->loginVerify($username);

    if ($usernameCount > 0) {
      throw new \Exception("Username in use");
    }

    return $username;
  }

  public function loginIsValid($login, $key)
  {

    $sql = new SeesionQuery();

    try {
      self::fieldIsfilled($login, 'Login Username');
      self::fieldIsfilled($key, 'Password');

      $data = $sql->getDataByUsername($login);

      if(!$data){
        throw new \Exception("No Data");
      }
      $sql->authenticateSession($data, $key);
      
    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }
}
