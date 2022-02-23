<?php

require_once 'ClassLoginFunctions.php';

class Id extends LoginFunctions{

  public function sessionData(){        
    
      $id = $_SESSION['id_usuario'];
      $sql = "SELECT * FROM usuarios WHERE id = '$id'";

      $result = mysqli_query(self::connect(), $sql);
      $data = mysqli_fetch_array($result);
      mysqli_close(self::connect());
      
      return $data;
  }
}

?>