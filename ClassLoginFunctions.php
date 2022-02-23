<?php 

require_once 'ClassConnection.php';

class LoginFunctions extends ClassConnection{

    public $loginError = array();
    public $cleanLogin; 
    public $cleanKey;

    public function verifyInputs($postLogin, $postKey){
        
      $loginError[0] = "";
      $loginError[1] = "";
      $loginError[2] = "";

      //Camada de segurança: limpeza de inputs sql
      $this->cleanKey = self::clean($postKey);
      $this->cleanLogin = self::clean($postLogin);

      $login = $this->cleanLogin;
      $key = $this->cleanKey;

      //Verificação de campos vazios
      if (empty($login) or empty($key)){

          $this->loginError[0] = "All fields are required<br>";
      }
      else{
          
          $sql = "SELECT login FROM usuarios WHERE login = '$login'";
          $result = mysqli_query($this->connect(), $sql);
          self::verifyUser($result);
      }
    }

    public function verifyUser($result){
        
      $login = $this->cleanLogin;
      $key = $this->cleanKey;

      if (mysqli_num_rows($result) > 0){
          
        $sql = "SELECT * FROM `usuarios` WHERE (`usuarios`.`login` = '$login')";
        $rowResult  = mysqli_query($this->connect(), $sql);

        $data = $rowResult ->fetch_array();

        //Verificação de senha e dados de sessão
        if(password_verify($key, $data['senha'])){

            $_SESSION['logged'] = true;
            $_SESSION['id_usuario'] = $data['id'];  
                            
            header('location: home.php');
            mysqli_close($this->connect());
        }
        else{
            $this->loginError[1] = "User and Password don't match.";
        }       
      }
      else{

          $this->loginError[2] = "User do not exist.";
      }
    }  
    
    public function getLoginError(){

      return $this->loginError;
    }
}

?>