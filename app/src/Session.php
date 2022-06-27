<?php
require_once 'ClassLoginFunctions.php';

class Session extends LoginFunctions{

  public function sessionData(){        
    
    $sql = new SeesionQuery();
    $data = $sql->getDataById($_SESSION['id_usuario']);
      
    return $data;
  }
}

?>