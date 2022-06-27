<?php
require_once '../database/registerQuery.php';

class Verification {

  public function fieldIsfilled($input, $fieldName) {
                    
    if(empty($input)){    
      throw new InputError(400, "{$fieldName} field mandatory");    
    }

    return $input;
  }

  public function inputPasswordMatch($key, $confirmKey){
    
    if (empty($key)){
      throw new InputError(400, "Password field mandatory");        
    }
    if (empty($confirmKey)){
      throw new InputError(400, "Confirm your password");        
    }
            
    if ($key != $confirmKey){
        throw new InputError(400, "Password need match");
    }
      
    return $key;
  }

  public function usernameIsAvailable($username) {

    $sql = new RegisterQuery();

    if(empty($username)){
      throw new RegisterError(400, "Username field mandatory");
    }
    
    $usernameCount = $sql->loginVerify($username);

    if ($usernameCount > 0){              
      throw new RegisterError(400, "Username in use");
    }

    return $username;
  }

  public function loginIsValid($input){

  }
}

?>