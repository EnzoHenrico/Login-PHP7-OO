<?php 

require_once 'ClassConnection.php';

class LoginFunctions {

    public $inputLogin; 
    public $inputKey;

    function __construct($postLogin, $postKey){
      
      $connection = new ClassConnection();
      // Security: clean sql inputs
      $this->cleanLogin = $connection->clean($postLogin);
      $this->cleanKey = $connection->clean($postKey);
    }
    
    public function verifyInputs(){

      $verifyIf = new Verification();

      try {
        $login = $verifyIf($this->inputLogin, "Login");
        $key = $verifyIf($this->inputKey, "Password");
      } catch (Exception $error) {
        $error->getMessage();
      }
        
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
}

?>