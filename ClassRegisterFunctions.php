<?php

require_once 'ClassConnection.php';

class RegisterFunctions extends ClassConnection {

  public $registerError = array();
  public $createName;
  public $newLogin;
  public $insertKey;

  //Limpa as variáveis e inicia os métodos
  public function verifyRegister($postCreateName, $postCreateLogin, $postCreateKey, $postConfirmKey){

    global $error;
    $error = array();

    $this->registerError[0] = "";
    $this->registerError[1] = "";
    $this->registerError[2] = "";
    $this->registerError[3] = "";
    $this->registerError[4] = "";

    //Camada de segurança: limpeza de inputs sql
    $this->createName = self::clean($postCreateName);
    $this->newLogin =  self::clean($postCreateLogin);
    $createKey = self::clean($postCreateKey);
    $confirmKey = self::clean($postConfirmKey);

    //Metodos de registro
    self::newLogin($createKey, $confirmKey); 
  }

  //Método de verificação de login e criação do mesmo 
  public function newLogin($createKey, $confirmKey){

    $login = $this->newLogin;
    
    if(!empty($login)){
        
      $loginVerify = true;
      $sql = "SELECT `login` FROM `usuarios` WHERE `login` = '$login'";
      $result = mysqli_query($this->connect(), $sql);
      
          if (mysqli_num_rows($result) > 0){
              
              $loginVerify = false;
              $this->registerError[0]  = "*Login name in use.<br>";
          }     
    }
    else{
      
      $loginVerify = false;
      $this->registerError[0]  = "*Login field mandatory.<br>";                 
    }

    self:: newCreate($createKey, $confirmKey, $loginVerify);
  }

  //Método de verificação e criação de nome de usuário
  public function newCreate($createKey, $confirmKey, $loginVerify){
              
    if(!empty($this->createName)){
        
      $nameVerify = true;  
    }
    else{
      
        $nameVerify = false;
        $this->registerError[1] = "*Name field mandatory.<br>";      
    }
    
    self::createPassword($createKey, $confirmKey, $loginVerify, $nameVerify);
  }

  //Método de criação de senha, criptografia
  public function createPassword($createKey, $confirmKey, $loginVerify, $nameVerify){
    
    if(!empty($createKey) && !empty($confirmKey)){
        
      if ($createKey == $confirmKey){

          $keyVerify = true;
          $this->insertKey = password_hash($createKey, PASSWORD_DEFAULT);
      }
      else{

          $keyVerify = false;
          $this->registerError[4] = "*Password need match.<br>";     
      }
    }
    else{
    
      $keyVerify = false;
    
      if (empty($createKey)){
        
          $this->registerError[2] = "*Password field mandatory.<br>";    
      }
      if (empty($confirmKey)){
        
          $this->registerError[3] = "*Confirm your password.<br>";   
      }        
    }

    self::verifyParams($loginVerify, $nameVerify, $keyVerify);
  }

  public function getRegisterError(){

    return $this->registerError;
  }

  //Método de validação dos métodos anteriores
  public function verifyParams($loginVerify, $nameVerify, $keyVerify){

    if ($nameVerify == true && $loginVerify == true && $keyVerify ==true){

      $name = $this->createName;
      $login = $this->newLogin;
      $key = $this->insertKey;
  
      $sql = "INSERT INTO `usuarios`(`nome`, `login`, `senha`) VALUES ('$name ', '$login', '$key')";
      mysqli_query($this->connect(), $sql);
      header('location: sucess.php');
      mysqli_close($this->connect());
    
    }
  }
}

?>