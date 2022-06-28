<?php
require_once '../app/database/sessionQuery.php';
class Session
{

  public function sessionData(){        
    
    $sql = new SeesionQuery();
    $data = $sql->getDataById($_SESSION['id_usuario']);
      
    return $data;
  }
}

?>